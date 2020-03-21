<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Api_model');
    }
	public function index() {   
        $data['getInfo'] = $this->Api_model->getUpdates();
		$this->load->view('home/index', $data);
    }
    public function getHistoricalData(){
        $this->Api_model->getHistoricalData();
    }
    
}   
