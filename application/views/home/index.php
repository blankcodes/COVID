<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Monitor COVID-19 Updates</title>
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
            <h1 class="element-heading-title">Philippines COVID-19 Monitor Updates</h1>
        </div>

        <div class="row element-row-main margin-top-50">
            <div class="col-lg-4">
                <div class="element-column-wrap">
                    <div class="title">
                        Currently Infected Patients
                    </div>
                    <div class="text-warning" id="active_cases">
                        <span class="element-info"><?= $getInfo['activeCases']; ?></span>
                    </div>

                    <div class="icons text-warning badge-light-warning icon-badge">
                        <i class="fas fa-user-friends"></i>
                    </div>
                </div>
            </div>

            <div class=" col-lg-4">
                <div class="element-column-wrap">
                    <div class="title">
                        Recovered
                    </div>
                    <div class="element-info text-success"  id="recovered_cases">
                        <?= $getInfo['recovered']; ?>
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
                    <?= $getInfo['deaths']; ?>
                    </div>
                    <div class="icons text-danger badge-light-danger icon-badge">
                        <i class="fas fa-skull"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="row">
                    <div class="element-column-wrap">
                        <div class="title">
                            Chart
                        </div>
                        <div class="">
                        <canvas id="myChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>

           <div class="col-lg-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="element-column-wrap">
                            <div>
                                <div class="title">
                                    Closed Cases <span class="cursor-pointer" data-toggle="tooltip" data-placement="top" title="Closed cases which had on outcome"><i class="fas fa-question-circle font-sm"></i></span>
                                </div>
                                <div class="element-info-right" id="confirmed_cases">
                                    <?= $getInfo['closeCases'] ?>
                                </div>
                            </div>

                            <div class="row margin-top-20">
                                <div class="col-lg-6">
                                    <div class=" close-case-percent">
                                        <i class="text-success fa fa-circle font-sm"></i> <?= $getInfo['recovered']?> <span class="sub-percent-cases">(<?= $getInfo['recoverCasesPercent'].'%'?>)</span>
                                    </div>
                                    <div>
                                        Recovered
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="close-case-percent ">
                                    <i class="text-danger fa fa-circle font-sm"></i> <?= $getInfo['deaths']?> <span class="sub-percent-cases">(<?= $getInfo['deathsCasesPercent'].'%'?>)</span>
                                    </div>
                                    <div>
                                        Deaths
                                    </div>
                                </div>

                                <div class="col-lg-12 margin-top-10">
                                    <div class="progress close-cases-progress">
                                        <div class="progress-bar progress-bar-case bg-success" role="progressbar" style="width: <?= $getInfo['recoverCasesPercent']?>%" aria-valuenow="<?= $getInfo['recoverCasesPercent']?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div style="margin-right: 5px;"></div>
                                        <div class="progress-bar progress-bar-case bg-danger" role="progressbar" style="width: <?= $getInfo['deathsCasesPercent']?>%" aria-valuenow="<?= $getInfo['deathsCasesPercent']?>" aria-valuemin="0" aria-valuemax="100"></div>
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
                                    Active Cases <span class="cursor-pointer" data-toggle="tooltip" data-placement="top" title="Current active Cases which had on outcome"><i class="fas fa-question-circle font-sm"></i></span>
                                </div>
                                <div class="element-info-right" id="confirmed_cases">
                                    <?= $getInfo['activeCases'] ?>
                                </div>
                            </div>

                            <div class="row margin-top-20">
                                <div class="col-lg-6">
                                    <div class=" close-case-percent">
                                        <i class="text-warning fa fa-circle font-sm"></i> <?= $getInfo['mildCases']?> <span class="sub-percent-cases">(<?= $getInfo['mildCasesCasesPercent'].'%'?>)</span>
                                    </div>
                                    <div>
                                        Mild Condition
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="close-case-percent ">
                                    <i class="text-danger fa fa-circle font-sm"></i> <?= $getInfo['critical']?> <span class="sub-percent-cases">(<?= $getInfo['criticalCasesCasesPercent'].'%'?>)</span>
                                    </div>
                                    <div>
                                        Serious or Critical
                                    </div>
                                </div>

                                <div class="col-lg-12 margin-top-10">
                                    <div class="progress close-cases-progress">
                                        <div class="progress-bar progress-bar-case bg-warning" role="progressbar" style="width: <?= $getInfo['mildCasesCasesPercent']?>%" aria-valuenow="<?= $getInfo['mildCasesCasesPercent']?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar progress-bar-case bg-danger" role="progressbar" style="width: <?= $getInfo['criticalCasesCasesPercent']?>%" aria-valuenow="<?= $getInfo['criticalCasesCasesPercent']?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
<!-- Scripts -->
<script src="<?=base_url('assets/js/jquery-3.4.1.min.js')?>"></script>
<script>
	var base_url = '<?=base_url()?>';	
    var country = 'Philippines';
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script src="<?=base_url('assets/bootstrap4/popper.js')?>"></script>
<script src="<?=base_url('assets/bootstrap4/bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/js/chart.min.js')?>"></script>
<script src="<?=base_url('assets/js/historical_data.js')?>"></script>
</body>
</html>