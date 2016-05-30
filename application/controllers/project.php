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
 * HGN Project controller
 *
 * This controller manages the functionality of the project page
 *
 * @package     HGN
 * @subpackage	
 * @category	contollers
 * @author	HGN Dev Team
 */
class Project extends CI_Controller {

    /** _remap
     * 
     * by declaring this _remap function, it forces all calls to the Template controller
     * to first call this function.  This allows displaying the header page and the
     * footer page once. This is CodeIgniter functionality
     *
     * @param type $method
     * @param type $params
     */
    public function _remap($method, $params = array()) {
        //Check to see if user is already logged in.
        $this->load->model('user_model');
        $this->data['loggedIn'] = $this->loggedIn = $this->user_model->isLoggedIn();

        if (!$this->loggedIn) {
            header('Location: ' . BASE_URL . 'login');
            exit;
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

        if (DISPLAY_FOOTER) {
            $this->load->view('common/footer', $this->data);
        }
        $this->load->view('common/wrapper_bottom', $this->data);
    }

    public function index() {
        $data['title'] = PAGE_TITLE;
        return;
    }

    public function display($projectId=null) {
        $this->load->model('project_model');
        $this->load->model('database_model');
        $this->load->model('system_model');

        $userId = $_SESSION['userId'];
        $projectId = 1;
        $dataTable = 'tasks';
        $colArr = [
            "position", "title", "description",
            "creatorId", "ownerId", "type", "categoryId",
            "priority", "startDateEstimate", "startDateActual", "endDateEstimate",
            "endDateActual", "dueDate", "status", "active",
            "timeRequiredEstimate", "timeRequiredActual"
        ];

        $data['title'] = PAGE_TITLE;
        $data['colArr'] = $colArr;
        $data['projectData'] = $this->project_model->read('projects', 'id', $projectId);
        $data['tasksData'] = $this->project_model->readTasksByProject($projectId);
        $data['projectsMeta'] = $projectsMeta = $this->database_model->readTableMetaData('projects');
        $data['tasksMeta'] = $tasksMeta = $this->database_model->readTableMetaData('tasks');
        $data['projectsLookups'] = $this->system_model->readLookupAll($projectsMeta);
        $data['tasksLookups'] = $this->system_model->readLookupAll($tasksMeta);

        $this->load->view('project', $data);
        
    }

    public function timesheet() {
        $this->load->model('project_model');
        $this->load->model('database_model');
        $this->load->model('system_model');

        $userId = $_SESSION['userId'];
        $table = 'timesheets';

        $data['title'] = PAGE_TITLE;
        $data['userData'] = $this->project_model->read('users', 'id', $userId);
        $data['projectsData'] = $this->project_model->readProjectsByUser($userId);
        $data['tasksData'] = $this->project_model->readTasksByUser($userId);
        $data['tableMeta'] = $tableMeta = $this->database_model->readTableMetaData($table);
        $data['tableLookups'] = $this->system_model->readLookupAll($tableMeta);

        $this->load->view('timesheet', $data);
    }

    public function update() {
        //stub needs to be filled out
        $tmp = 1;
    }
}
