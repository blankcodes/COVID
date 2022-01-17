var base_url;
var country;

getAPIData(country);
getLatestNews();
confirmedCases();
divElement();
startTime();

$("#subscribe_notification").on('click', function(){
    $('#notify_modal').modal('toggle');
})
$("#_close_cases_chart").attr('hidden', 'hidden');
$("#show_close_case").attr('hidden', 'hidden');
$("#show_active_cases").attr('hidden', 'hidden');

$("#number_cases_stat").on('click', function(){
    confirmedCases();
})
$("#number_recovered_stat").on('click', function(){
    recoveredCases();
})
$("#number_death_stat").on('click', function(){
    deathCases();
})
$("#show_close_case").on('click', function(){
    closeCasesChart();
})
$("#hide_close_case").on('click', function(){
    $(this).attr('hidden', 'hidden');
    $('#_close_cases_chart').attr('hidden', 'hidden');
    $('#show_close_case').removeAttr('hidden');
    $('#close_cases_wrapper').removeAttr('hidden');
})
$("#save_email").on('click', function(e){
    e.preventDefault();
    email_address = $("#subs_email").val()
    $("#save_email").text('Saving...').attr('disabled','disabled');
    saveSubscriptionEmail(email_address);
})
$("#share_btn_copy").on('click', function(){
    url = document.getElementById("website_url");
     // url.select();
    // url.setSelectionRange(0, 99999); /*For mobile devices*/

    /* Copy the text inside the text field */
    document.execCommand("copy");
    $('#share_btn_copy').attr({'data-original-title':'Copied: '+url.value, 'title':'Copied:'+url.value}).show
    // alert("Copied: " + url.value);
})
htmlBody();
function htmlBody(){
    

}
function getAPIData(country){
    // $("#loader").modal('toggle');
    $.ajax({
        url: base_url+ 'api/v1/covid/_get_cases_data',
        type: 'GET',
        dataType: 'JSON',
        data: {country:country}
    })
    .done(function(data){
    
        $('#confirmed_cases span').html(data.cases + ' <span class="fw-500 font-10 text-warning">(' +data.todayCases+' <sup class="font-9">Today</sup>)</span>');
        $('#recovered_cases span').html(data.recovered);
        $('#deaths_cases span').html(data.deaths + ' <span class="fw-500 font-10 text-danger">(' +data.todayDeaths+' <sup class="font-9">Today</sup>)</span>');
        $('#closed_cases').text(data.closeCases);
        $('#confirmed_cases_today').html('<span class="fw-600 text-warning"><i class="fas fa-caret-up font-sm"></i> ' +data.todayCases+'</span>');

        $('#_recovered_cases').html('<i class="text-success fa fa-circle font-sm"></i> '+data.recovered);
        $('#__recovered_cases').attr('style', 'width: '+data.recoverCasesPercent+'%').attr('aria-valuenow', data.recoverCasesPercent);
        $('#recovered_percent_cases_sub').html('('+data.recoverCasesPercent+'%)');

        $('#_death_cases').html('<i class="text-danger fa fa-circle font-sm"></i> '+data.deaths);
        $('#__death_cases').attr({'style':'width: '+data.deathsCasesPercent+'%', 'aria-valuenow':data.deathsCasesPercent});
        $('#deaths_percent_cases_sub').text('('+data.deathsCasesPercent+'%)');
        $('#_active_cases').text(data.activeCases);

        $('#_mild_cases').html('<i class="text-primary fa fa-circle font-sm"></i> '+data.mildCases);
        $('#mild_percent_cases_sub').html('('+data.mildCasesCasesPercent+'%)');
        $('#__mild_cases').attr('style', 'width: '+data.mildCasesCasesPercent+'%').attr('aria-valuenow', data.mildCasesCasesPercent);

        $('#critical').html('<i class="text-danger fa fa-circle font-sm"></i> '+data.critical);
        $('#critical_percent_cases_sub').html('('+data.criticalCasesCasesPercent+'%)');
        $('#__critical').attr({'style':'width: '+data.criticalCasesCasesPercent+'%', 'aria-valuenow':data.criticalCasesCasesPercent});
        
        $("#global_closed_cases").html(data.globalTotalCloseCases)
        $("#global_confirmed_case").html(data.totalGlobalCase)
        $("#_global_recovered_cases").html('<i class="text-success fa fa-circle font-sm"></i> '+data.totalGlobalRecoveredCase)
        $("#_global_death_cases").html('<i class="text-danger fa fa-circle font-sm"></i> '+data.totalGlobalDeathCase)

        $('#global_recovered_case_percent').html('('+data.globalPercentRecovered+'%)');
        $('#global_death_case_percent').html('('+data.globalDeathsRecovered+'%)');

        $('#__global_recovered_cases').attr('style', 'width: '+data.globalPercentRecovered+'%').attr('aria-valuenow', data.globalPercentRecovered);
        $('#__global_death_cases').attr('style', 'width: '+data.globalDeathsRecovered+'%').attr('aria-valuenow', data.globalDeathsRecovered11);

        // $("#global_death_case").html(data.global.deaths)
        // $("#loader").modal('hide');
    });
}

