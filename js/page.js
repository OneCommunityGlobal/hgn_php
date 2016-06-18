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
 * HGN Global page object
 *
 * This class is loaded globally so its methods are available on all pages. It is
 * used for functionality that may be needed by all pages, such as hiding or showing elements
 * or enabling and disabling inputs of a form
 *
 * @package     HGN
 * @subpackage	
 * @category	javascript
 * @author	HGN Dev Team
 */
'use strict';
var Page = function() {
    this.originalData = new Object();
};

Page.prototype = {
    /**
     * Init method
     * 
     * Perform any initial tasks when first calling the object. Not a constructor so
     * must be called manually
     * 
     * @todo    
     *
     * @access	public
     * @global 	type    action  Variable set in the MVC view such as "home", "add", "delete"
     *                          When the page is initially loaded it may only show selectors and no data
     *                          so we don't show certain page elements such as a delete button initially
     * @return	null
     */
    init : function() {
        if(this.action === 'home') {
            this.hideDataDiv();
            this.hideEditButton();
            this.hideDeleteButton();
        }
        return;
    },
    clearSection : function(sectionId) {
        var oldSection = document.getElementById(sectionId);
        if(oldSection) {
            oldSection.parentNode.removeChild(oldSection);
        }
        return;
    },
    /**
     * Hide an element
     * 
     * Add the class "invisible" to an elements class list. "invisible" is defined in the base CSS
     * 
     * @todo
     *
     * @access	public
     * @param   text    elementId   An elements HTML id tag value
     * @return	null
     */
    hideElement : function(elementId) {
        var element = document.getElementById(elementId);
        element.classList.add("invisible");
        return;
    },
    /**
     * Show an element
     * 
     * Remove the class "invisible" from an elements class list.
     * 
     * @todo
     *
     * @access	public
     * @param   text    elementId   An elements HTML id tag value
     * @return	null
     */
    showElement : function(elementId) {
        var element = document.getElementById(elementId);
        element.classList.remove("invisible");
        return;
    },
    /**
     * Disable input for a form
     * 
     * Sets all form tags e.g. "input", "select" to disabled so user cannot enter data
     * 
     * @todo    May need to add a few tags to queryselect to ensure all form tags are disabled
     *
     * @access	public
     * @param   text    formId  An elements HTML id tag value
     * @return	null
     */
    disableFormEdit : function(formId) {
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
    /**
     * Enable input for a form
     * 
     * Removes "disabled" from all form tags e.g. "input", "select" so user can enter data
     * 
     * @todo    May need to add a few tags to queryselect to ensure all form tags are enabled
     *
     * @access	public
     * @param   text    formId  An elements HTML id tag value
     * @return	null
     */
    enableFormEdit : function(formId) {
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
    /**
     * Validate data
     * 
     * Validate data using javascript in the front end before sending to the back end
     * to add/update. Not currently implemented but will be passed values from the
     * "system_tables_columns" database table e.g. min, max for integers, minlen, maxlen for strings
     * 
     * @todo    Needs to be written
     *
     * @access	public
     * @param	TBD
     * @return	TBD
     */
    validateData : function() {
        //just return true for now until this section is written
        return true;
        if(validData) {
            return true;
        }else {
            return false;
        }
        return;
    },
    /**
     * Display data method
     * 
     * Performs tasks for when the action "display" is chosen. When a select box is shown at
     * the top of the page and the user pulls down and selects, this method is called to display the
     * data related to the chosen select value. It was initially written for AJAX calls but AJAX was
     * removed for now.
     * 
     * @todo    May need to modify if/when AJAX calls are put back into the app. When data is displayed,
     *          we can initially disable all form fields and show an edit button which when clicked will
     *          enable all form fields, or we can just initially make all fieds editable.
     *
     * @access	public
     * @global 	string  action  Determines which action is currently being processed e.g. "display", add" etc
     * @return	null
     */
    displayData : function() {
        this.action = 'display';
        var dataForm = document.getElementById('dataForm');
        dataForm.action = '/admin/delete/display';
        deleteButton = document.getElementById('deleteButton');
        deleteButton.disabled = false;
        editButton = document.getElementById('editButton');
        editButton.disabled = false;
    },
    /**
     * Add data method
     * 
     * Performs tasks for when the action "add" is chosen. When a page is initially shown or
     * when there is a record being displayed, the add button is active
     * which displays a new blank record with default values. It was initially written 
     * for AJAX calls but AJAX was removed for now.
     * 
     * @todo    May need to modify if/when AJAX calls are put back into the app. Also need 
     *          add functionality to show default values which are pulled from the
     *          "sys_table_columns" database table
     *
     * @access	public
     * @global 	string  action  Determines which action is currently being processed e.g. "display", add" etc
     * @return	null
     */
    addData : function() {
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
    /**
     * Delete data method
     * 
     * Performs tasks for when the action "delete" is chosen. When there is a record being displayed,
     * the delete button is active and deletes the current record being displayed.
     * It was initially written for AJAX calls but AJAX was removed for now.
     * 
     * @todo    May need to modify if/when AJAX calls are put back into the app.
     *
     * @access	public
     * @global 	string  action  Determines which action is currently being processed e.g. "delete", add" etc
     * @return	null
     */
    deleteData : function() {
        this.action = 'delete';
        var dataForm = document.getElementById('dataForm');
        dataForm.action = '/admin/delete/' + this.module;
        dataForm.submit();
        return;
    }

};
