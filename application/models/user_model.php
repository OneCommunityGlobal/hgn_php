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
 * @category	models
 * @author	HGN Dev Team
 */
class User_model extends CI_Model {

    public function isLoggedIn() {
        //check if session vars are set with username/password
        $userName = isset($_SESSION['userName']) ? $_SESSION['userName'] : FALSE;
        if (!$userName) {
            $this->session->sess_destroy();
            return false;
        }

        $password = isset($_SESSION['password']) ? $_SESSION['password'] : FALSE;
        if ($userName and $password) {
            if (!$this->validateUsernamePassword($userName, $password)) {
                $this->session->sess_destroy();
                return false;
            }
        } else {
            $this->session->sess_destroy();
            return false;
        }
        return true;
    }

    public function validateUsernamePassword($userName = NULL, $password = NULL) {
        $sql = 'SELECT * from `users`';
        $sql .= ' where userName = "' . strtolower($userName) . '"';
        $result = $this->db->query($sql);
//TODO  Add password hashing
        if (isset($result->row_array()['password']) and $result->row_array()['password'] === $password) {
            foreach ($result->row_array() as $k => $v) {
                $this->set($k, $v);
            }
            return true;
        } else {
            return false;
        }
    }

}