function confirmedCases(){
    $("#chart_wrapper").attr('hidden', 'hidden');
    $("#confirmedCaseChart").removeAttr('hidden');
    $("#preload_data").removeAttr('hidden')

    $.ajax({
        url: base_url+ 'api/v1/covid/_get_historical_data',
        type: 'GET',
        dataType: 'JSON',
        data: {country:country}
    })
    .done(function(data){
        if(data.status == 'Connected'){
            $("#deathCaseChart").attr('hidden','hidden');
            $("#recoveredCaseChart").attr('hidden','hidden');
            $("#show_close_case").removeAttr('hidden');

            cases = data.timeline.cases;
            dateCases = Object.keys(cases);
            numberCases = Object.values(cases);

            var chart = $('#confirmedCaseChart');
            var myChart = new Chart(chart, {
                type: 'line',
                data: {
                    labels: dateCases,
                    datasets: [{
                    label: 'Number of Confirmed Cases',
                    data: numberCases,
                    backgroundColor: '#ffc107',
                    borderColor: '#ffc107',
                    borderWidth: 1
                }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            $("#preload_data").attr('hidden', 'hidden');
            $("#chart_wrapper").removeAttr('hidden')
        }
        else{
            $("#preload_data").html('Connection Error! <a href="#refresh" onclick="confirmedCases()"><i class="fab fa-refresh></i></a>' );
        }
    })
}
function deathCases(){
    $("#chart_wrapper").attr('hidden', 'hidden');
    $("#preload_data").removeAttr('hidden')
    $("#deathCaseChart").removeAttr('hidden');
    $.ajax({
        url: base_url+ 'api/v1/covid/_get_historical_data',
        type: 'GET',
        dataType: 'JSON',
        data: {country:country}
    })
    .done(function(data){
        $("#confirmedCaseChart").attr('hidden','hidden');
        $("#recoveredCaseChart").attr('hidden','hidden');

        deaths = data.timeline.deaths;
        dateCases = Object.keys(deaths);
        numberCases = Object.values(deaths);

        var chart = $('#deathCaseChart');
        var myChart = new Chart(chart, {
            type: 'line',
            data: {
                labels: dateCases,
                datasets: [{
                label: 'Number of Death Cases',
                data: numberCases,
                backgroundColor: '#ff5252',
                borderColor: '#ff5252',
                borderWidth: 1
            }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        
        $("#preload_data").attr('hidden', 'hidden');
        $("#chart_wrapper").removeAttr('hidden')
    })
}

function recoveredCases(){
    $("#preload_data").removeAttr('hidden')
    $("#chart_wrapper").attr('hidden', 'hidden');
    $("#recoveredCaseChart").removeAttr('hidden');
    $.ajax({
        url: base_url+ 'api/v1/covid/_get_historical_data',
        type: 'GET',
        dataType: 'JSON',
        data: {country:country}
    })
    .done(function(data){
        $("#confirmedCaseChart").attr('hidden','hidden');
        $("#deathCaseChart").attr('hidden','hidden');

        recovered = data.timeline.recovered;
        dateCases = Object.keys(recovered);
        numberCases = Object.values(recovered);

        var chart = $('#recoveredCaseChart');
        var myChart = new Chart(chart, {
            type: 'line',
            data: {
                labels: dateCases,
                datasets: [{
                label: 'Number of Recovered Cases',
                data: numberCases,
                backgroundColor: '#11c15b',
                borderColor: '#11c15b',
                borderWidth: 1
            }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        
        $("#preload_data").attr('hidden', 'hidden');
        $("#chart_wrapper").removeAttr('hidden')
    })
}
function closeCasesChart(){
    $.ajax({
        url: base_url+ 'api/v1/covid/_get_historical_data',
        type: 'GET',
        dataType: 'JSON',
        data: {country:country}
    })
    .done(function(data){
        $('#close_cases_wrapper').attr('hidden', 'hidden');
        $('#_close_cases_chart').removeAttr('hidden');
        $('#show_close_case').attr('hidden', 'hidden');
        $("#hide_close_case").removeAttr('hidden');


        recovered = data.timeline.recovered;
        recDateCases = Object.keys(recovered);
        recNumCases = Object.values(recovered);

        deaths = data.timeline.deaths;
        dDateCases = Object.keys(deaths);
        dNumCases = Object.values(deaths);
        
        var chart = $('#_close_cases_chart');
        var myChart = new Chart(chart, {
            type: 'line',
            data: {
                labels: recDateCases,
                datasets: [{
                    label: 'Recovered Cases',
                    data: recNumCases,
                    // backgroundColor: '#11c15b',
                    borderColor: '#11c15b',
                    borderWidth: 1
                },
                {
                    label: 'Death Cases',
                    data: dNumCases,
                    // backgroundColor: '#ff5252',
                    borderColor: '#ff5252',
                    borderWidth: 1
                }
            ]
            },
            options: {
                scales: {
                    xAxes: [{
                        display: true,
                    }],
                    yAxes: [{
                        display: true,
                        type: 'logarithmic',
                    }]
                }
            }
        });

    })
}


function getLatestNews(){
    $.ajax({
        url: base_url+'api/v1/covid/_get_latest_news',
        type: 'GET',
        dataType: 'JSON',
        data: {country:country}
    })
    .done(function(data){ 
        if (data.length > 0){
            string = '';
            for(var x in data.slice(0, 15)){
                string+='<a href="'+data[x].url+'" target="_blank" rel="noopener nofollow"><h5 class="font-11">'+data[x].title+' <i class="fa fa-external-link-alt font-xs"></i></h5> </a>'
            }
            $("#latest-news-wrapper").html(string);
        }
    })
}

// webScrape()
function webScrape(){
    $.ajax({
        url: base_url+'api/v1/covid/_web_scrape',
        type: 'GET',
        dataType: 'JSON',
    })
    .done(function(data){ 

    })
}
function divElement(){
    footer = '';
    footer +='<div class="container">'
        +'<div class="row footer-credits" >'
            +'<div class="col-lg-3 col-6">'
                +'<h2>Source:</h2>'
                +'<ul>'
                    +'<li><a target="_blank" rel="noopener nofollow noreferrer" href="https://www.worldometers.info/coronavirus/">Worldometers</a></li>'
                    +'<li><a target="_blank" rel="noopener nofollow noreferrer" href="https://doh.gov.ph">DOH</a></li>'
                    +'<li><a target="_blank" rel="noopener nofollow noreferrer" href="https://www.facebook.com/OfficialDOHgov/">DOH Facebook</a></li>'
                    +'<li><a target="_blank" rel="noopener nofollow noreferrer" href="https://who.int">WHO</a></li>'
                    +'<li><a target="_blank" rel="noopener nofollow noreferrer" href="https://news.google.com">Google News</a></li>'
                +'</ul>'
            +'</div>'

            +'<div class="col-lg-3 col-6">'
                +'<h2>Referece:</h2>'
                +'<ul>'
                    +'<li><a target="_blank" rel="noopener nofollow noreferrer" href="https://github.com/NovelCOVID/API">NovelCOVID</a></li>'
                    +'<li><a target="_blank" rel="noopener nofollow noreferrer" href="https://github.com/CSSEGISandData/COVID-19">CSSEGISandData</a></li>'

                +'</ul>'
            +'</div>'

            +'<div class="col-lg-3 col-6">'
                +'<h2>You might Donate to these agencies/org.:</h2>'
            +' <ul >'
                    +'<li><a target="_blank" rel="noopener nofollow noreferrer" href="https://www.facebook.com/tapatdlsu/posts/3126462290738527">Alyansang Tapat sa Lasallista</a></li>'
                    +'<li><a target="_blank" rel="noopener nofollow noreferrer" href="https://www.facebook.com/ADMUSanggu/posts/101573834365030757">Ateneo de Manila University</a></li>'
                    +'<li><a target="_blank" rel="noopener nofollow noreferrer" href="https://www.facebook.com/OfficialCaritasManila/posts/10156685011801631">Caritas Manila</a></li>'
                    +'<li><a target="_blank" rel="noopener nofollow noreferrer" href="https://twitter.com/mentalhealthph/status/1239754942925000705">MentalHealthPH</a></li>'
                    +'<li><a target="_blank" rel="noopener nofollow noreferrer" href="https://twitter.com/juansparkyl/status/1240176858160746496?s=21">JuanSpark Youth Leaders</a></li>'
                    +'<li class="text-left"><a target="_blank" rel="noopener nofollow noreferrer" href="https://www.facebook.com/LawyersForDoctorsPhilippines/posts/105968464374903?__xts__[0]=68.ARCkdTX29beFRnxTIQfp4kWNkBfQwM_WtQ0XkNgXJl4tTNaAyGHnFJhv-sPx7EOsS5enSYKiSqlH4R_5oFeG3C_lopVnFB3I6VH8nu_TSS8c7PkleBG_erh6z3smPzj13m27z29YOJaaGkxSHj_fh1bcB5H0dKD7r0t1_Cn3o8J_A_ngvsqfhGIEpsiwo2SsoHpgO1nAcYLg-KxqR9IdYrvSyOTsUyggBzL0Ohvakkz5AsitaAwxjRt_z6tZ7-Mht42EIS5za03nl0v0qfV69jOC_lFmAsWr7REf1BgJOlFYIq6J1epRMLStaALo2N4crJL1uesID1dKNM_HSr7sXiU&__tn__=-R">Lawyers for Doctors </a></li>'
                    +'<li class="text-left"><a target="_blank" rel="noopener nofollow noreferrer" href="https://www.facebook.com/www.pametinc.org/photos/a.10152246379996150/10156719210116150/?type=3&theater">Philippine Association of Medical Technologists, Inc</a></li>'
                    +'<li><a class="text-left" target="_blank" rel="noopener nofollow noreferrer" href="https://web.facebook.com/obphil/photos/a.10150183060893968/10158888051408968/?type=3&theater">Operation Blessing Foundation Philippines Inc. </a></li>'
                +'</ul>'
        +'</div>'

            +'<div class="col-lg-3 col-6">'
                +'<h2>Developer:</h2>'
            +' <ul>'
                    +'<li><a target="_blank" rel="noopener" href="https://github.com/blankcodes/covid19">Github</a></li>'
                    +'<li><a target="_blank" rel="noopener" href="https://kenkarlo.com">Ken Karlo</a></li>'
                +'</ul>'
        +' </div>'
        +'</div>'
    +'</div>'
    $('#footer_wrapper').html(footer);
}

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    $("#time_date_clock .clock").html( h + ":" + m + ":" + s);
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
function saveSubscriptionEmail(email_address){
    $.ajax({
        url: base_url+'api/v1/email/_save',
        type: 'POST',
        data: {email_address:email_address}
    })
    .done(function(data){
        if (data.resultStatus == 'success'){
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 9000
            });
            toast({
                type: 'success',
                title: 'You are now subscribe for the realtime updates !'
            });
            $("#notify_modal").modal('hide');
        }
        else if (data.resultStatus == 'fail'){
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 9000
            });
            toast({
                type: 'error',
                title: data.resultMsg
            });
        }
        $("#save_email").text('Save').removeAttr('disabled');
        $("#subs_email").val('');
    })
}