<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {
    public function getUpdates(){
        $url = 'https://corona.lmao.ninja/countries/philippines';
        $data = json_decode(file_get_contents($url, false));
        
        $info = array(
            'country'=>$data->country,
            'cases'=>$data->cases,
            'todayCases'=>$data->todayCases,
            'deaths'=>$data->deaths,
            'todayDeaths'=>$data->todayDeaths,
            'recovered'=>$data->recovered,
            'critical'=>$data->critical,
            'casesPerOneMillion'=>$data->casesPerOneMillion,
            'activeCases'=> $data->cases - $data->recovered - $data->deaths,
            'closeCases'=> $data->recovered + $data->deaths,
        );
        $closeCases = $data->recovered + $data->deaths;
        $activeCases = $data->cases - $data->recovered - $data->deaths;
        $info['mildCases'] = $activeCases - $data->critical;

        $info['mildCasesCasesPercent'] = round( $info['mildCases'] / $activeCases * 100, 2);
        $info['criticalCasesCasesPercent'] = round( $data->critical / $activeCases * 100, 2);

        $info['recoverCasesPercent'] = round( $data->recovered / $closeCases * 100, 2);
        $info['deathsCasesPercent'] = round( $data->deaths / $closeCases * 100, 2);

        
        return $info;
    }
    public function getHistoricalData(){
        $url = 'https://corona.lmao.ninja/historical';
        $data = json_decode(file_get_contents($url, false));
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
