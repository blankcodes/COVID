<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scheduler_model extends CI_Model {
    function __construct(){
        parent::__construct();
        $this->load->library('email');
    }
    public function getCasesDataNotify($country = 'philippines'){
        $url = 'https://corona.lmao.ninja/countries/'.$country;
        $data = json_decode(file_get_contents($url, false));

        $dataCases = array(
            'country'=>$data->country,
            'cases'=>$data->cases,
            'todayCases'=>$data->todayCases,
            'deaths'=>$data->deaths,
            'todayDeaths'=>$data->todayDeaths,
            'recovered'=>$data->recovered,
        );
        
        $notify['cases'] = $dataCases;
        $notify['msg'] = 'none';
        if(isset($this->session->cases)){
            $notify['msg'] = 'session';
            if ($data->cases > $this->session->cases){
                $notify['msg'] = 'new cases reported';
                $notify['previousCase'] = $this->session->tempdata('cases');
                $notify['casesReported'] = $data->cases - $this->session->cases;

                 /* send email for notification if there's new confirmed cases*/
                $this->notifyUsers($dataCases);
                $this->session->; 
                $this->session->set_userdata('cases', $data->cases); 
            }
        }
        else{
            $this->session->set_tempdata('cases', $data->cases); 
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($notify));
    }
    public function notifyUsers($dataCases){
        $data = $this->db->GET('email_list')->result_array();

        foreach($data as $d){
            $this->sendEmailNotification($dataCases, $d['email_address']);
        }
    }
    public function sendEmailNotification($dataCases, $email_address){
        $config = array (
			'mailtype' => 'html',
			'charset'  => 'utf-8',
			'priority' => '1'
		);
		$data['email_address'] = $email_address;
		$data['country'] = $dataCases['country'];
		$data['cases'] = $dataCases['cases'];
		$data['todayCases'] = $dataCases['todayCases'];
		$data['deaths'] = $dataCases['deaths'];
		$data['todayDeaths'] = $dataCases['todayDeaths'];
		$data['recovered'] = $dataCases['recovered'];
		$this->email->initialize($config);
		$this->email->from('no-reply@kenkarlo.com', 'Updates for COVID-19');
		$this->email->to($email_address);
		$this->email->subject('Update Nofitication for COVID-19');
		$body = $this->load->view('email/email_notify', $data, TRUE);
		$this->email->message($body);
		$this->email->send();
    }
    public function sendEmail(){
        $country = 'philippines';
        $url = 'https://corona.lmao.ninja/countries/'.$country;
        $data = json_decode(file_get_contents($url, false));
        $dataCases = array(
            'country'=>$data->country,
            'cases'=>$data->cases,
            'todayCases'=>$data->todayCases,
            'deaths'=>$data->deaths,
            'todayDeaths'=>$data->todayDeaths,
            'recovered'=>$data->recovered,
            'activeCases'=> $data->cases - $data->recovered - $data->deaths,
        );

        $emailList = $this->db->GET('email_list')->result_array();

        foreach($emailList as $d){
            $this->sendEmailNotification($dataCases, $d['email_address']);
        }
    }

    public function testNotify(){
        $url = 'https://kenkarlo.com/test/get-api-data';
        $data = json_decode(file_get_contents($url, false));
        
        $dataCases = array(
            'cases'=>$data->cases,
            'recovered'=>$data->recovered,
            'deaths'=>$data->deaths,
        );
        $notify['cases'] = $data;
        $notify['msg'] = 'none';
        if(isset($this->session->cases)){
            $notify['msg'] = 'session';
            $notify['previousCase'] = $this->session->tempdata('cases');
            if ($data->cases > $this->session->cases){
                $notify['msg'] = 'new cases reported';
                $notify['casesReported'] = $data->cases - $this->session->cases;
                $this->notifyUsers($dataCases); /* send email for notification if there's new confirmed cases*/
            }
        }
        else{
            $this->session->set_tempdata('cases', $data->cases, 420); /*420*/
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($notify));
        
    }
}