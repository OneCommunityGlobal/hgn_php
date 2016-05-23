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
class Lookup_model extends CI_Model {

    public function readLookup($lookupId) {
        $this->read('lookups', 'id', $lookupId);
        $lookupRows = null;
        $sql = 'SELECT';
        $sql .= ' l.*';
        $sql .= ' ,lv.id as `lv.id`, lv.title as `lv.title`, lv.description as `lv.description`';
        $sql .= ' ,lv.value';
        $sql .= ' FROM lookups as l';
        $sql .= ' INNER JOIN lookup_values as lv on lv.lookupId = l.id';
        $sql .= ' where l.id = "' . $mv['lookupId'] . '"';
        $result = $this->db->query($sql);
        if (!$result->num_rows() > 0) return false;
        foreach ($result->result_array() as $row) {
            $lookupRows[$row["title"]][$row["lv.id"]] = $row;
        }
        return $lookupRows;
    }

    public function readLookupAll($tableMeta=null) {
        if(!$tableMeta) return false;
        $lookupRows = null;
        foreach ($tableMeta as $mk => $mv) {
            if ($mk === 'tableName' or $mv['lookupId'] == 0) continue;
            $sql = 'SELECT';
            $sql .= ' lu.*';
            $sql .= ' ,lv.id as `lv.id`, lv.title as `lv.title`, lv.description as `lv.description`';
            $sql .= ' ,lv.value';
            $sql .= ' FROM lookups as lu';
            $sql .= ' LEFT JOIN lookup_values as lv on lv.lookupId = lu.id';
            $sql .= ' where lu.id = "' . $mv['lookupId'] . '"';
            $result = $this->db->query($sql);
            if (!$result->num_rows() > 0) return false;
            foreach ($result->result_array() as $row) {
                if ($row['lookupType'] == 1) {
                    $lookupRows[$row["title"]][$row["lv.id"]]['value'] = $row['value'];
                    $lookupRows[$row["title"]][$row["lv.id"]]['title'] = $row['lv.title'];
                } else {
                    $tmpRows = $this->database_model->readMulti($row['lookupTable']);
                    foreach ($tmpRows as $tk => $tv) {
                        $lookupRows[$row["title"]][$tv["id"]]['value'] = $tv['id'];
                        $lookupRows[$row["title"]][$tv["id"]]['title'] = $tv['title'];
                    }
                }
            }
        }
        return $lookupRows;
    }

}
