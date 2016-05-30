<?php

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
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * HGN Admin controller
 *
 * The Admin controller is a single entry point for managing all master data. By passing a module name to it, e.g. "user" or "community" 
 * it automatically knows which model and database table to access. In the current version you must create a view for each model.
 *
 * @package     HGN
 * @subpackage	
 * @category	Contollers
 * @author	HGN Dev Team
 */
class Admin extends CI_Controller {

    /** _remap
     * 
     * by declaring this _remap function, it forces all calls to the Template controller
     * to first call this function.  This allows displaying the header page and the
     * footer page once. This is CodeIgniter functionality
     *
     * @param string    $method     The method to be called passed as part of the route.
     * @param mixed     $params     Any paramaters passed as part of the route.
     */
    public function _remap($method, $params = array()) {
        //Check to see if user is already logged in.
        $this->load->model('user_model');
        $this->data['loggedIn'] = $this->loggedIn = $this->user_model->isLoggedIn();

        if(!$this->loggedIn){
            header('Location: ' . BASE_URL . 'login');
            exit;
        }

        $this->load->model('database_model');
        $this->load->model('system_model');
        
        $this->data['module'] = $this->module = $this->uri->segments['3'];
        $module = $this->uri->segments['3'];
        $moduleRecord = $this->system_model->readModule($module);
        $this->data['model'] = $this->model = $moduleRecord['model'];
        $this->data['table'] = $this->table = $moduleRecord['masterTable'];
        $this->view = 'admin/' . $this->module = $moduleRecord['view'];

        $this->load->view('common/wrapper_top', $this->data);
        if(DISPLAY_HEADER){
            $this->load->view('common/header', $this->data);
        }
        $this->load->view('common/navbar', $this->data);

        if(method_exists($this, $method)){
            isset($params[0]) ? $this->$method($params[0]) : $this->$method();
        } else {
            $this->index();
        }

        //since this is an internal admin function, you don't need to show the footer
//        if (DISPLAY_FOOTER) {
//            $this->load->view('common/footer', $this->data);
//        }
        $this->load->view('common/wrapper_bottom', $this->data);
    }

    /**
     * Index method
     * 
     * This is the standard method defaulted to if no method is specifiec in the url e.g. index.php/admin. Currently all calls
     * to this controller should include a method, so index does nothing.
     *
     * @access	public
     * @return	null
     */
    public function index() {
        $this->data = null;
        return;
    }

    /**
     * Display an initial blank page with selectors for the module
     * 
     * This method displays an initial blank page with a selector for the current module e.g. a drop down list of all users.
     * @access	public
     * @return	null
     */
    public function home() {
        $this->load->model('system_model');

        $this->data['title'] = PAGE_TITLE . ' - Admin Page';
        $this->data['action'] = $action = 'home';

        $this->data['tableSelectors'] = $tableSelectors = $this->system_model->readSelectors($this->table);

        $this->load->view($this->view, $this->data);
        return;
    }

    /**
     * Display a form with blanks or defaults for adding new records
     * 
     * Outputs a form with either blank fields or default values for user to fill in when adding a new record
     * 
     * @todo
     *
     * @access	public
     * @return  null
     */
    public function add() {
        $this->load->model('database_model');
        $this->load->model('system_model');
        $this->load->model($this->model);

        $this->data['title'] = PAGE_TITLE . ' - Admin Page';
        $this->data['action'] = $action = 'add';

        $this->data['tableSelectors'] = $tableSelectors = $this->system_model->readSelectors($this->table);
        $this->data['tableMeta'] = $tableMeta = $this->database_model->readTableMetaData($this->table);
        $this->data['tableLookups'] = $this->system_model->readLookupAll($tableMeta);

        $this->data['tableData'] = $this->system_model->setDefaultData($tableMeta);

        $this->load->view($this->view, $this->data);
        return;
    }

    /**
     * Display data in vertical format
     * 
     * When a user selects a value from the module selector, this method displays the data in a vertical form
     * 
     * @todo
     *
     * @access	public
     * @global 	$_POST  Value of selector selected by user e.g. projectId
     * @name    $_POST  $columnValue
     * @return  null
     */
    public function display() {
        $this->load->model('database_model');
        $this->load->model('system_model');
        $this->load->model($this->model);

        $this->data['title'] = PAGE_TITLE . ' - Admin Page';
        $this->data['action'] = $action = 'display';

        $this->data['tableSelectors'] = $tableSelectors = $this->system_model->readSelectors($this->table);
        $this->data['tableMeta'] = $tableMeta = $this->database_model->readTableMetaData($this->table);
        $this->data['tableLookups'] = $this->system_model->readLookupAll($tableMeta);

        $tableColumn = 'id';
        $model = $this->model;

        if(isset($_POST) and isset($_POST['hgnSelect']) and $_POST['hgnSelect']){
            $columnValue = $_POST['hgnSelect'];
            $this->data['tableData'] = $this->$model->read($this->table, $tableColumn, $columnValue);
        } else if(isset($this->id) and $this->id){
            $columnValue = $this->id;
            $this->data['tableData'] = $this->$model->read($this->table, $tableColumn, $columnValue);
        }

        $this->load->view($this->view, $this->data);
        return;
    }

    /**
     * Update a database record
     * 
     * Takes values in form submitted by user and either creates a new record if the id doesn't exist, or updates
     * an existing record if the id does already exist
     * 
     * @todo
     *
     * @access	public
     * @global 	$_POST  Values of form fields when user hits submit button
     * @return  null
     */
    public function update() {
        $this->data['title'] = PAGE_TITLE . ' - Admin Page';

        $this->load->model($this->model);
        $model = $this->model;

        $tableColumn = 'id';
        if(isset($_POST) and isset($_POST['id'])){
            $this->id = $_POST['id'];
            $this->$model->update($this->table, $_POST);
        }

        $this->home();
        return;
    }

    /**
     * Delete a record from the database
     * 
     * Deletes a record from a table in the database based on the id of the record currently being viewed
     * 
     * @todo
     *
     * @access	public
     * @global 	$_POST  Value of the id of the record currently being viewed
     * @return  null
     */
    public function delete() {
        $this->data['title'] = PAGE_TITLE . ' - Admin Page';

        $this->load->model($this->model);
        $model = $this->model;

        $tableColumn = 'id';
        if(isset($_POST) and isset($_POST['id'])){
            $id = $_POST['id'];
            $this->$model->delete($this->table, $id);
        }

        $this->home();
        return;
    }

}
