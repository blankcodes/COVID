<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');

class Schedule extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Scheduler_model');
        $this->load->library('email');
    }
    public function getCasesDataNotify(){
        $this->Scheduler_model->getCasesDataNotify();
    }
    public function testNotify(){ /*test notification data*/
      $this->Scheduler_model->testNotify();
  }
    public function showEmail(){ /* show email*/
		$this->load->view('email/email_notify');
    }
    public function sendEmail(){ /* test email*/
		$this->Scheduler_model->sendEmail();
    }
}