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
            'activeCases'=> $data->cases - $data->recovered - $data->deaths,
        );
        $notify['newCase'] = 'None so far :)';
        if(isset($this->session->cases)){
            if($data->cases > $this->session->cases){
                $notify['newCase'] = 'New Confirmed Cases Added';
                $this->notifyUsers($dataCases); /* send email for notification if there's new confirmed cases*/
            }
        }
        else{
            $this->session->set_tempdata($dataCases, 420);
        }

        // test cron
        // $notify['newCase'] = 'Sending...';
        // $this->notifyUsers($dataCases); /* send email for notification if there's new confirmed cases*/

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
    
}