
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
 * HGN user controller
 *
 * This controller manages the functionality of the user page
 * e.g. logging in/out
 *
 * @package     HGN
 * @subpackage	
 * @category	contollers
 * @author	HGN Dev Team
 */
class Access extends CI_Controller {

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
        $this->data['title'] = PAGE_TITLE;
        $this->data['loggedIn'] = $loggedIn = false;
 
        $this->load->view('common/wrapper_top', $this->data);
        if (DISPLAY_HEADER) {
            $this->load->view('common/header', $this->data);
        }

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
     * @access	public
     * @param	type    short description
     * @param	type    short description
     * @return	type    short descriptino
     */
    public function index() {
        return;
    }

    public function login() {
        $this->load->model('user_model');
        //$this->load->library('Passwordhash',array(8, FALSE));

        $this->data['title'] = PAGE_TITLE . ' - Login';

        //this should never be true
        if (!isset($_POST['userName'])) {
            $this->load->view('login', $this->data);
            return;
        }

        $userName = (isset($_POST['userName']) and $_POST['userName']) ? $this->input->post('userName') : FALSE;
        $password = (isset($_POST['password']) and $_POST['password']) ? $this->input->post('password') : FALSE;

        if (!$userName or ! $password) {
            $this->data['message'] = '**Username And Password Are Required**';
            $this->load->view('login', $this->data);
            return;
        }
        
        // uncomment this line during production stage
        // 
       //   $password = md5($password);
        if (!$this->user_model->validateUsernamePassword($userName, $password)) {
            $this->data['message'] = 'The Username Password Combination Is Not Valid';
            $this->load->view('login', $this->data);
            return;
        }

      

        if(!$this->user_model->get('approved')) {
                $this->data['message'] = 'This account has not been approved.  Please wait for an administrator to 
                approve it.';
                $this->load->view('login', $this->data);
                return;
        }

        $_SESSION["userId"] = $this->user_model->get('id');
        $_SESSION["userName"] = $this->user_model->get('userName');
        $_SESSION["password"] = $this->user_model->get('password');
        $_SESSION["admin"] = $this->user_model->get('admin');
        $_SESSION["language"] = $this->user_model->get('language');
        $_SESSION["timezone"] = $this->user_model->get('timezone');
        $_SESSION["approved"] = $this->user_model->get('approved');

        
        
        header('Location: ' . BASE_URL . 'home');
        exit;
    }

    public function logout() {
        $this->session->sess_destroy();
        header('Location: ' . BASE_URL . 'home');
        exit;
    }
    
    public function signup() {
      $this->load->model('user_model');
      $this->data['title'] = PAGE_TITLE . ' - Signup';
      $this->data['userName'] = $this->data['password'] =  $this->data['repassword'] = $this->data['firstName'] = '';
      $this->data['lastName'] = $this->data['email'] =  $this->data['homePhone'] = $this->data['mobilePhone'] = '';
         
          if (!isset($_POST['signupButton'])) {
            $this->load->view('signup', $this->data);
            return;
        }
        
        
  $userName= $this->data['userName'] = (isset($_POST['userName']) and $_POST['userName']) ? $_POST['userName'] : FALSE;
  $password =$this->data['password'] = (isset($_POST['password']) and $_POST['password']) ? $_POST['password'] : FALSE; 
  $repassword = $this->data['repassword'] = (isset($_POST['repassword']) and $_POST['repassword']) ? $_POST['repassword'] : FALSE;
  $firstName=$this->data['firstName'] = (isset($_POST['firstName']) and $_POST['firstName']) ? $_POST['firstName'] : FALSE;
  $lastName=$this->data['lastName'] = (isset($_POST['lastName']) and $_POST['lastName']) ? $_POST['lastName'] : FALSE;
  $email=$this->data['email'] = (isset($_POST['email']) and $_POST['email']) ? $_POST['email'] : FALSE;
  $this->data['homePhone'] = (isset($_POST['homePhone']) and $_POST['homePhone']) ? $_POST['homePhone'] : FALSE;
  $this->data['mobilePhone'] = (isset($_POST['mobilePhone']) and $_POST['mobilePhone']) ? $_POST['mobilePhone'] : FALSE;
                
         
//         if (!$userName or ! $password or ! $repassword or ! $firstName or ! $lastName or !$email) {
//            $this->data['message'] = '** Please Enter All Required fields**';
//            $this->load->view('signup', $this->data);
//            return;
//        }
        
        if(!$this->user_model->validateUsername($userName))
        {
           $this->data['message'] = 'Username was already taken';
            $this->load->view('signup', $this->data);
            return;  
        }
        
//        if($password != $repassword ) {
//            $this->data['message'] = 'Passwords Must Match';
//            $this->load->view('signup',$this->data);
//        }
        
        $userData = $_POST;
        
          if ($this->user_model->createUser($userData)) {
            $this->data['message'] = 'Thank you for signing up with One Community.'
                    . '  The administrator will review your information and you will '
                    . 'receive an email once your signup has been approved';
            $this->load->view('login', $this->data);
            return;
        }
        
        

    }
}
