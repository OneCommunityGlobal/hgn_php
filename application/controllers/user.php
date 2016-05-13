<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    /* by declaring this _remap function, it forces all calls to the Home controller
     * to first call this function.  This allows displaying the header page and the
     * footer page once.
     */

    public function _remap($method, $params = array()) {
        $data['title'] = PAGE_TITLE;
        $data['loggedIn'] = $loggedIn = false;

        $this->load->view('common/wrapper_top', $data);
        if (DISPLAY_HEADER) {
            $this->load->view('common/header', $data);
        }

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
        return;
    }

    public function login() {
        $this->load->model('user_model');
        $this->load->library('user');

        $data['title'] = PAGE_TITLE . ' - Login';

        //this should never be true
        if (!isset($_POST['userName'])) {
            $this->load->view('login', $data);
            return;
        }

        $userName = (isset($_POST['userName']) and $_POST['userName']) ? $_POST['userName'] : FALSE;
        $password = (isset($_POST['password']) and $_POST['password']) ? $_POST['password'] : FALSE;

        if (!$userName or ! $password) {
            $data['message'] = '**Username And Password Are Required**';
            $this->load->view('login', $data);
            return;
        }

        if (!$this->user_model->validateUsernamePassword($userName, $password)) {
            $data['message'] = 'The Username Password Combination Is Not Valid';
            $this->load->view('login', $data);
            return;
        }

//        if(!$this->user_model->getPreference('verified')) {
//                $data['message'] = 'This account has not been verified.  Please check your email for a
//                verification message.';
//                $this->load->view('user_login', $data);
//                return;
//        }
//
//        if(!$this->user_model->getPreference('verifiedByAdmin')) {
//                $data['message'] = 'This account has not been approved.  Please wait for an administrator to 
//                approve it.';
//                $this->load->view('user_login', $data);
//                return;
//        }
//
        $_SESSION["userId"] = $this->user_model->get('id');
        $_SESSION["userName"] = $this->user_model->get('userName');
        $_SESSION["password"] = $this->user_model->get('password');
        $_SESSION["admin"] = $this->user_model->get('admin');

        header('Location: ' . BASE_URL . 'home');
        exit;
    }

    public function logout() {
        $this->session->sess_destroy();
        header('Location: ' . BASE_URL . 'home');
        exit;
    }

    //old logic may use later?
//    public function signup() {
//        if (false) {
//            //add to database
//            $passwordHashed = $this->user_model->create();
//            //set cookies
//            $sessData = array(
//                'userName' => $this->input->post('userName'),
//                'password' => $passwordHashed,
//                'loggedIn' => TRUE
//            );
//            $this->session->set_userdata($sess_data);
//            redirect('home');
//        } else {
//            $data['loggedIn'] = FALSE;
//            $data['userName'] = 'Mr. Sandman - Sign Up';
//            $this->load->view('signup');
//        }
//    }
}
