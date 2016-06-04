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
 * HGN short description here
 *
 * This class long description here
 *
 * @package     HGN
 * @subpackage	
 * @category	contollers
 * @author	HGN Dev Team
 */
class Template extends CI_Controller {

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
        $this->load->model('user_model');
        $this->data['loggedIn'] = $this->loggedIn = $this->user_model->isLoggedIn();

        if (!$this->loggedIn) {
            header('Location: ' . BASE_URL . 'access/login');
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

    /**
     * Short description
     * 
     * Longer description
     * 
     * @todo
     *
     * @access	public
     * @global 	type $globlvarname  Documents a global variable or its use in a function or method
     * @name    global var name     Specifies an alias for a variable. For example, $GLOBALS['myvariable'] becomes $myvariable
     * @param	type                short description
     * @return	type                short descriptino
     */
    public function index() {
        $this->load->model('xxx_model');

        $this->data['title'] = PAGE_TITLE;

        $this->load->view('xxx', $this->data);
        return;
    }

}
