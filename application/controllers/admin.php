<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    /* by declaring this _remap function, it forces all calls to the Template controller
     * to first call this function.  This allows displaying the header page and the
     * footer page once. This is CodeIgniter functionality
     */

    public function _remap($method, $params = array()) {
        //Check to see if user is already logged in.
        $this->load->model('user_model');
        $this->data['loggedIn'] = $this->loggedIn = $this->user_model->isLoggedIn();

        if (!$this->loggedIn) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }

        $this->data['module'] = $this->module = $this->uri->segments['3'];
        switch ($this->module) {
            case 'community' :
                $this->data['model'] = $this->model = 'community_model';
                $this->data['table'] = $this->table = 'communities';
                break;
            case 'lookup_value' :
                $this->data['model'] = $this->model = 'lookup_model';
                $this->data['table'] = $this->table = 'lookup_values';
                break;
            default :
                $this->data['model'] = $this->model = $this->module . '_model';
                $this->data['table'] = $this->table = strtolower($this->module) . 's';
                break;
        }

        $this->load->view('common/wrapper_top', $this->data);
        if (DISPLAY_HEADER) {
            $this->load->view('common/header', $this->data);
        }
        $this->load->view('common/navbar', $this->data);

        if (method_exists($this, $method)) {
            isset($params[0]) ? $this->$method($params[0]) : $this->$method();
        } else {
            $this->index();
        }

//        if (DISPLAY_FOOTER) {
//            $this->load->view('common/footer', $this->data);
//        }
        $this->load->view('common/wrapper_bottom', $this->data);
    }

    public function index() {
        $this->data = null;
        return;
    }

    public function home() {
        $this->load->model('database_model');
        $this->data['title'] = PAGE_TITLE . ' - Admin Page';
        $this->data['action'] = $action = 'home';
        $view = 'admin/' . $this->module;

        $this->data['tableSelectors'] = $tableSelectors = $this->database_model->readSelectors($this->table);

        $this->load->view($view, $this->data);
    }
    
    public function add() {
        $this->load->model('database_model');
        $this->load->model('lookup_model');
        $this->data['title'] = PAGE_TITLE . ' - Admin Page';
        $this->data['action'] = $action = 'add';
        $view = 'admin/' . $this->module;


        $this->data['tableSelectors'] = $tableSelectors = $this->database_model->readSelectors($this->table);
        $this->data['tableMeta'] = $tableMeta = $this->database_model->readTableMetaData($this->table);
        $this->data['tableLookups'] = $this->lookup_model->readLookupAll($tableMeta);

        $this->data['tableData'] = $this->database_model->setDefaultData($tableMeta);

        $this->load->view($view, $this->data);
    }

    public function display() {
        $this->load->model('database_model');
        $this->load->model('lookup_model');
        $this->data['title'] = PAGE_TITLE . ' - Admin Page';
        $this->data['action'] = $action = 'display';

        $model = $this->model;
        $this->load->model($model);

        $this->data['tableSelectors'] = $tableSelectors = $this->database_model->readSelectors($this->table);
        $this->data['tableMeta'] = $tableMeta = $this->database_model->readTableMetaData($this->table);
        $this->data['tableLookups'] = $this->lookup_model->readLookupAll($tableMeta);

        $tableColumn = 'id';

        if (isset($_POST) and isset($_POST['hgnSelect']) and $_POST['hgnSelect']) {
            $columnValue = $_POST['hgnSelect'];
            $this->data['tableData'] = $this->$model->read($this->table, $tableColumn, $columnValue);
        } else if (isset($this->id) and $this->id) {
            $columnValue = $this->id;
            $this->data['tableData'] = $this->$model->read($this->table, $tableColumn, $columnValue);
        }

        $view = 'admin/' . $this->module;
        $this->load->view($view, $this->data);
    }

    public function update() {
        $this->data['title'] = PAGE_TITLE . ' - Admin Page';
        
        $model = $this->model;
        $this->load->model($model);

        $tableColumn = 'id';
        if (isset($_POST) and isset($_POST['id'])) {
            $this->id = $_POST['id'];
            $this->$model->update($this->table, $_POST);
        }

        $this->home();
    }

    public function delete() {
        $this->data['title'] = PAGE_TITLE . ' - Admin Page';

        $model = $this->model;
        $this->load->model($model);

        $tableColumn = 'id';
        if (isset($_POST) and isset($_POST['id'])) {
            $id = $_POST['id'];
            $this->$model->delete($this->table, $id);
        }

        $this->home();
    }

}
