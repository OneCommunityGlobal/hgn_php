<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {
    /* by declaring this _remap function, it forces all calls to the Template controller
     * to first call this function.  This allows displaying the header page and the
     * footer page once.
     */

    public function _remap($method, $params = array()) {
        //Check to see if user is already logged in.
        $this->load->model('user_model');
        $data['loggedIn'] = $loggedIn = $this->user_model->isLoggedIn();

        if (!$loggedIn) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }

        $this->load->view('common/wrapper_top', $data);
        if (DISPLAY_HEADER) {
            $this->load->view('common/header', $data);
        }
        $this->load->view('common/navbar', $data);

        if (method_exists($this, $method)) {
            isset($params[0]) ? $this->$method($params[0]) : $this->$method();
        } else {
            $this->index();
        }

        if (DISPLAY_FOOTER) {
            $this->load->view('common/footer', $data);
        }
        $this->load->view('common/wrapper_bottom', $data);
    }

    public function index() {
        $data['title'] = PAGE_TITLE;
        return;
    }

    public function display() {
        $this->load->model('project_model');

        $userId = $_SESSION['userId'];
        $projectId = 1;

        $data['title'] = PAGE_TITLE;
        $data['projectData'] = $this->project_model->read('projects', 'id', $projectId);
        $data['tasksData'] = $this->project_model->readTasksByProject($projectId);

        $this->load->view('project', $data);
        
    }

    public function timesheet() {
        $this->load->model('project_model');

        $userId = $_SESSION['userId'];

        $data['title'] = PAGE_TITLE;
        $data['userData'] = $this->project_model->read('users', 'id', $userId);
        $data['projectsData'] = $this->project_model->readProjectsByUser($userId);
        $data['tasksData'] = $this->project_model->readTasksByuser($userId);

        $this->load->view('timesheet', $data);
    }

}
