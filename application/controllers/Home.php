<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');

class Home extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Api_model');
    }
	public function index() {   
        // $data['cases'] = $this->Api_model->getCasesData();
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
    public function getRssFeed(){
        $this->Api_model->getRssFeed();
    }
    public function webScrape(){
        $this->Api_model->webScrape();
    }
    
}   
