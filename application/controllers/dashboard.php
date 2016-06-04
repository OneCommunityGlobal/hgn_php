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
 * HGN Dashboard controller
 *
 * The dashboard controller manages all the functionality of the dashboard page
 *
 * @package     HGN
 * @subpackage	
 * @category	contollers
 * @author	HGN Dev Team
 */
class Dashboard extends CI_Controller {

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
            header('Location: ' . BASE_URL . '/access/login');
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
        return;
    }

    public function index() {
        $this->load->model('database_model');
        $this->load->model('system_model');
        $this->load->model('user_model');
        
        $this->data['title'] = PAGE_TITLE;
        
        $userId = $_SESSION["userId"];
        $this->data['title'] = PAGE_TITLE;

        $this->data['tableMeta'] = $tableMeta = $this->database_model->readTableMetaData('users');
        $this->data['tableLookups'] = $this->system_model->readLookupAll($tableMeta);
        $this->data["masterData"] = $this->user_model->read('users', 'id', $userId);

        $this->load->view('dashboard', $this->data);
        return;
    }

}
