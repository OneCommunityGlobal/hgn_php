var Test = function() {
};
Test.prototype = {
    init : function() {
        this.displayTagArr = [, 'input', 'textarea', 'input', 'input', 'select'];
        this.displayTypeArr = [, 'text', , 'checkbox', 'radio', , ];

        this.headerDiv = document.getElementById("headerDiv");
        this.dataDiv = document.getElementById("dataDiv");
        this.tempForm = document.createElement("form");
        this.tempTable = document.createElement('table');
        this.tempThead = document.createElement('thead');
        this.tempTbody = document.createElement("Tbody");

        this.tempSubmitDiv = document.createElement("div")
        this.tempSubmitDiv.className = 'row col-md-12 text-center';
        this.tempSubmitButton = document.createElement("input");
        this.tempSubmitButton.setAttribute('type', 'submit');
        this.tempSubmitButton.setAttribute('name', 'Submit');
        this.tempSubmitButton.setAttribute('value', 'Submit Changes');

        this.dataDiv.appendChild(this.tempForm);
        this.tempSubmitDiv.appendChild(this.tempSubmitButton);

        var that = this;
        this.tempForm.addEventListener("submit", function(evt) {
            evt.preventDefault();
            that.updateData();
        }, false);
    },
    callBack : function(httpResponse) {
        document.getElementById('messageArea');
        var data = {};
        try {
            data = JSON.parse(httpResponse);
            var response = data['response'];
        } catch (err) {
            document.getElementById('messageArea').innerHTML = 'Update Failed';
            return;
        }
        if(response['success']) {
            this.headerData = {};
            this.detailData = {};
            this.headerData = data['headerData'];
            this.detailData = data['detailData'];
            cbMethod = response['cbMethod'];
            document.getElementById('messageArea').innerHTML = 'Update Successful';
            hgntest[cbMethod]();
        }else {
            document.getElementById('messageArea').innerHTML = 'Update Failed';
        }
        return;
    },
    redrawPage : function() {
        this.renderData('table');
    },
    renderData : function(format) {
        if(!format) format = 'table';
        this.format = format;
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
            currId = +(tmpArray[idx]["id"]);
            if(parent !== 0) break;
            var row = this.detailData[tmpArray[idx]["id"]];
            row.level = currLevel = 0;
            this.renderRow(row);
            this.renderChildren(currId, tmpArray, currLevel);
        }
        this.tempForm.appendChild(this.tempSubmitDiv);
        return;
    },
    renderColHeader : function() {
        var headerRow = document.createElement('tr');
        for(var tidx in this.titleArr) {
            var tempCol = document.createElement('th');
            tempCol.innerHTML = this.titleArr[tidx];
            headerRow.appendChild(tempCol);
        }
        tempThead.appendChild(headerRow);
    },
    renderRow : function(row) {
        if(document.getElementById(row["id"])) {
            return;
        }

        if(this.format === 'table') {
            var tempRow = document.createElement('tr');
        }else {
            var tempRow = document.createElement('div');
        }
        tempRow.id = row['id'];
        tempRow.className = 'dataRow';
        tempRow.setAttribute("data-position", row.position);
        tempRow.setAttribute("data-parent", row.parentId);
        tempRow.setAttribute("data-level", row.level);

        for(var x = 0;x < this.colArr.length;x++) {
            var columnName = this.colArr[x];
            var columnVal = row[columnName];

            if(this.format === 'table') {
                var tempCell = document.createElement('td');
            }else {
                var tempCell = document.createElement('span');
            }
            var displayType = this.detailMeta[columnName].displayType;
            var elemTag = this.displayTagArr[displayType];
            var elemType = this.displayTypeArr[displayType];

            var tempElement = document.createElement(elemTag);
            tempElement.id = this.colArr[x];
            tempElement.name = this.colArr[x];
            tempElement.type = elemType;
            tempElement.className = 'dataInput';
            tempElement.setAttribute('size', this.detailMeta[columnName].displayWidth);
            if(elemTag === 'select') {
                tempElement.size = 1;
                lookupsObj = this.detailLookups[this.detailMeta[columnName].lookupId];
                if(typeof (lookupsObj) === "undefined") continue;
                cntr = 0;
                for(var idx in lookupsObj) {
                    var lookupObj = lookupsObj[idx];
                    //new Option(text, value, defaultSelected, selected)
                    tempElement.options[cntr] = new Option(lookupObj['title'], lookupObj['value'], false, false);
                    if(lookupObj['title'].toLowerCase() === row["dataType"]) {
                        tempElement.value = row["dataType"].toUpperCase();
                    }
                    tempCell.appendChild(tempElement);
                    tempRow.appendChild(tempCell);
                    cntr++;
                }
            }else {
                tempElement.value = columnVal;
                tempCell.appendChild(tempElement);
                tempRow.appendChild(tempCell);
            }
            tempElement.value = columnVal;
            tempCell.appendChild(tempElement);
            tempRow.appendChild(tempCell);
        }

        if(this.format === 'table') {
            this.tempTbody.appendChild(tempRow);
            this.tempTable.appendChild(this.tempTbody);
            this.tempForm.appendChild(this.tempTable);
        }else {
            this.tempForm.appendChild(tempRow);
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
                this.renderRow(row);
                newId = +(tmpArray[idx]["id"]);
                this.renderChildren(newId, tmpArray, newLevel);
            }
        }
        return;
    },
    updateData : function() {
        var data = {};
        data.header = {};
        data.detail = {};
        data['headerTable'] = headerTable = this.headerMeta.tableName;
        data['detailTable'] = detailTable = this.detailMeta.tableName;

        //Loop thru the table rows and check for changes/additions/deletions
        var dataRows = document.querySelectorAll(".dataRow");
        for(var i in dataRows) {
            var dataChanges = {};
            var dataRow = dataRows[i];
            colId = dataRow.id;
            dataChanges.id = colId;
            var qs = '.dataRow[id="' + dataRow.id + '"]  .dataInput';
            var dataInputs = document.querySelectorAll(qs);
            for(var j in dataInputs) {
                if(!dataInputs.hasOwnProperty(j)) continue;
                if(dataInputs[j].disabled) continue;
                var dataInput = dataInputs[j];
                if(colId && colId in this.detailData) {
                    var detailRow = this.detailData[colId];
                    var colName = dataInput.id;
                    if(typeof (dataInput.value) !== "undefined" && dataInput.value !== detailRow[colName]) {
                        if(dataInput.type === 'checkbox') {
                            if(dataInput.checked && detailRow[colName] === '0') {
                                dataChanges["type"] = 'u';
                                dataChanges[colName] = 1;
                                data["rows"][colId] = dataChanges;
                            }else if(!dataInput.checked && detailRow[colName] === '1') {
                                dataChanges["type"] = 'u';
                                dataChanges[colName] = 0;
                                data["rows"][colId] = dataChanges;
                            }
                        }else {
                            dataChanges["type"] = 'u';
                            dataChanges[colName] = dataInput.value;
                            data["detail"][colId] = dataChanges;
                        }
                    }
                }else {
                    var colName = dataInput.id;
                    dataChanges["type"] = 'a';
                    if(dataInput.type === 'checkbox') {
                        if(dataInput.checked) {
                            dataChanges[colName] = 1;
                            data["rows"][colId] = dataChanges;
                        }else {
                            dataChanges[colName] = dataInput.value;
                            data["rows"][colId] = dataChanges;
                        }
                    }else {
                        dataChanges[colName] = dataInput.value;
                        data["rows"][colId] = dataChanges;
                    }
                }
            }
        }

        if(Object.keys(data.header).length === 0 & Object.keys(data.detail).length === 0) {
            alert("No Changes Made");
        }else {
            var module = 'project';
            var method = 'updateView';
            hgnAjax.sendData(module, method, data);
        }
        return;
    },
    addRow : function(bodyData) {
        var tempTr = document.createElement('tr');
        tempTr.id = -1;
        for(var x = 0;x < bodyData.this.colArr.length;x++) {
            var tempTd = document.createElement('td');
            var tempElement = document.createElement(this.typeArr[x][0]);
            tempElement.id = this.colArr[x];
            tempElement.type = this.typeArr[x][1];
            tempElement.style.width = this.widthArr[x] + "px";
            tempElement.disabled = startDisabled[x];
            switch(this.colArr[x]) {
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
            this.tempTbody.appendChild(tempTr);
        }
    }
};