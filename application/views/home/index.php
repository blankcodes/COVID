<!-- 
MIT License

Copyright (c) 2020 Ken Karlo

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Philippines COVID-19 Updates: Confirmed Cases and Deaths</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Track and monitor COVID-19 Updates in the Philippines: Confirmed Cases and Deaths">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#000" />

    <!-- Open Graph data -->
    <meta property="fb:app_id" content="576747789395855" />
    <meta property="og:title" content="Philippines COVID-19 Updates: Confirmed Cases and Deaths" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?=base_url()?>" />
    <meta property="og:image" content="<?=base_url()?>assets/img/cover-featured.jpg" />
    <meta property="og:description" content="Track and monitor COVID-19 Updates in the Philippines" />

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@kensdigest>">
    <meta name="twitter:creator" content="@kensdigest">
    <meta name="twitter:title" content="Philippines COVID-19 Updates: Confirmed Cases and Deaths">
    <meta name="twitter:description" content="Track and monitor COVID-19 Updates in the Philippines: Confirmed Cases and Deaths">
    <meta name="twitter:image" content="<?=base_url()?>assets/img/cover-featured.jpg">

    <!-- Plugin Links -->
    <link rel="shortcut icon" href="<?=base_url('assets/img/logo.png')?>">
    <link rel="apple-touch-icon" sizes="144x144" type="image/x-icon" href="<?=base_url('assets/img/logo.png')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/bootstrap4/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/styles/styles.css')?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-100578871-4"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-100578871-4');
    </script>
