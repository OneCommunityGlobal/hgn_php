<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Database_model extends CI_Model {

    public function readTableMetaData($table) {
        $metaRows = null;
        $sql = 'SELECT * FROM system_tables where tableName = "' . $table . '"';
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

    public function readTableLookups($tableMeta) {
        $lookupRows = null;
        $table = $tableMeta['tableName'];
        foreach ($tableMeta as $mk => $mv) {
            if ($mk === 'tableName') continue;
//            switch ($mv['lookupType']) {
//                case 1 :
//                    break;
//                case 2 :
                    $sql = 'SELECT * FROM system_lookups where id = "' . $mv['lookupId'] . '"';
                    $result = $this->db->query($sql);
//                    if (!$result->num_rows() > 0) return false;
//                    $lookupRows['tableName'] = $table;
                    foreach ($result->result_array() as $row) {
                        $lookupRows[$row["lookupId"]][$row["id"]] = $row;
                    }
//                    break;
//                default :
//                    break;
//            }
        }
        return $lookupRows;
    }

    //update a row in a table
    function updateRow($table, $data) {
        $columns = ' (';
        $values = ' (';
        $updValues = ' ';
        foreach ($data as $k => $v) {
            $colName = $k;
            if($colName === 'Submit' or $colName === 'actionInput') continue;
            $columns .= $colName . ',';
            $values .= '"' . $v . '"' . ',';
            if ($colName === 'id') continue;
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
        return $result ? $this->db->insert_id() : false;
    }

    function setDefaultData($tableMeta) {
        foreach($tableMeta as $k=>$v) {
            if($k === 'tableName') continue;
            $tableData[$v['columnName']] = $v['defaultValue'];
        }
        return $tableData;
    }
}
