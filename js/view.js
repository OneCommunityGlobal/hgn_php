'use strict';
var View = function() {
    this.test = 1;
};
View.prototype = {
    init : function() {
        this.displayTagArr = [, 'input', 'textarea', 'input', 'input', 'select', 'input', 'input', 'input'];
        this.displayTypeArr = [, 'text', 'textarea', 'checkbox', 'radio', 'select', 'date', 'truefalse', 'yesno'];
        this.headerDiv = document.getElementById("headerDiv");
        this.detailDiv = document.getElementById("detailDiv");
        this.messageArea = document.getElementById('messageArea');

        this.headerForm = document.getElementById("headerForm");
        if(!this.headerForm) {
            this.headerForm = document.createElement("form");
            this.headerForm.id = 'headerForm';
            this.headerForm.className = 'form-inline';
            this.headerForm.role = 'form';
        }

        this.detailForm = document.getElementById("detailForm");
        if(!this.detailForm) {
            this.detailForm = document.createElement("form");
            this.detailForm.id = 'detailForm';
            this.detailForm.className = 'form-inline';
            this.detailForm.role = 'form';
        }

        this.headerTable = document.createElement('table');
        this.headerThead = document.createElement('thead');
        this.headerTbody = document.createElement("Tbody");
        this.detailTable = document.createElement('table');
        this.detailThead = document.createElement('thead');
        this.detailTbody = document.createElement("Tbody");

        this.headerDiv.appendChild(this.headerForm);
        this.detailDiv.appendChild(this.detailForm);

        this.tempSubmitDiv = document.createElement("div");
        this.tempSubmitDiv.className = 'row col-md-12 text-center';
        this.tempSubmitButton = document.createElement("input");
        this.tempSubmitButton.setAttribute('type', 'submit');
        this.tempSubmitButton.setAttribute('name', 'Submit');
        this.tempSubmitButton.setAttribute('value', 'Submit Changes');
        this.tempSubmitDiv.appendChild(this.tempSubmitButton);
        var that = this;
        this.detailForm.addEventListener("submit", function(evt) {
            evt.preventDefault();
            that.updateData();
        }, false);
    },
    callBack : function(httpResponse) {
        var data = {};
        try {
            data = JSON.parse(httpResponse);
            var response = data['response'];
        } catch (err) {
            this.messageArea.innerHTML = 'Update Failed';
            return;
        }
        if(response['success']) {
            this.headerData = {};
            this.detailData = {};
            //TODO make sure header and detail data have data
            this.headerData = data['headerData'];
            this.detailData = data['detailData'];
            var cbMethod = response['cbMethod'];
            this.messageArea.innerHTML = 'Update Successful';
            hgnView[cbMethod]();
        }else {
            this.messageArea.innerHTML = 'Update Failed';
        }
        return;
    },
    redrawPage : function(format) {
        hgnPage.clearSection('headerForm');
        hgnPage.clearSection('detailForm');
        this.renderData(format);
    },
    createNewRecord : function() {
        this.action = 'create';
        this.headerData = {};
        this.detailData = {};
        this.headerColArr = [];
        this.detailColArr = [];
        
        for(var colName in this.headerMeta) {
            if(colName === 'tableName') continue;
            if(!this.headerMeta.hasOwnProperty(colName)) continue;
            this.headerColArr.push(colName);
        }
        this.headerData[-1] = {};
        for(var colName in this.headerMeta) {
            if(colName === 'tableName') continue;
            if(!this.headerMeta.hasOwnProperty(colName)) continue;
            this.headerData['-1'][colName] = this.headerMeta[colName].defaultValue;
        }
        
        for(var colName in this.detailMeta) {
            if(colName === 'tableName') continue;
            if(!this.detailMeta.hasOwnProperty(colName)) continue;
            this.detailColArr.push(colName);
        }
        this.detailData[-1] = {};
        for(var colName in this.detailMeta) {
            if(colName === 'tableName') continue;
            if(!this.detailMeta.hasOwnProperty(colName)) continue;
            this.detailData['-1'][colName] = this.detailMeta[colName].defaultValue;
        }
        
        this.redrawPage();
        return;
    },
    deleteRecord : function() {
        this.action = 'delete';
        var dataForm = document.getElementById('dataForm');
        dataForm.action = '/admin/delete/' + this.module;
        dataForm.submit();
        return;
        //
//        this.action = 'delete';
//        var model = this.model;
//        var method = 'delete';
//        var table = this.table;
//        var data = new Object();
//        data.id = this.currentId;
//        this.sendData(model, method, table, data);
//        return;
    },
    renderData : function(format) {
        if(!format) format = 'table';
        this.format = format;
        this.init();

        this.renderColHeader('header');

        var row = this.headerData[Object.keys(this.headerData)[0]];
        this.renderRow(row, 'header');

        this.renderColHeader('detail');
        var dataRow = this.detailData;
        var tmpArray = [];
        for(var rowId in this.detailData) {
            var parent = this.detailData[rowId]["parentId"];
            var id = rowId;
            var pos = this.detailData[rowId]["position"];
            var newRow = {parent : parent, pos : pos, id : id};
            tmpArray.push(newRow);
        }

        tmpArray.sort(function(a, b) {
            if((a.parent > b.parent) ||
                    (a.parent === b.parent && a.pos > b.pos)) {
                return 1;
            }
            if((a.parent < b.parent) ||
                    (a.parent === b.parent && a.pos < b.pos)) {
                return -1;
            }
            return 0;
        });
        for(var idx in tmpArray) {
            parent = +(tmpArray[idx]["parent"]);
            var currId = +(tmpArray[idx]["id"]);
            if(parent !== 0) break;
            var row = this.detailData[tmpArray[idx]["id"]];
            var currLevel;
            row.level = currLevel = 0;
            this.renderRow(row, 'detail');
            this.renderChildren(currId, tmpArray, currLevel);
        }
        this.detailForm.appendChild(this.tempSubmitDiv);
        return;
    },
    renderColHeader : function(rowType) {
        if(this.format === 'table') {
            var rowTag = 'tr';
            var colTag = 'th';
        }else {
            var rowTag = 'div';
            var colTag = 'span';
        }

        var tempRow = document.createElement(rowTag);
        tempRow.className = 'row';
        for(var idx in this[rowType + 'ColArr']) {
            var tempCol = document.createElement(colTag);
            tempCol.innerHTML = this[rowType + 'Meta'][this[rowType + 'ColArr'][idx]].colHeader;
            tempRow.appendChild(tempCol);
        }

        if(this.format === 'table') {
            this[rowType + 'Tbody'].appendChild(tempRow);
            this[rowType + 'Table'].appendChild(this[rowType + 'Tbody']);
            this[rowType + 'Form'].appendChild(this[rowType + 'Table']);
        }else {
            this[rowType + 'Form'].appendChild(tempRow);
        }
    },
    renderRow : function(row, rowType) {
//        if(document.getElementById(row["id"])) {
//            return;
//        }

        if(this.format === 'table') {
            var tempRow = document.createElement('tr');
        }else {
            var tempRow = document.createElement('div');
        }
        tempRow.id = row['id'];
        tempRow.className = rowType + 'Row Row';
        for(var x = 0;x < this[rowType + 'ColArr'].length;x++) {
            var columnName = this[rowType + 'ColArr'][x];
            var columnVal = row[columnName];
            if(this.format === 'table') {
                var tempCell = document.createElement('td');
            }else {
                var tempCell = document.createElement('span');
            }
            var displayType = this[rowType + 'Meta'][columnName].displayType;
            var elemTag = this.displayTagArr[displayType];
            var elemType = this.displayTypeArr[displayType];
            var tempElement = document.createElement(elemTag);
            tempElement.id = this[rowType + 'ColArr'][x];
            tempElement.name = this[rowType + 'ColArr'][x];
            tempElement.className = 'form-control';
//            var size = this.detailMeta[columnName].displayWidth;
//            tempElement.size = size;
//            tempElement.type = elemType;
            tempRow.setAttribute('type', elemType);
            tempElement.value = columnVal;
            switch(elemType) {
                case 'text' :
                    tempCell.appendChild(tempElement);
                    tempRow.appendChild(tempCell);
                    break;
                case 'textarea' :
//                    tempElement.cols = size;
                    tempElement.rows = 1;
                    //TODO fix this; it shouldn't be hard coded
                    tempElement.style.height = '34px';
                    tempCell.appendChild(tempElement);
                    tempRow.appendChild(tempCell);
                    break;
                case 'checkbox' :
                    tempCell.appendChild(tempElement);
                    tempRow.appendChild(tempCell);
                    break;
                    //TODO need to do code for radio
                case 'radio' :
                    tempCell.appendChild(tempElement);
                    tempRow.appendChild(tempCell);
                    break;
                case 'select' :
                case 'select-one' :
                case 'select-multiple' :
//                    tempElement.size = 1;
                    var lookupsObj = this[rowType + 'Lookups'][this[rowType + 'Meta'][columnName].systemLookupId];
                    if(typeof (lookupsObj) === "undefined") continue;
                    var cntr = 0;
                    for(var idx in lookupsObj) {
                        var lookupObj = lookupsObj[idx];
                        //new Option(text, value, defaultSelected, selected)
                        tempElement.options[cntr] = new Option(lookupObj['title'], lookupObj['value'], false, false);
                        if(lookupObj.value == columnVal) {
                            tempElement.options[cntr].selected = true;
                        }
                        tempCell.appendChild(tempElement);
                        tempRow.appendChild(tempCell);
                        cntr++;
                    }
                    break;
                case 'date' :
//                    tempElement.size = 8;
                    tempCell.appendChild(tempElement);
                    tempRow.appendChild(tempCell);
                    break;
                case 'truefalse' :
                case 'yesno' :
                    var labels = ['yes', 'no'];
                    var values = [1, 0];
                    for(var i = 0;i < labels.length;i++) {
                        var tempLabel = document.createElement('label');
                        tempCell.className = 'form-control';
                        //TODO move formatting to CSS
                        tempCell.style.width = "110px";
                        tempLabel.innerHTML = labels[i];
                        tempLabel.className = '';
                        tempLabel.style.paddingLeft = '2px';
                        var tempElement = document.createElement('input');
                        tempElement.id = this[rowType + 'ColArr'][x];
                        tempElement.type = 'radio';
                        tempElement.name = row['id'] + '_' + this[rowType + 'ColArr'][x];
                        tempElement.className = '';
                        tempElement.value = values[i];
                        tempElement.style.marginLeft = "2px";
                        if(values[i] == columnVal) {
                            tempElement.checked = true;
                        }
                        tempLabel.appendChild(tempElement);
                        tempCell.appendChild(tempLabel);
                    }
                    tempRow.appendChild(tempCell);
                    break;
                default :
                    alert('Oops - Fell Thru to Default in renderData');
                    break;
            }
        }

        if(this.format === 'table') {
            this[rowType + 'Tbody'].appendChild(tempRow);
            this[rowType + 'Table'].appendChild(this[rowType + 'Tbody']);
            this[rowType + 'Form'].appendChild(this[rowType + 'Table']);
        }else {
            this[rowType + 'Form'].appendChild(tempRow);
        }
        return;
    },
    renderChildren : function(currId, tmpArray, currLevel) {
        for(var idx in tmpArray) {
            var parent = +(tmpArray[idx]["parent"]);
            if(parent === currId) {
                var newLevel = currLevel + 1;
                var row = this.detailData[tmpArray[idx]["id"]];
                row.level = newLevel;
                this.renderRow(row, 'detail');
                var newId = +(tmpArray[idx]["id"]);
                this.renderChildren(newId, tmpArray, newLevel);
            }
        }
        return;
    },
    updateData : function() {
        this.data = {};
        this.data.header = {};
        this.data.detail = {};
        this.messageArea.innerHTML = '';
        this.data['headerTable'] = this.headerMeta.tableName;
        this.data['detailTable'] = this.detailMeta.tableName;

        //Loop thru the header record and check for changes
        var headerRows = document.querySelectorAll(".headerRow");
        for(var i in headerRows) {
            if(!headerRows.hasOwnProperty(i)) continue;
            var headerRow = headerRows[i];
            this.data['headerId'] = headerRow.id;
            this.checkChanges(headerRow, 'header');
        }

        //Loop thru the detail table rows and check for changes/additions/deletions
        var detailRows = document.querySelectorAll(".detailRow");
        for(var i in detailRows) {
            if(!detailRows.hasOwnProperty(i)) continue;
            var detailRow = detailRows[i];
            this.checkChanges(detailRow, 'detail');
        }

        this.sendChanges();
        return;
    },
    checkChanges : function(dataRow, dataType) {
        var dataChanges = {};
        var dataRecord = dataType + 'Data';
        var colId = dataRow.id;
        dataChanges.id = colId;
//      var qs = '.dataRow[id="' + dataRow.id + '"]  .dataInput';
        var qs = '.' + dataType + 'Row[id="' + dataRow.id + '"] *';
        var dataInputs = document.querySelectorAll(qs);
        var inputTypes = ["INPUT", "TEXTAREA", "SELECT"];
        for(var j in dataInputs) {
            if(!dataInputs.hasOwnProperty(j)) continue;
            var dataInput = dataInputs[j];
            if(dataInput.disabled) continue;
            if(inputTypes.indexOf(dataInput.tagName) === -1) continue;
            if(colId && colId in this[dataRecord]) {
                var detailRow = this[dataRecord][colId];
                var colName = dataInput.id;
                switch(dataInput.type) {
                    case 'text' :
                        if(typeof (dataInput.value) !== "undefined" && dataInput.value !== detailRow[colName]) {
                            dataChanges['changeType'] = 'u';
                            dataChanges[colName] = dataInput.value;
                            this.data[dataType][colId] = dataChanges;
                        }
                        break;
                    case 'textarea' :
                        if(typeof (dataInput.value) !== "undefined" && dataInput.value !== detailRow[colName]) {
                            dataChanges['changeType'] = 'u';
                            dataChanges[colName] = dataInput.value;
                            this.data[dataType][colId] = dataChanges;
                        }
                        break;
                    case 'checkbox':
                        if(dataInput.checked && detailRow[colName] === '0') {
                            dataChanges['changeType'] = 'u';
                            dataChanges[colName] = 1;
                            this.data[dataType][colId] = dataChanges;
                        }else if(!dataInput.checked && detailRow[colName] === '1') {
                            dataChanges['changeType'] = 'u';
                            dataChanges[colName] = 0;
                            this.data[dataType][colId] = dataChanges;
                        }
                        break;
                    case 'radio':
                        if(dataInput.checked && dataInput.value !== detailRow[colName]) {
                            dataChanges['changeType'] = 'u';
                            dataChanges[colName] = dataInput.value;
                            this.data[dataType][colId] = dataChanges;
                        }
                        break;
                    case 'select' :
                    case 'select-one' :
                    case 'select-multiple' :
                        if(typeof (dataInput.value) !== "undefined" && dataInput.value !== detailRow[colName]) {
                            dataChanges['changeType'] = 'u';
                            dataChanges[colName] = dataInput.value;
                            this.data[dataType][colId] = dataChanges;
                        }
                        break;
                    default:
                        alert('Oops fell thru in update line 32x');
                }

                //data has changed but no original record so it's an add
            }else {
                var colName = dataInput.id;
                dataChanges["type"] = 'a';
                if(dataInput.type === 'checkbox') {
                    if(dataInput.checked) {
                        dataChanges[colName] = 1;
                        this.data[dataType][colId] = dataChanges;
                    }else {
                        dataChanges[colName] = dataInput.value;
                        this.data[dataType][colId] = dataChanges;
                    }
                }else {
                    dataChanges[colName] = dataInput.value;
                    this.data[dataType][colId] = dataChanges;
                }
            }
        }
    },
    sendChanges : function() {
        if(Object.keys(this.data.header).length === 0 & Object.keys(this.data.detail).length === 0) {
            alert("No Changes Made");
        }else {
            var module = 'project';
            var method = 'updateView';
            hgnAjax.sendData(module, method, this.data);
        }
        return;
    },
    addRow : function(bodyData) {
        var tempTr = document.createElement('tr');
        tempTr.id = -1;
        for(var x = 0;x < bodyData.this.detailColArr.length;x++) {
            var tempTd = document.createElement('td');
            var tempElement = document.createElement(this.typeArr[x][0]);
            tempElement.id = this.detailColArr[x];
            tempElement.type = this.typeArr[x][1];
            tempElement.style.width = this.widthArr[x] + "px";
            tempElement.disabled = startDisabled[x];
            switch(this.detailColArr[x]) {
                case 'ordinalPosition':
                    tempElement.value = -1;
                    break;
                case 'add':
                    tempElement.href = 'javascript:void(0)';
                    tempElement.innerHTML = '+';
                    tempElement.style.textDecoration = "none";
                    that = this;
                    tempElement.addEventListener("click", function(evt) {
                        evt.preventDefault();
                        that.addRow(that.bodyData);
                    }, false);
                    tempElement.setAttribute("data-ctl", true);
                    break;
                case 'del':
                    tempElement.type = 'checkbox';
                    tempElement.value = 0;
                    tempElement.style.width = "10px";
                    tempElement.setAttribute("data-ctl", true);
                    break;
                default:
                    if(this.typeArr[x][1] === 'checkbox') {
                        tempElement.value = 0;
                    }else if(this.valArr[x]) {
                        var valSet = this[this.valArr[x][0]];
                        for(var y in valSet) {
                            var colVal = valSet[y][this.valArr[x][1]];
                            tempElement.options[y] = new Option(colVal, colVal, false, false);
                        }
                    }else {
                        tempElement.value = this.defArr[x];
                    }
                    break;
            }
            tempTd.appendChild(tempElement);
            tempTr.appendChild(tempTd);
            this.detailTbody.appendChild(tempTr);
        }
    }
};