</head>
<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0&appId=576747789395855&autoLogAppEvents=1"></script>
    <div class="container margin-top-20">
        <div class="text-center feature-img-div">
            <img class="img-fluid" draggable="false" alt="Philippines COVID-19 Updates" src="<?=base_url('assets/img/title-cover.jpg')?>">
            <div class="current-time-date" id="web-view">
                <div class="text-right font-xs">Updated as of:</div>
                <div id="time_date_clock">
                    <i class="fa fa-clock"></i> <span class="clock"></span> <span><?=date('F d, Y')?></span>
                </div>
            </div>
        </div>

        <div class="element-row-main margin-top-20">
            <div class="row">
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
            </div>
            
            <!-- start -->
            <div class="row">
                <div class="col-lg-7 pull-right">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="element-column-wrap">
                                <div>
                                    <div class="title">
                                        Global  Cases <span class="cursor-pointer" data-toggle="tooltip" data-placement="top" title="Global record of confirmed cases"><i class="fas fa-question-circle font-sm"></i></span>
                                    </div>
                                    <div class="element-info-right" id="global_confirmed_case">
                                        0
                                    </div>
                                </div>

                                <div class=" margin-top-20">
                                    <div id="close_cases_wrapper" class="row">
                                        <div class="col-lg-6 col-6">
                                            <div class="close-case-percent" >
                                                <span id="_global_recovered_cases">
                                                    <div class="preload-data">
                                                        <div class="_preload-data"></div>
                                                        <div class="__preload-data"></div>
                                                    </div>
                                                </span>
                                                <span class="sub-percent-cases " id="global_recovered_case_percent"></span>
                                            </div>
                                            <div>
                                                Recovered 
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-6">
                                            <div class="close-case-percent" >
                                                <span id="_global_death_cases">
                                                    <div class="preload-data">
                                                        <div class="_preload-data"></div>
                                                        <div class="__preload-data"></div>
                                                    </div>
                                                </span>
                                                <span class="sub-percent-cases " id="global_death_case_percent"></span>
                                            </div>
                                            <div>
                                                Deaths 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 margin-top-10">
                                        <div class="progress close-cases-progress">
                                            <div class="progress-bar progress-bar-case bg-success" id="__global_recovered_cases" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                            <div style="margin-right: 5px;"></div>
                                            <div class="progress-bar progress-bar-case bg-danger" id="__global_death_cases" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 margin-top-20 text-center">
                                        <div class="title">
                                            Global Closed Cases <span class="cursor-pointer" data-toggle="tooltip" data-placement="top" title="Global record of Closed cases which had on outcome (recovered and deaths)"><i class="fas fa-question-circle font-sm"></i></span>
                                        </div>
                                        <div class="element-info" id="global_closed_cases">
                                            0
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    
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
                                        <button data-toggle="tooltip" data-placement="top" title="Confirmed Cases Chart" class="btn btn-dark btn-sm" id="number_cases_stat"><i class="fas fa-users"></i></button>
                                        <button data-toggle="tooltip" data-placement="top" title="Recovered Cases Chart" class="btn btn-dark btn-sm" id="number_recovered_stat"><i class="fas fa-heartbeat"></i></button>
                                        <button data-toggle="tooltip" data-placement="top" title="Deaths Cases Chart" class="btn btn-dark btn-sm" id="number_death_stat"><i class="fas fa-skull"></i></button>
                                    </div>
                                </div>
                                <div class="preload-data margin-top-20" id="preload_data" hidden="hidden">
                                    <div class="__preload-data"></div>
                                    <div class="___preload-data"></div>
                                    <div class="_preload-data"></div>
                                </div>  
                                <div id="chart_wrapper">
                                    <canvas id="confirmedCaseChart" width="400" height="232"></canvas>
                                    <canvas id="deathCaseChart" width="400" height="232"></canvas>
                                    <canvas id="recoveredCaseChart" width="400" height="232"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end 7 -->

                <!-- start 5 -->
                <div class="col-lg-5 pull-left">
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
                                    <div class="row" id="active_cases_wrapper">
                                        <div class="col-lg-6 col-6">
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
                                        <div class="col-lg-6 col-6">
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
                                    <canvas id="_close_cases_chart" width="400" height="150"></canvas>
                                    <div id="close_cases_wrapper" class="row">
                                        <div class="col-lg-6 col-6">
                                            <div class="close-case-percent" >
                                                <span id="_recovered_cases">
                                                    <div class="preload-data">
                                                        <div class="_preload-data"></div>
                                                        <div class="__preload-data"></div>
                                                    </div>
                                                </span>
                                                <span class="sub-percent-cases " id="recovered_percent_cases_sub"></span>
                                            </div>
                                            <div>
                                                Recovered
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-6">
                                            <div class="close-case-percent" >
                                                <span id="_death_cases">
                                                <div class="preload-data">
                                                    <div class="_preload-data"></div>
                                                    <div class="__preload-data"></div>
                                                </div>
                                                </span>
                                                <span class="sub-percent-cases " id="deaths_percent_cases_sub"></span>
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



                    <div class="element-column-wrap">
                        <div class="title">
                            COVID-19 hotlines <i class="fas fa-info-circle font-sm"></i> 
                        </div>
                        <div class="margin-top-10 btn-share-wrapper">
                            <div class="margin-top-10">
                                <div>1555 (PLDT, Smart, Sun, and TnT)</div>
                                <div>(02)  894-26843 (894-COVID)</div>
                            </div>
                        </div>                      
                    </div>
                        
                    
                </div>
                <!-- end 5 -->
            </div>
            


            


            <div class="row">
                <div class="col-lg-7 pull-right">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="element-column-wrap">
                                <div class="title margin-bottom-10">
                                    Latest News <i class="fas fa-newspaper"></i> <i class="cursor-pointer news-pointer" ><span class="font-xs">Source: News.google.com</span> <i data-toggle="tooltip" data-placement="top" title="Latest News related to COVID-19" class="fas fa-question-circle font-xs"></i> </i>
                                </div>
                                <div id="latest-news-wrapper" >
                                    <div class="preload-data">
                                        <div class="_preload-data"></div>
                                        <div class="__preload-data"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="element-column-wrap">
                        <div class="title margin-bottom-20 ">
                            Get protected against COVID-19 <i class="fas fa-stethoscope font-sm"></i>
                        </div>
                        <div class="embed-responsive" id="video_wrapper_element">
                            <div class="fb-video" data-href="https://www.facebook.com/OfficialDOHgov/videos/876618819444243/" data-width="500" data-show-text="false"></div>

                                               
                        </div>
                    </div>
                    
                    <div class="element-column-wrap">
                        <div class="title margin-bottom-20 ">
                            Share <i class="fas fa-share-alt font-sm"></i>
                        </div>
                            <div class="btn-share-wrapper">
                            <input type="hidden" id="website_url" value="<?=base_url();?>" />
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?=base_url();?>" target="_blank" rel="noopener" class="btn btn-circle btn-dark btn-share-icon"><i class="fab fa-facebook-f"></i></a>
                            <a id="mobile-view" href="fb-messenger://share/?link=<?=base_url();?>&app_id=576747789395855" target="_blank" rel="noopener" class="btn btn-circle btn-dark btn-share-icon"><i class="fab fa-facebook-messenger"></i></a>
                            <a href="https://twitter.com/intent/tweet?original_referer=<?=base_url();?>&text=Track and monitor COVID-19 Updates in the Philippines&url=<?=base_url()?>&hashtags=COVID19,COVIDUpdates" target="_blank" rel="noopener"  class="btn btn-circle btn-dark btn-share-icon"><i class="fab fa-twitter"></i></a>
                       </div>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
