<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Api_model');
    }
	public function index() {   
        // $data['getInfo'] = $this->Api_model->getAPIData();
		$this->load->view('home/index');
		$this->load->view('home/footer');
    }
    public function getHistoricalData(){
        $this->Api_model->getHistoricalData();
    }
    public function getAPIData(){
        $this->Api_model->getAPIData();
    }
    public function getHistoricalDataDeaths(){
        $this->Api_model->getHistoricalDataDeaths();
    }
    
}   
