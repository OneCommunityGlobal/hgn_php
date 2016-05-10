/* This is the base library */
var Page = function () {
    this.originalData = new Object();
};

Page.prototype = {
    init : function () {
        if(this.action === 'home') {
            this.hideDataDiv();
            this.hideEditButton();
            this.hideDeleteButton();
        }
    },
    hideDataDiv : function () {
        var dataDiv = document.getElementById('dataDiv');
        dataDiv.classList.add("invisible");
    },
    hideEditButton : function () {
        var editButton = document.getElementById('editButton');
        editButton.classList.add("invisible");
    },
    hideDeleteButton : function () {
        var deleteButton = document.getElementById('deleteButton');
        deleteButton.classList.add("invisible");
    },
    showDataDiv : function () {
        var dataDiv = document.getElementById('dataDiv');
        dataDiv.classList.remove("invisible");
    },
    showEditButton : function () {
        var editButton = document.getElementById('editButton');
        editButton.classList.remove("invisible");
    },
    showDeleteButton : function () {
        var deleteButton = document.getElementById('deleteButton');
        deleteButton.classList.remove("invisible");
    },
    disableEdit : function () {
        var inputs = document.querySelectorAll("#dataDiv input, #dataDiv select");
        for(var i in inputs) {
            var input = inputs[i];
            if(typeof (input.type) === 'undefined' || input.type === 'submit' || input.type === 'hidden') {
                continue;
            }
            input.disabled = true;
        }
        return;
    },
    enableEdit : function () {
        var inputs = document.querySelectorAll("#dataDiv input, #dataDiv select");
        for(var i in inputs) {
            var input = inputs[i];
            if(typeof (input.type) === 'undefined' || input.type === 'submit' || input.type === 'hidden') {
                continue;
            }
            input.disabled = false;
        }
        return;
    },
    validateData : function () {
        return true;
//TODO complete this section to validate inputs
        if(validData) {
            return true;
        }else {
            return false;
        }
        return;
    },
    displayData : function () {
        this.action = 'display';
        var dataForm = document.getElementById('dataForm');
        dataForm.action = '/admin/delete/display';
        deleteButton = document.getElementById('deleteButton');
        deleteButton.disabled = false;
        editButton = document.getElementById('editButton');
        editButton.disabled = false;
    },
    addData : function () {
        this.action = 'add';
        var dataForm = document.getElementById('dataForm');
        dataForm.action = '/admin/add/user';
        dataForm.submit();
//        this.enableEdit();
//        this.showDataDiv();
//        this.showEditButton();
//        this.showDeleteButton();
        return;
    },
    editData : function () {
        this.action = 'edit';
        this.enableEdit();
        var dataSubmitButton = document.getElementById('dataSubmitButton');
        dataSubmitButton.classList.remove("invisible");
        return;
    },
    deleteData : function () {
        this.action = 'delete';
        var dataForm = document.getElementById('dataForm');
        dataForm.action = '/admin/delete/user';
        dataForm.submit();
        return;
    },
//    displayDataEntryForm : function () {
//        var ridx = 0;
//        var dataTbody = document.getElementById('dataTbody');
//        var dataSubmitButton = document.getElementById('dataSubmitButton');
//        for(var idx in this.tableMeta) {
//            var tableCol = this.tableMeta[idx];
//            if(!tableCol.visible || tableCol.visible == '0') continue;
//            var row = dataTbody.insertRow(ridx);
//            var cell1 = row.insertCell(0);
//            cell1.classList.add("col-md-4");
//            var cell2 = row.insertCell(1);
//            cell2.classList.add("col-md-6");
//            cell1.innerHTML = tableCol.label;
//
//            switch(tableCol.lookupType) {
//                case '2' :
//                    var tempInp = document.createElement('select');
//                    tempInp.id = tableCol.columnName;
//                    tempInp.name = tableCol.columnName;
////                    tempInp.options[0] = new Option("Select", null, false, false);
//                    idx = 0;
//                    var tableLookups = this.tableLookups[tableCol.id];
//                    for(var y in tableLookups) {
//                        ++idx;
//                        var data = tableLookups[y];
//                        tempInp.options[idx] = new Option(data.title, data.value, false, false);
////                        if(data.value == tableData[tableCol.columnName]) {
////                            tempInp.options[idx].selected = true;
////                        }
//                    }
//                    cell2.appendChild(tempInp);
//                    break;
//                default :
//                    var tempInp = document.createElement("input");
//                    tempInp.setAttribute('type', "text");
//                    tempInp.setAttribute('id', tableCol.columnName);
////                    tempInp.setAttribute('value', tableData[tableCol.columnName]);
//                    tempInp.setAttribute('value', "");
//                    cell2.appendChild(tempInp);
//                    break;
//            }
//            ridx++;
//        }
////        dataTbl.appendChild(dataTbody);
////        dataForm.appendChild(dataTable);
////        dataDiv.appendChild(dataForm);
//        return;
//    },
};
