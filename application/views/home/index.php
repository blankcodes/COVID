<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>COVID-19 Updates</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="getInfo COVID-19 updates">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#000" />

    <!-- Open Graph data -->
    <meta property="fb:app_id" content="576747789395855" />
    <meta property="og:title" content="getInfo COVID-19 Updates" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://kenkarlo.com/assets/images/blog/549824-write-for-us.jpg" />
    <meta property="og:description" content="getInfo COVID-19 Updates" />

    <!-- Plugin Links -->
    <link rel="shortcut icon" href="<?=base_url('assets/images/logo.png')?>">
    <link rel="apple-touch-icon" sizes="144x144" type="image/x-icon" href="<?=base_url('assets/images/logo.png')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/bootstrap4/bootstrap.min.css')?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="<?=base_url('assets/styles/styles.css')?>">
</head>
<body>
    <div class="container margin-top-50">
        <div class="text-center">
            <h1 class="element-heading-title">Philippines COVID-19 Updates</h1>
        </div>

        <div class="row element-row-main margin-top-50">
            <div class="col-lg-4 ">
                <div class="element-column-wrap">
                    <div class="title">
                        Confirmed Infected Patients
                    </div>
                    <div class="text-warning" id="confirmed_cases">
                        <span class="element-info">
                            <div class="preload-data">
                                <div class="_preload-data"></div>
                                <div class="__preload-data"></div>
                            </div>
                        </span>
                    </div>

                    <div class="icons text-warning badge-light-warning icon-badge">
                        <i class="fas fa-user-friends"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="element-column-wrap">
                    <div class="title">
                        Recovered
                    </div>
                    <div class="element-info text-success"  id="recovered_cases">
                        <span class="element-info">
                            <div class="preload-data">
                                <div class="_preload-data"></div>
                                <div class="__preload-data"></div>
                            </div>    
                        </span>
                    </div>
                    <div class="icons text-success badge-light-success icon-badge">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                </div>
            </div>

            <div class=" col-lg-4">
                <div class="element-column-wrap">
                    <div class="title">
                        Deaths
                    </div>
                    <div class="element-info text-danger"  id="deaths_cases">
                        <span class="element-info">
                            <div class="preload-data">
                                <div class="_preload-data"></div>
                                <div class="__preload-data"></div>
                            </div>
                        </span>
                    </div>
                    <div class="icons text-danger badge-light-danger icon-badge">
                        <i class="fas fa-skull"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 pull-right">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="element-column-wrap">
                            <div class="title chart-title">
                                Chart Statistics
                            </div>
                            <div class="icons-tab-btn">
                                <div class="preload-data margin-top-20"  hidden="hidden">
                                    <div class="__preload-data"></div>
                                    <div class="___preload-data"></div>
                                </div> 
                                <div id="chart-btn-wrapper">
                                    <button class="btn btn-dark btn-sm" id="number_cases_stat"><i class="fas fa-users"></i></button>
                                    <button class="btn btn-dark btn-sm" id="number_recovered_stat"><i class="fas fa-heartbeat"></i></button>
                                    <button class="btn btn-dark btn-sm" id="number_death_stat"><i class="fas fa-skull"></i></button>
                                </div>
                            </div>
                            <div class="preload-data margin-top-20" id="preload_data" hidden="hidden">
                                <div class="__preload-data"></div>
                                <div class="___preload-data"></div>
                                <div class="_preload-data"></div>
                            </div>  
                            <div id="chart_wrapper">
                                <canvas id="confirmedCaseChart" width="400" height="280"></canvas>
                                <canvas id="deathCaseChart" width="400" height="280"></canvas>
                                <canvas id="recoveredCaseChart" width="400" height="280"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           <div class="col-lg-5 pull-left">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="element-column-wrap">
                            <div>
                                <div class="title">
                                    Closed Cases <span class="cursor-pointer" data-toggle="tooltip" data-placement="top" title="Closed cases which had on outcome"><i class="fas fa-question-circle font-sm"></i></span>
                                </div>
                                <div class="element-info-right" id="closed_cases">
                                    0
                                </div>
                            </div>

                            <div class=" margin-top-20">
                                <canvas id="_close_cases_chart" width="400" height="180"></canvas>
                                <div id="close_cases_wrapper" class="row">
                                    <div class="col-lg-6">
                                        <div class="close-case-percent" >
                                            <span id="_recovered_cases">
                                                <div class="preload-data">
                                                    <div class="_preload-data"></div>
                                                    <div class="__preload-data"></div>
                                                </div>
                                            </span>
                                            <span class="sub-percent-cases" id="recovered_percent_cases_sub"></span>
                                        </div>
                                        <div>
                                            Recovered
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="close-case-percent" >
                                            <span id="_death_cases">
                                            <div class="preload-data">
                                                <div class="_preload-data"></div>
                                                <div class="__preload-data"></div>
                                            </div>
                                            </span>
                                            <span class="sub-percent-cases" id="deaths_percent_cases_sub"></span>
                                        </div>
                                        <div>
                                            Deaths
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 margin-top-10">
                                    <div class="progress close-cases-progress">
                                        <div class="progress-bar progress-bar-case bg-success" id="__recovered_cases" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div style="margin-right: 5px;"></div>
                                        <div class="progress-bar progress-bar-case bg-danger" id="__death_cases" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 margin-top-10 text-center">
                                    <span class="font-11"><a id="show_close_case" href="#show_chart">Show Chart</a></span>
                                    <span class="font-11"><a id="hide_close_case" href="#hide_chart" hidden>Hide Chart</a></span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="element-column-wrap">
                            <div>
                                <div class="title">
                                    Active Cases <span class="cursor-pointer" data-toggle="tooltip" data-placement="top" title="Currently infected patients which had on outcome"><i class="fas fa-question-circle font-sm"></i></span>
                                </div>
                                <div class="element-info-right" id="_active_cases">
                                    0
                                </div>
                            </div>

                            <div class=" margin-top-20">
                                <canvas id="_active_cases_chart" hidden="hidden" width="400" height="180"></canvas>
                                <div class="row" id="active_cases_wrapper">
                                    <div class="col-lg-6">
                                        <div class=" close-case-percent">
                                            <span id="_mild_cases">
                                                <div class="preload-data">
                                                    <div class="_preload-data"></div>
                                                    <div class="__preload-data"></div>
                                                </div>
                                            </span>
                                            <span class="sub-percent-cases" id="mild_percent_cases_sub"></span>
                                        </div>
                                        <div>
                                            Mild Condition
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="close-case-percent ">
                                            <span id="critical">
                                                <div class="preload-data">
                                                    <div class="_preload-data"></div>
                                                    <div class="__preload-data"></div>
                                                </div>
                                            </span>
                                            <span class="sub-percent-cases" id="critical_percent_cases_sub"></span>
                                        </div>
                                        <div>
                                            Serious or Critical
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 margin-top-10">
                                    <div class="progress close-cases-progress">
                                        <div class="progress-bar progress-bar-case bg-primary" id="__mild_cases" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar progress-bar-case bg-danger" id="__critical" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>


                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

