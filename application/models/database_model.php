<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

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
            return $this->failMessage;
        }
        foreach ($result->result_array() as $row) {
            $selectors[$row["id"]]["value"] = $row["id"];
            $selectors[$row["id"]]["title"] = $row["title"];
        }
        $row['selectors'] = $selectors;
        return $selectors;
    }

    function setDefaultData($tableMeta) {
        foreach ($tableMeta as $k => $v) {
            if ($k === 'tableName') continue;
            $tableData[$v['title']] = $v['defaultValue'];
        }
        return $tableData;
    }

}
