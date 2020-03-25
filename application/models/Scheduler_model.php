<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scheduler_model extends CI_Model {
    public function getCasesDataNotify($country = 'philippines'){
        $url = 'https://corona.lmao.ninja/countries/'.$country;
        $data = json_decode(file_get_contents($url, false));
        
        $dataCases = array(
            'cases'=>$data->cases,
            'todayCases'=>$data->todayCases,
            'deaths'=>$data->deaths,
            'todayDeaths'=>$data->todayDeaths,
            'recovered'=>$data->recovered,
            'activeCases'=> $data->cases - $data->recovered - $data->deaths,
        );

        $this->session->set_tempdata($dataCases, 60);
        $cases = 656;
        if($cases > $this->session->cases){
            $notify['newCase'] = 'New Confirmed Cases Added';
            $this->notifyUsers();
        }

        if($data->deaths > $this->session->deaths){
            $notify['newDeath'] = 'New Death Cases Added';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($notify));
    }
    public function notifyUsers(){
        $data = $this->db->GET('email_list')->result_array();

        foreach($data as $d){
            $this->sendEmailNotification($d['email_address']);
        }
    }
    public function sendEmailNotification($email_address){
        
    }
}