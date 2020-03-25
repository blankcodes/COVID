<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');

class Schedule extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Scheduler_model');
    }
    public function getCasesDataNotify(){
        $this->Scheduler_model->getCasesDataNotify();
    }
}