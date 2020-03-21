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
    <!-- <link rel="stylesheet" href="<?=base_url('assets/styles/fontawesome.css')?>"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="<?=base_url('assets/styles/styles.css')?>">
</head>
<body>
    <div class="container margin-top-50">
        <div class="text-center">
            <h2 class="element-heading-title">Philippines COVID-19 Monitor Updates</h2>
        </div>

        <div class="row element-row-main">
            <div class="col-lg-4">
                <div class="element-column-wrap">
                    <div class="title">
                        Confirmed Cases
                    </div>
                    <div class="text-warning" id="confirmed_cases">
                        <span class="element-info"><?= $getInfo->cases ?></span>
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
                        <?= $getInfo->recovered ?>
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
                        <?= $getInfo->deaths ?>
                    </div>
                    <div class="icons text-danger badge-light-danger icon-badge">
                        <i class="fas fa-skull"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="element-column-wrap">
                    <div class="title">
                        Chart
                    </div>
                    <div class="">
                    <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="element-column-wrap">
                    <div class="title">
                        Active Cases
                    </div>
                    <div class="element-info-right"  id="active_cases">
                        <?= $activeCases = $getInfo->cases - $getInfo->recovered - $getInfo->deaths  ?>
                    </div>
                </div>
            </div>
        </div>

        <?= $getInfo->country ?><br>
        <?= $getInfo->cases ?><br>
        <?= $getInfo->todayCases ?><br>
        <?= $getInfo->deaths ?><br>
        <?= $getInfo->todayDeaths ?><br>
        <?= $getInfo->recovered ?><br>
        <?= $getInfo->critical ?><br>
        <?= $getInfo->casesPerOneMillion ?><br>
    </div>
<!-- Scripts -->
<script>
	var base_url = '<?=base_url()?>';	
</script>
<script src="<?=base_url('assets/js/jquery-3.4.1.min.js')?>"></script>
<script src="<?=base_url('assets/js/chart.min.js')?>"></script>
<script src="<?=base_url('assets/js/historical_data.js')?>"></script>
</body>
</html>