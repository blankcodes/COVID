<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {
    public function getAPIData(){
        $globalRecord = $this->globalRecordData();
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
            'activeCases'=> $data->cases - $data->recovered - $data->deaths,
            'closeCases'=> $data->recovered + $data->deaths,
            'casesPerOneMillion'=>$data->casesPerOneMillion,
        );
        $closeCases = $data->recovered + $data->deaths;
        $activeCases = $data->cases - $data->recovered - $data->deaths;
        $dataInfo['mildCases'] = $activeCases - $data->critical;

        $dataInfo['mildCasesCasesPercent'] = round( $dataInfo['mildCases'] / $activeCases * 100, 2);
        $dataInfo['criticalCasesCasesPercent'] = round( $data->critical / $activeCases * 100, 2);

        $dataInfo['recoverCasesPercent'] = round( $data->recovered / $closeCases * 100, 2);
        $dataInfo['deathsCasesPercent'] = round( $data->deaths / $closeCases * 100, 2);

        $dataInfo['globalTotalCloseCases'] = $globalRecord->deaths +  $globalRecord->recovered;
        $dataInfo['globalPercentRecovered'] = round($globalRecord->recovered / $dataInfo['globalTotalCloseCases'] * 100, 2);
        $dataInfo['globalDeathsRecovered'] =  round($globalRecord->deaths / $dataInfo['globalTotalCloseCases'] * 100, 2);
        

        $dataInfo['global'] = $globalRecord;

        // return $dataInfo;
        $this->output->cache('15');
        $this->output->set_content_type('application/json')->set_output(json_encode($dataInfo));

    }
    public function getHistoricalData(){
        $countryInput = $this->input->get('country');
        $url = 'https://corona.lmao.ninja/historical/'.$countryInput;
        $data = json_decode(file_get_contents($url, false));
        if($data){
            $data = array(
                'timeline'=>$data->timeline,
            );
            $this->output->cache('15');
            $data['status'] = 'Connected';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function globalRecordData(){
        $url = 'https://corona.lmao.ninja/all';
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
        $this->output->cache('15');
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
    public function webScrape(){
        require_once(APPPATH.'libraries/simple_html_dom.php');

        $html = file_get_html('https://kenkarlo.com/articles/does-your-domain-name-affect-your-seo2');

        $data['title'] = $html->find('title');


        // foreach($html->find('.view-id-2019_ncov_advisories') as $d){
        //     $item['title'] = $d->find('td.views-field-title');
        //     $data[] = $item;
        // }
        // $data['alert'] = $html->find('[div class="external-html"].strong');
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
