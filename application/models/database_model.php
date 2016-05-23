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
class Database_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function readTableMetaData($table) {
        $metaRows = null;
        $sql = 'SELECT * ';
        $sql .= ' FROM system_tables as `st`';
        $sql .= ' JOIN system_table_columns as `stc` on stc.systemTableId = st.id';
        $sql .= ' where st.title = "' . $table . '"';
        $result = $this->db->query($sql);
        if (!$result->num_rows() > 0) return false;
        $metaRows['tableName'] = $table;
        foreach ($result->result_array() as $row) {
            $metaRows[$row["id"]] = $row;
        }
        return $metaRows;
    }

    public function readSelectors($table) {
        $selectors = null;
        $sql = 'SELECT id, title FROM ' . $table;
        $result = $this->db->query($sql);
        if (!$result->num_rows() > 0) {
            return false;
        }
        foreach ($result->result_array() as $row) {
            $selectors[$row["id"]]["value"] = $row["id"];
            $selectors[$row["id"]]["title"] = $row["title"];
        }
        $row['selectors'] = $selectors;
        return $selectors;
    }

    function setDefaultData($tableMeta) {
        if(!$tableMeta) return false;
        foreach ($tableMeta as $k => $v) {
            if ($k === 'tableName') continue;
            $tableData[$v['title']] = $v['defaultValue'];
        }
        return $tableData;
    }

}
