<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

//Standard CRUD section
class User_model extends CI_Model {

    protected $_properties = [];

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

    public function create($table) {
        $sql = 'Insert into ' . $table;
        $sqlCols = '(';
        $sqlVals = ' VALUES (';
        foreach ($this->_properties as $k => $v) {
            if ($v) {
                $sqlCols .= '`' . $k . '`,';
                $sqlVals .= $this->db->escape($v) . ',';
            }
        }
        $sqlCols = rtrim($sqlCols, ',');
        $sqlVals = rtrim($sqlVals, ',');
        $sqlCols .= ')';
        $sqlVals .= ')';
        $sql .= $sqlCols . $sqlVals;

        $result = $this->db->query($sql);
        $inserted_id = $this->db->insert_id();
        return $result ? $inserted_id : $this->failMessage;
    }

    public function read($table, $tableColumn = 'id', $columnValue = null, $orderBy = null) {
        $sql = 'SELECT * FROM ' . $table . ' where ' . $tableColumn . ' = "' . $columnValue . '"';
        if ($orderBy) $sql .= ' ORDER BY "' . $orderBy . '"';
        $result = $this->db->query($sql);
        $row = $result->row_array();
        return ($result->num_rows() > 0) ? $row : $this->failMessage;
    }

    function update($table, $data = null) {
        $this->load->model('database_model');
        $updated = $this->database_model->updateRow($table, $data);
        return $updated ? $this->db->insert_id() : false;
    }

    public function delete($table, $id) {
        $sql = 'DELETE FROM ' . $table . ' where id = "' . $id . '"';
        $result = $this->db->query($sql);
        return $result ? true : false;
    }

    public function get($property) {
        //array_key_exists ( mixed $key , array $array )
        if (array_key_exists($property, $this->_properties)) {
            return $this->_properties[$property];
        } else {
            return false;
        }
    }

    public function set($property, $value = null) {
        if (is_array($property)) {
            $arrkeys = array_keys($this->_properties);
            foreach ($property as $k => $v) {
                if (is_numeric($k)) {
                    $key = $arrkeys[$k];
                    $this->_properties[$key] = $v;
                } else {
                    $this->_properties[$k] = $v;
                }
            }
            return true;
        } else {
            $this->_properties[$property] = $value;
        }
    }

}
