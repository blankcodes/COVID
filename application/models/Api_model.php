<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {
    public function getAPIData(){
        $globalRecord = $this->globalRecordData();
        $countryInput = $this->input->get('country');
        $url = 'https://disease.sh/v2/countries/'.$countryInput;
        $data = json_decode(file_get_contents($url, false));
        
        $dataInfo = array(
            'country'=>$data->country,
            'cases'=>number_format($data->cases),
            'todayCases'=>number_format($data->todayCases),
            'deaths'=>number_format($data->deaths),
            'todayDeaths'=>number_format($data->todayDeaths),
            'recovered'=>number_format($data->recovered),
            'critical'=>number_format($data->critical),
            'activeCases'=> number_format($data->cases - $data->recovered - $data->deaths),
            'closeCases'=> number_format($data->recovered + $data->deaths),
            'casesPerOneMillion'=>number_format($data->casesPerOneMillion),
        );
        $closeCases = $data->recovered + $data->deaths;
        $activeCases = $data->cases - $data->recovered - $data->deaths;
        $mild_cases = $activeCases - $data->critical;

        $dataInfo['mildCasesCasesPercent'] =  round($mild_cases / $activeCases * 100, 2);
        $dataInfo['criticalCasesCasesPercent'] =  round($data->critical / $activeCases * 100, 2);

        $dataInfo['recoverCasesPercent'] =  round($data->recovered / $closeCases * 100, 2);
        $dataInfo['deathsCasesPercent'] =  round($data->deaths / $closeCases * 100, 2);

        $globalTotalCloseCases = round($globalRecord->deaths +  $globalRecord->recovered, 2);
        $dataInfo['globalPercentRecovered'] = round($globalRecord->recovered / $globalTotalCloseCases * 100, 2);
        $dataInfo['globalDeathsRecovered']  =  round($globalRecord->deaths / $globalTotalCloseCases * 100, 2);
        
        $dataInfo['globalTotalCloseCases'] = number_format($globalTotalCloseCases);
        $dataInfo['mildCases'] = number_format($mild_cases);
        $dataInfo['totalGlobalCase'] = number_format($globalRecord->cases);
        $dataInfo['totalGlobalRecoveredCase'] = number_format($globalRecord->recovered);
        $dataInfo['totalGlobalDeathCase'] = number_format($globalRecord->deaths);

        $dataInfo['global'] = $globalRecord;

        // return $dataInfo;
        // $this->output->cache('15');
        $this->output->set_content_type('application/json')->set_output(json_encode($dataInfo));

    }
    public function getCasesData($country = 'philippines'){
        $url = 'https://disease.sh/v2/countries/'.$country;
        $data = json_decode(file_get_contents($url, false));
        
        $dataInfo = array(
            'country'=>$data->country,
            'cases'=>number_format($data->cases),
            'todayCases'=>number_format($data->todayCases),
            'deaths'=>number_format($data->deaths),
            'todayDeaths'=>number_format($data->todayDeaths),
            'recovered'=>number_format($data->recovered),
            'critical'=>number_format($data->critical),
            'activeCases'=> number_format($data->cases - $data->recovered - $data->deaths),
            'closeCases'=> number_format($data->recovered + $data->deaths),
            'casesPerOneMillion'=>number_format($data->casesPerOneMillion),
        );

        // return $dataInfo;
        // $this->output->cache('15');
        if ($dataInfo) {
            return $dataInfo;
        }
        else{
            return 'error';
        }

    }
    public function getHistoricalData(){
        $countryInput = $this->input->get('country');
        $url = 'https://corona.lmao.ninja/v2/historical/'.$countryInput;
        $data = json_decode(file_get_contents($url, false));
        if($data){
            $data = array(
                'timeline'=>$data->timeline,
            );
            // $this->output->cache('15');
            $data['status'] = 'Connected';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function globalRecordData(){
        $url = 'https://disease.sh/v2/all';
        $data = json_decode(file_get_contents($url, false));
        return $data;
    }
    public function getRssFeed(){
        $news = simplexml_load_file('https://news.google.com/rss?hl=en-PH&gl=PH&ceid=PH:en&search?q=coronavirus,covid19');

        $feeds = array();
        $i = 0;

        foreach ($news->channel->item as $item) {
            preg_match('@src="([^"]+)"@', $item->description, $match);
            $parts = explode('<font size="-1">', $item->description);
            
            $feeds[$i]['title'] = (string) $item->title;
            $feeds[$i]['source'] = (string) $item->source;
            $feeds[$i]['url'] = (string) $item->link;
            $i++;
        }
        // $this->output->cache('15');
        $this->output->set_content_type('application/json')->set_output(json_encode($feeds));
        // echo json_encode($feeds);
    }
    // public function webScrap(){
    //     require_once(APPPATH.'libraries/simple_html_dom.php');

    //     $html = file_get_html('https://www.worldometers.info/coronavirus/country/philippines/');

    //     foreach($html->find('[div id="news_block"]') as $d){
    //         $item['date'] = $d->find('div.news_date');
    //         $item['update'] = $d->find('div.news_li');
    //         $data[] = $item;
    //     }
    //     $this->output->set_content_type('application/json')->set_output(json_encode($data));
    // }
    public function webScrape() {
        require_once(APPPATH.'libraries/simple_html_dom.php');
        $html = file_get_html('https://kenkarlo.com');
        $data = $html->find('title',0);
        var_dump($data); 
        // $data['alert'] = $html->find('[div class="external-html"].strong');
        // $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
