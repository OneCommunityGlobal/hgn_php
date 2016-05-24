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
        $sql .= ' sl.*';
        $sql .= ' ,slv.id as `slv.id`, slv.title as `slv.title`, slv.description as `slv.description`';
        $sql .= ' ,slv.value';
        $sql .= ' FROM system_lookups as sl';
        $sql .= ' INNER JOIN system_lookup_values as slv on slv.lookupId = l.id';
        $sql .= ' where l.id = "' . $mv['lookupId'] . '"';
        $result = $this->db->query($sql);
        if (!$result->num_rows() > 0) return false;
        foreach ($result->result_array() as $row) {
            $lookupRows[$row["title"]][$row["slv.id"]] = $row;
        }
        return $lookupRows;
    }

    public function readLookupAll($tableMeta=null) {
        if(!$tableMeta) return false;
        $lookupRows = null;
        foreach ($tableMeta as $mk => $mv) {
            if ($mk === 'tableName' or $mv['lookupId'] == 0) continue;
            $sql = 'SELECT';
            $sql .= ' sl.*';
            $sql .= ' ,slv.id as `slv.id`, slv.title as `slv.title`, slv.description as `slv.description`';
            $sql .= ' ,slv.value';
            $sql .= ' FROM system_lookups as sl';
            $sql .= ' LEFT JOIN system_lookup_values as slv on slv.lookupId = sl.id';
            $sql .= ' where sl.id = "' . $mv['lookupId'] . '"';
            $result = $this->db->query($sql);
            if (!$result->num_rows() > 0) return false;
            foreach ($result->result_array() as $row) {
                if ($row['lookupType'] == 1) {
                    $lookupRows[$row["title"]][$row["slv.id"]]['value'] = $row['value'];
                    $lookupRows[$row["title"]][$row["slv.id"]]['title'] = $row['slv.title'];
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
