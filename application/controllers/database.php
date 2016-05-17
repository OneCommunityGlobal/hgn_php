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
 * HGN Database utilities
 *
 * This class contains/will contain misc. utilities for the database, e.g. creating tables and loading
 * with data.
 *
 * @package     HGN
 * @subpackage	
 * @category	contollers
 * @author	HGN Dev Team
 */
class Database extends CI_Controller {

    public function createMysql() {
        $this->db->truncate('system_tables');
        $this->load->model('database_model');
        $tableMeta = [
            ["id" => "1", "tableName" => "categories", "columnName" => "id", "position" => "1", "label" => "Category Id", "keyType" => "1", "visible" => "0", "dataType" => "int(11)"],
            ["id" => "2", "tableName" => "categories", "columnName" => "title", "position" => "2", "label" => "Title", "keyType" => "2", "visible" => "1", "dataType" => "varchar(30)"],
            ["id" => "3", "tableName" => "categories", "columnName" => "description", "position" => "3", "label" => "Description", "keyType" => "0", "visible" => "1", "dataType" => "varchar(255)"]
        ];
        $tableMeta1 = [
            ["1", "categories", "id", "1", "Category Id", "1", "0", "int(11)"],
            ["2", "categories", "title", "2", "Title", "2", "1", "varchar(30)"],
            ["3", "categories", "description", "3", "Description", "0", "1", "varchar(255)"]
        ];
        foreach ($tableMeta as $k => $v) {
            $this->database_model->set($v);
            $this->database_model->create('system_tables');
        }
    }

}
