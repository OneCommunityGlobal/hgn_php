/**
 * Highest Good Network
 *
 * An open source project management tool for managing global communities.
 *
 * @package	HGN
 * @author	The HGN Development Team
 * @copyright	Copyright (c) 2016.
 * @license     TBD
 * @link        https://github.com/OneCommunityGlobal/hgn_dev.git
 * @version	0.8a
 * @filesource
 */

/**
 * HGN short description here
 *
 * This class long description here
 *
 * @package     HGN
 * @subpackage	
 * @category	contollers
 * @author	HGN Dev Team
 */
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
    hideElement : function (elementId) {
        var element = document.getElementById(elementId);
        element.classList.add("invisible");
    },
    showElement : function (elementId) {
        var element = document.getElementById(elementId);
        element.classList.remove("invisible");
    },
    disableFormEdit : function (formId) {
        var form = document.getElementById(formId);
        form.classList.add("formDisabled");
        var qs = "#" + formId + " input, #dataDiv select";
        var inputs = document.querySelectorAll(qs);
        for(var i in inputs) {
            var input = inputs[i];
            if(typeof (input.type) === 'undefined' || input.type === 'submit' || input.type === 'hidden') {
                continue;
            }
            input.disabled = true;
        }
        this.hideElement('submitButton');
        return;
    },
    enableFormEdit : function (formId) {
        var form = document.getElementById(formId);
        form.classList.remove("formDisabled");
        var qs = "#" + formId + " input, #dataDiv select";
        var inputs = document.querySelectorAll(qs);
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
//TODO complete this section to validate inputs
        return true;
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
