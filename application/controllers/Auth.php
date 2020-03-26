<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');

class Auth extends CI_Controller {
    function __construct(){ 
        parent::__construct();
        $this->load->model('Auth_model');
    }
    public function saveEmail(){
        $this->Auth_model->saveEmail();
    }
}