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
        dataForm.action = '/admin/add/' + this.module;
        dataForm.submit();
//        this.enableEdit();
//        this.showDataDiv();
//        this.showEditButton();
//        this.showDeleteButton();
        return;
    },
    deleteData : function () {
        this.action = 'delete';
        var dataForm = document.getElementById('dataForm');
        dataForm.action = '/admin/delete/user';
        dataForm.submit();
        return;
    }
};
