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

    public $resultArray;
    public $numRows;

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
            $metaRows[$row["title"]] = $row;
        }
        return $metaRows;
    }

}
