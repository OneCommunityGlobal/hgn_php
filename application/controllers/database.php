<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php

//controller for running utilities such as loading tables
class Database extends CI_Controller {

    //example utility for adding records to a Mysql table
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
