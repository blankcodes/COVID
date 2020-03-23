	
var base_url;
var country;

getAPIData(country);
getRssFeed();
confirmedCases();

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
        url: base_url+ 'api/v1/covid/get-api-data',
        type: 'GET',
        dataType: 'JSON',
        data: {country:country}
    })
    .done(function(data){
    
        $('#confirmed_cases span').html(data.cases + ' <span class="fw-500 font-15 font-fontawesome text-warning">(' +data.todayCases+' <sup class="font-xs">Today</sup>)</span>');
        $('#recovered_cases span').html(data.recovered);
        $('#deaths_cases span').html(data.deaths + ' <span class="fw-500 font-15 font-fontawesome text-danger">(' +data.todayDeaths+' <sup class="font-xs">Today</sup>)</span>');
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

        // $("#loader").modal('hide');
    });
}

function confirmedCases(){
    $("#chart_wrapper").attr('hidden', 'hidden');
    $("#confirmedCaseChart").removeAttr('hidden');
    $("#preload_data").removeAttr('hidden')

    $.ajax({
        url: base_url+ 'api/v1/covid/get-historical-data',
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
        url: base_url+ 'api/v1/covid/get-historical-data',
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
        url: base_url+ 'api/v1/covid/get-historical-data',
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
        url: base_url+ 'api/v1/covid/get-historical-data',
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


function getRssFeed(){
    $.ajax({
        url: base_url+'api/v1/covid/news-rss',
        type: 'GET',
        dataType: 'JSON',
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

webScrape()
function webScrape(){
    $.ajax({
        url: base_url+'api/v1/covid/web-scrape',
        type: 'GET',
        dataType: 'JSON',
    })
    .done(function(data){ 

    })
}