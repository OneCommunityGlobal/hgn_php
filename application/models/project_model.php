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
class Project_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function readTasksByProject($projectId) {
        $sql = 'SELECT *';
        $sql .= ' FROM tasks';
        $sql .= ' WHERE projectId = "' . $projectId . '"';
        $sql .= ' ORDER BY parentId, position';
        $result = $this->db->query($sql);
        if (!$result->num_rows() > 0) return false;
        foreach ($result->result_array() as $row) {
            $taskRows[$row['id']] = $row;
        }
        return $taskRows;
    }

    public function readProjectsByUser($userId) {
        $sql = 'SELECT pr.*';
        $sql .= ' FROM projects as pr';
        $sql .= ' JOIN project_to_users as p2u on p2u.projectId = pr.id';
        $sql .= ' WHERE p2u.userId = "' . $userId . '"';
        $result = $this->db->query($sql);
        if (!$result->num_rows() > 0) return false;
        foreach ($result->result_array() as $row) {
            $tableRows[$row['id']] = $row;
        }
        return $tableRows;
    }

    public function readTasksByUser($userId) {
        $sql = 'SELECT';
        $sql .= ' pr.id as pr_id, pr.title as pr_title, pr.description as pr_description, pr.*';
        $sql .= ' ,ta.id as ta_id, ta.title as ta_title, ta.description as ta_description, ta.*';
        $sql .= ' FROM projects as pr';
        $sql .= ' JOIN tasks as ta on ta.projectId = pr.id';
        $sql .= ' JOIN task_to_users as t2u on t2u.taskId = ta.id';
        $sql .= ' WHERE t2u.userId = "' . $userId . '"';
        $result = $this->db->query($sql);
        if (!$result->num_rows() > 0) return false;
        foreach ($result->result_array() as $row) {
            $tableRows[$row['ta_id']] = $row;
        }
        return $tableRows;
    }

}
