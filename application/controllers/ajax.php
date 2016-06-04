<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php

class Ajax extends CI_Controller {

    public function index() {
//TODO improve logic
        $this->load->model('database_model');
        $this->load->model('system_model');

        $module = $this->uri->segments['3'];
        $moduleRecord = $this->system_model->readModule($module);
        $model = $moduleRecord['model'];
        $table = $moduleRecord['masterTable'];
        $method = $this->uri->segments['4'];
        isset($this->uri->segments['5']) ? $parms = $this->uri->segments['5'] : $parms = null;

        $this->load->model($model);

        if(isset($_POST['data']) and ( $_POST['data'])){
            $this->data = json_decode($_POST['data'], true);
            $responseCode = $this->$model->$method($this->data);
            if($responseCode['success']){
                $this->data['headerData'] = $this->project_model->read('projects', 'id', 1);
                $this->data['detailData'] = $this->project_model->readTasksByProject(1);
                $this->data['response'] = $responseCode;
            } else {
                $this->data['response'] = $responseCode;
            }
        } else {
            $this->data['tableMeta'] = $this->database_model->readTableMetaData($table);
            $this->data['tableData'] = $this->$model->$method($parms);
        }
        echo json_encode($this->data);
        return;
    }

}
