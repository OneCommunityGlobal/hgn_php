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
class System_model extends CI_Model {

    /**
     * Short description
     * 
     * Longer description
     * 
     * @todo
     *
     * @access	public
     * @global 	type    $globlvarname   Documents a global variable or its use in a function or method
     * @name    global  var name        Specifies an alias for a variable. For example, $GLOBALS['myvariable'] becomes $myvariable
     * @param	type    name            short description
     * @return	type    name            short description
     */
    //Select a single row from a table.
    public function sampleReadSingleRow($table, $lookupColumn = null, $lookupValue = null) {
        if (!$lookupColumn or ! $lookupValue) return false;
        $sql = 'SELECT * FROM ' . $table . ' where ' . $lookupColumn . ' = "' . $lookupValue . '" LIMIT 1';
        $result = $this->db->query($sql);
        $row = $result->row_array();
        return ($result->num_rows() > 0) ? $row : false;
    }

    //Returns multiple rows from a table
    public function sampleReadMultiRow($table, $tableColumn = null, $columnValue = null) {
        $sql = 'SELECT * ';
        $sql .= ' FROM ' . $table;
        if ($tableColumn and $columnValue) {
            $sql .= ' where ' . $tableColumn . ' = "' . $table . '"';
        }
        $result = $this->db->query($sql);
        if (!$result->num_rows() > 0) return false;
        foreach ($result->result_array() as $row) {
            $tableRows[$row['id']] = $row;
        }
        return $tableRows;
    }

    //Returns all rows from a table
    public function sampleReadAll($table, $columns = null) {
        $sql = 'SELECT * ';
        $sql .= ' FROM ' . $table;
        $result = $this->db->query($sql);
        if (!$result->num_rows() > 0) return false;
        foreach ($result->result_array() as $row) {
            $tableRows[$row['id']] = $row;
        }
        return $tableRows;
    }

}
