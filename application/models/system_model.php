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
    public function readSelectors($table) {
        $selectors = null;
        $sql = 'SELECT id, title FROM ' . $table;
        $result = $this->db->query($sql);
        if(!$result->num_rows() > 0){
            return false;
        }
        foreach($result->result_array() as $row) {
            $selectors[$row["id"]]["value"] = $row["id"];
            $selectors[$row["id"]]["title"] = $row["title"];
        }
        $row['selectors'] = $selectors;
        return $selectors;
    }

    public function readLookup($lookupId) {
        $this->read('lookups', 'id', $lookupId);
        $lookupRows = null;
        $sql = 'SELECT';
        $sql .= ' sl.*';
        $sql .= ' ,slv.id as `slv.id`, slv.title as `slv.title`, slv.description as `slv.description`';
        $sql .= ' ,slv.value';
        $sql .= ' FROM system_lookups as sl';
        $sql .= ' INNER JOIN system_lookup_values as slv on slv.systemLookupId = l.id';
        $sql .= ' where l.id = "' . $mv['systemLookupId'] . '"';
        $result = $this->db->query($sql);
        if(!$result->num_rows() > 0) return false;
        foreach($result->result_array() as $row) {
            $lookupRows[$row["title"]][$row["slv.id"]] = $row;
        }
        return $lookupRows;
    }

    public function readLookupAll($tableMeta = null) {
        if(!$tableMeta) return false;
        $lookupRows = null;
        foreach($tableMeta as $mk => $mv) {
            if($mk === 'tableName' or $mv['systemLookupId'] == 0) continue;
            $sql = 'SELECT';
            $sql .= ' sl.*';
            $sql .= ' ,slv.id as `slv.id`, slv.title as `slv.title`, slv.description as `slv.description`';
            $sql .= ' ,slv.value';
            $sql .= ' FROM system_lookups as sl';
            $sql .= ' LEFT JOIN system_lookup_values as slv on slv.systemLookupId = sl.id';
            $sql .= ' where sl.id = "' . $mv['systemLookupId'] . '"';
            $result = $this->db->query($sql);
            if(!$result->num_rows() > 0) return false;
            foreach($result->result_array() as $row) {
                if($row['lookupType'] == 1){
                    $lookupRows[$row["id"]][$row["slv.id"]]['value'] = $row['value'];
                    $lookupRows[$row["id"]][$row["slv.id"]]['title'] = $row['slv.title'];
                } else {
                    $tmpRows = $this->system_model->readMulti($row['lookupTable']);
                    foreach($tmpRows as $tk => $tv) {
                        $lookupRows[$row["id"]][$tv["id"]]['value'] = $tv['id'];
                        $lookupRows[$row["id"]][$tv["id"]]['title'] = $tv['title'];
                    }
                }
            }
        }
        return $lookupRows;
    }

    //Select a single row from a table.
    public function readModule($module) {
        if(!$module or ! $module) return false;
        $sql = 'SELECT * FROM system_modules where title = "' . $module . '" LIMIT 1';
        $result = $this->db->query($sql);
        $row = $result->row_array();
        return ($result->num_rows() > 0) ? $row : false;
    }

    function setDefaultData($tableMeta) {
        if(!$tableMeta) return false;
        foreach($tableMeta as $k => $v) {
            if($k === 'tableName') continue;
            $tableData[$v['title']] = $v['defaultValue'];
        }
        return $tableData;
    }

    //Select a single row from a table.
    public function sampleReadSingleRow($table, $lookupColumn = null, $lookupValue = null) {
        if(!$lookupColumn or ! $lookupValue) return false;
        $sql = 'SELECT * FROM ' . $table . ' where ' . $lookupColumn . ' = "' . $lookupValue . '" LIMIT 1';
        $result = $this->db->query($sql);
        $row = $result->row_array();
        return ($result->num_rows() > 0) ? $row : false;
    }

    //Returns multiple rows from a table
    public function sampleReadMultiRow($table, $tableColumn = null, $columnValue = null) {
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
    public function sampleReadAll($table, $columns = null) {
        $sql = 'SELECT * ';
        $sql .= ' FROM ' . $table;
        $result = $this->db->query($sql);
        if(!$result->num_rows() > 0) return false;
        foreach($result->result_array() as $row) {
            $tableRows[$row['id']] = $row;
        }
        return $tableRows;
    }

}
