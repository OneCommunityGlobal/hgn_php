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
            $data = json_decode($_POST['data'], true);
            $responseCode = $this->$model->$method($data);
            if($responseCode['success']){
                $data['headerData'] = $this->project_model->read('projects', 'id', 1);
                $data['detailData'] = $this->project_model->readTasksByProject(1);
                $data['response'] = $responseCode;
            } else {
                $data['response'] = $responseCode;
            }
        } else {
            $data['tableMeta'] = $this->database_model->readTableMetaData($table);
            $data['tableData'] = $this->$model->$method($parms);
        }
        echo json_encode($data);
        return;
    }

}
