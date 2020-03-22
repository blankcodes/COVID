<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {
    public function getAPIData(){
        $countryInput = $this->input->get('country');
        $url = 'https://corona.lmao.ninja/countries/'.$countryInput;
        $data = json_decode(file_get_contents($url, false));
        
        $dataInfo = array(
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
        $dataInfo['mildCases'] = $activeCases - $data->critical;

        $dataInfo['mildCasesCasesPercent'] = round( $dataInfo['mildCases'] / $activeCases * 100, 2);
        $dataInfo['criticalCasesCasesPercent'] = round( $data->critical / $activeCases * 100, 2);

        $dataInfo['recoverCasesPercent'] = round( $data->recovered / $closeCases * 100, 2);
        $dataInfo['deathsCasesPercent'] = round( $data->deaths / $closeCases * 100, 2);

        // return $dataInfo;
        $this->output->cache('15');
        $this->output->set_content_type('application/json')->set_output(json_encode($dataInfo));

    }
    public function getHistoricalData(){
        $url = 'https://corona.lmao.ninja/historical';
        $data = json_decode(file_get_contents($url, false));
        if($data > 0){
            $dataInfo = array();
            foreach($data as $d){
                $array = array(
                    'country'=>$d->country,
                    'timeline'=>$d->timeline,
                );
                array_push($dataInfo, $array); 
            }
            $this->output->cache('15');
            $dataInfo['status'] = 'Connected';
        }
        else{
            $dataInfo['status'] = 'Connection Timeout';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($dataInfo));
    }

    function getHistoricalDataDeaths(){
        $url = 'https://corona.lmao.ninja/historical';
        $data = json_decode(file_get_contents($url, false));
        $dataInfo = array();
        foreach($data as $d){
            $array = array(
               'country'=>$d->country,
               'timeline'=>$d->timeline,
            );
            array_push($dataInfo, $array); 
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($dataInfo));
    }
}
