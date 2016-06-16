<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model {

    /**
     * Class constructor
     *
     * @return	void
     */
    public function __construct() {
        
    }

    /* Begin code not belonging to CodeIgniter. Put all the standard CRUD functions here so they only have to
     * be written once and will be inherited by all models. 
     */

    //Recommended method of getting/setting properties is in array and use get/set.
    protected $_properties = [];

    //Standard record creation.  Will fail if index already exists.
    public function create($table) {
        $sql = 'Insert into ' . $table;
        $sqlCols = '(';
        $sqlVals = ' VALUES (';
        foreach($this->_properties as $k => $v) {
            if($v){
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
        return $result ? $inserted_id : false;
    }

    //Select a single row from a table and return as array of columns
    public function read($table, $lookupColumn = 'id', $lookupValue = null) {
        if(!$lookupValue) return false;
        $sql = 'SELECT * FROM ' . $table . ' where ' . $lookupColumn . ' = "' . $lookupValue . '" LIMIT 1';
        $result = $this->db->query($sql);
        $row = $result->row_array();
        return ($result->num_rows() > 0) ? $row : false;
    }

    //Select a single row from a table and return as array indexed by ID
    public function readById($table, $lookupColumn = 'id', $lookupValue = null) {
        if(!$lookupValue) return false;
        $sql = 'SELECT * FROM ' . $table . ' where ' . $lookupColumn . ' = "' . $lookupValue . '" LIMIT 1';
        $result = $this->db->query($sql);
        $row[$lookupValue] = $result->row_array();
        return ($result->num_rows() > 0) ? $row : false;
    }

    //Returns multiple rows from a table
    public function readMulti($table, $tableColumn = null, $columnValue = null) {
        $sql = 'SELECT * ';
        $sql .= ' FROM ' . $table;
        if($tableColumn and $columnValue){
            $sql .= ' where ' . $tableColumn . ' = "' . $table . '"';
        }
        $result = $this->db->query($sql);
        if(!$result->num_rows() > 0) return false;
        foreach($result->result_array() as $row) {
            $tableRows[$row['id']] = $row;
        }
        return $tableRows;
    }

    //Returns all rows from a table
    public function readAll($table, $columns = null) {
        $sql = 'SELECT * ';
        $sql .= ' FROM ' . $table;
        $result = $this->db->query($sql);
        if(!$result->num_rows() > 0) return false;
        foreach($result->result_array() as $row) {
            $tableRows[$row['id']] = $row;
        }
        return $tableRows;
    }

//    //Standard update function. Will create new record if index doesn't exist, updates record if it does exist.
//    function update($table, $data = null) {
//        $this->load->model('system_model');
//        $updated = $this->updateRow($table, $data);
//        return $updated ? $this->db->insert_id() : false;
//    }
    //update a row in a table
    function update($table, $data) {
        $columns = ' (';
        $values = ' (';
        $updValues = ' ';
        foreach($data as $k => $v) {
            $colName = $k;
            if($colName === 'Submit' or $colName === 'actionInput') continue;
            $columns .= $colName . ',';
            $values .= '"' . $v . '"' . ',';
            if($colName === 'id') continue;
            $updValues .= $k . '= "' . $v . '"' . ',';
        }

        $columns = rtrim($columns, ",") . ')';
        $values = rtrim($values, ",") . ')';
        $updValues = rtrim($updValues, ",");

        $sql = 'INSERT';
        $sql .= ' INTO ' . $table;
        $sql .= $columns;
        $sql .= ' VALUES ' . $values;
        $sql .= ' ON DUPLICATE KEY UPDATE';
        $sql .= $updValues;
        $result = $this->db->query($sql);
        return $result;
    }

    function updateView($data) {
        $header = $data["header"];
        $detail = $data["detail"];

        if(!count($header) > 0 and ! count($detail) > 0){
            $response['success'] = false;
            $response['cbMethod'] = 'redrawPage';
            echo json_encode($response);
            return;
        }

        $this->beginTransaction();

        if(count($header) > 0){
            $table = $data['headerTable'];
            foreach($header as $k => $v) {
                $changeType = $v['changeType'];
                unset($v['changeType']);
                switch($changeType) {
                    case 'u' :
                        $headerUpdated = $this->update($table, $v);
                        break;
                    default :
                        break;
                }
            }
        }

        if(count($detail) > 0){
            $table = $data['detailTable'];
            foreach($detail as $k => $v) {
                $changeType = $v['changeType'];
                unset($v['changeType']);
                switch($changeType) {
                    case 'u' :
                        $detailUpdated = $this->update($table, $v);
                        break;
                    default :
                        break;
                }
            }
        }

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $response['success'] = false;
            $response['cbMethod'] = 'redrawPage';
            return $response;
        } else {
            $this->commitTransaction();
            $response['success'] = true;
            $response['cbMethod'] = 'redrawPage';
            return $response;
        }

        //should never get here
        return $response;
    }

    //Standard delete function. Deletes a single record.
    public function delete($table, $id) {
        $sql = 'DELETE FROM ' . $table . ' where id = "' . $id . '"';
        $result = $this->db->query($sql);
        return $result ? true : false;
    }

    function beginTransaction() {
        $this->db->trans_begin();
    }

    function autoCommit($value) {
        $this->db->trans_off();
        return;
    }

    function commitTransaction() {
        $this->db->trans_commit();
        return;
    }

    function rollbackTransaction() {
        $this->db->trans_rollback();
        return;
    }

    //Property getter
    public function get($property) {
        //array_key_exists ( mixed $key , array $array )
        if(array_key_exists($property, $this->_properties)){
            return $this->_properties[$property];
        } else {
            return false;
        }
    }

    //Property setter
    public function set($property, $value = null) {
        if(is_array($property)){
            $arrkeys = array_keys($this->_properties);
            foreach($property as $k => $v) {
                if(is_numeric($k)){
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

    // --------------------------------------------------------------------

    /**
     * __get magic
     *
     * Allows models to access CI's loaded classes using the same
     * syntax as controllers.
     *
     * @param	string	$key
     */
    public function __get($key) {
        // Debugging note:
        //	If you're here because you're getting an error message
        //	saying 'Undefined Property: system/core/Model.php', it's
        //	most likely a typo in your model code.
        return get_instance()->$key;
    }

}
