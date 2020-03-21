<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {
    public function getUpdates(){
        $url = 'https://corona.lmao.ninja/countries/philippines';
        $data = json_decode(file_get_contents($url, false));
        return $data;
    }
    public function getHistoricalData(){
        $url = 'https://corona.lmao.ninja/historical';
        $data = json_decode(file_get_contents($url, false));
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
