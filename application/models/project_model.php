<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Project_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function readTasksByProject($projectId) {
        $sql = 'SELECT *';
        $sql .= ' FROM tasks';
        $sql .= ' WHERE projectId = "' . $projectId . '"';
        $sql .= ' ORDER BY position';
        $result = $this->db->query($sql);
        if (!$result->num_rows() > 0) return false;
        foreach ($result->result_array() as $row) {
            $taskRows[$row['id']] = $row;
        }
        return $taskRows;
    }

    public function readProjectsByUser($userId) {
        $sql = 'SELECT *';
        $sql .= ' FROM projects';
        $sql .= ' WHERE id = "' . $userId . '"';
    }

    public function readTasksByUser($userId) {
        
    }

}
