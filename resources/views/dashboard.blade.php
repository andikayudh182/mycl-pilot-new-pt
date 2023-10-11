@extends('layouts.dashboard')
@section('content')
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

        <style>
            body {
                font-family: Helvetica,FirsNeue, Fallback, sans-serif;
            }
            .card{
            border-color: rgb(241, 241, 241, 0.8);
            background-color: rgb(241, 241, 241, 0.8);
            }
        </style>

        <div id="Chart1" class="d-block pt-4" style="height:100vh;">
            <div id="chart-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="card border-black" style="border-radius: 25px; max-height:70vh;">
                                        <div class="card-body">
                                            <h2 class="card-title d-inline" style="font-weight:bold;">BAGLOG Making in 6 Months Production Trend</h2> <h6 class="card-title d-inline pl-4" style="font-weight:bold; color:rgba(171, 171, 171, 0.6)"> last updated: 2023-03-20</h6>
                                            <h5 class="card-subtitle mb-2 mt-1 text-muted"><b>Baglog making</b> is a process to mix substrate and mushroom spawn</h5>
                                            <center><canvas id="chartContainer1" class="chart" style="max-height:55vh; width:110vh"></canvas><center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-4">
                                    <div class="card border-black" style="height:10rem; border-radius: 25px;">
                                        <div class="card-body text-center">
                                          <h4 class="card-title" style="font-size:21px;">Total Production (bags) </h4>
                                          <h6 class="card-subtitle" style="font-size:16px;">in 6 month period</h6>
                                          <h2 class="card-text" style="font-weight: bold;font-size:40px;">{{$Baglog->sum('y')}}</h2>
                                          <h6 class="card-subtitle text-muted pb-4" style="font-size:16px;">target in 6 months : 2944</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card border-black" style="height:10rem; border-radius: 25px;">
                                        <div class="card-body text-center">
                                            <h4 class="card-title" style="font-size:21px;">Total Ready to Use (bags) </h4>
                                            <h6 class="card-subtitle" style="font-size:16px;">in 6 month period</h6>
                                            <h2 class="card-text pt-1 pb-4" style="font-weight: bold;font-size:40px; color:rgba(202, 150, 92, 1)">{{$Baglog->sum('y')-$KontaminasiBaglog->sum('y')}}</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card border-black" style="height:10rem; border-radius: 25px;">
                                        <div class="card-body text-center">
                                            <h4 class="card-title" style="font-size:21px;">Avg. contamination </h4>
                                            <h6 class="card-subtitle" style="font-size:16px;">in 6 month period</h6>
                                            <h2 class="card-text" style="font-weight: bold;font-size:40px; color:rgba(92, 144, 202, 1);">{{round($KontaminasiBaglog->sum('y')/$Baglog->sum('y')*100, 2)}}%</h2>
                                            <h6 class="card-subtitle text-muted pb-4" style="font-size:16px;">target in 6 months : 10%</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="card border-black" style="border-radius: 25px; max-height:70vh;">
                                        <div class="card-body">
                                            <h2 class="card-title" style="font-weight:bold;">MYLEA Making in 6 Months Trend</h2>
                                            <h5 class="card-subtitle mb-2 text-muted">Mylea making is a process to grow Mylea on incubation tray</h5>
                                            <center><canvas id="chartContainer2" style="max-height:55vh; width:110vh"></canvas></center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4">
                                    <div class="card border-black" style="height:10rem; border-radius: 25px;">
                                        <div class="card-body text-center">
                                          <h4 class="card-title" style="font-size:21px;">Total Production (bags) </h4>
                                          <h6 class="card-subtitle" style="font-size:16px;">in 6 month period</h6>
                                          <h2 class="card-text" style="font-weight: bold;font-size:40px;">{{$Mylea->sum('y')}}</h2>
                                          <h6 class="card-subtitle text-muted pb-4" style="font-size:16px;">target in 6 months : 2944</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card border-black" style="height:10rem; border-radius: 25px;">
                                        <div class="card-body text-center">
                                            <h4 class="card-title" style="font-size:21px;">Total Ready to Use (bags) </h4>
                                            <h6 class="card-subtitle" style="font-size:16px;">in 6 month period</h6>
                                            <h2 class="card-text pt-1 pb-4" style="font-weight: bold;font-size:40px; color:rgba(202, 150, 92, 1)">{{$Mylea->sum('y')-$KontaminasiMylea->sum('y')}}</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card border-black" style="height:10rem; border-radius: 25px;">
                                        <div class="card-body text-center">
                                            <h4 class="card-title" style="font-size:21px;">Avg. contamination </h4>
                                            <h6 class="card-subtitle" style="font-size:16px;">in 6 month period</h6>
                                            <h2 class="card-text" style="font-weight: bold;font-size:40px; color:rgba(92, 144, 202, 1);">{{round($KontaminasiMylea->sum('y')/$Mylea->sum('y')*100, 2)}}%</h2>
                                            <h6 class="card-subtitle text-muted pb-4" style="font-size:16px;">target in 6 months : 10%</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="carousel-control-prev" href="#chart-carousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#chart-carousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
                </a>

                <div class="d-block">
                    <p class="text-center" style="font-weight: bold;font-size:16px; color:rgb(202, 92, 92);">For your eyes only!</p>
                </div>
            </div> 

            <script>
                var charts = [];
                var width, height;

                width = $('.chart').width();
                console.log(width);
                height = $('.chart').height();
                console.log(height);

                $('.carousel').carousel({
                    interval: 7500
                });
                window.onload = function() {
                var dataBaglog = <?php echo json_encode($Baglog, JSON_NUMERIC_CHECK); ?>;
                var dataKontaBaglog = <?php echo json_encode($KontaminasiBaglog, JSON_NUMERIC_CHECK); ?>;
                var label = [];
                var Baglog = [];
                var KontaBaglog = [];
                for(i = 0; i < dataBaglog.length; i++){
                    if(dataBaglog[i]["label"] != null){
                        label.push(dataBaglog[i]["label"]);
                        Baglog.push(dataBaglog[i]["y"]);
                        var temp = dataKontaBaglog.findIndex(item => item.label === dataBaglog[i]["label"]);
                        console.log(temp)
                        if(temp != (-1)){
                            if(i == 2){
                                KontaBaglog.push('21');
                            } else {
                                KontaBaglog.push(dataKontaBaglog[temp]["y"]);
                            }

                        } else{
                            KontaBaglog.push("0");
                        }
                        Baglog[i] = Baglog[i] - KontaBaglog[i];
                        console.log(Baglog[i]);
                    }

                }
                console.log(label);
                var chart = new Chart("chartContainer1", {
                    plugins: [ChartDataLabels],
                    type: "bar",
                    data: {
                        labels: label,
                        datasets: [
                        {
                            type: "bar",
                            backgroundColor: "rgba(202,150,92, 1)",
                            borderColor: "rgba(202, 150, 92, 1)",
                            borderWidth: 1,
                            data: Baglog,
                            label: "Production",
                            legends: {
                                display: false,
                            },
                            datalabels: {
                                display: false,
                            }
                        },
                        {
                            type: "bar",
                            backgroundColor: "rgba(92, 144, 202, 1)",
                            borderColor: "rgba(92, 144, 202, 1)",
                            borderWidth: 1,
                            label: "Contamination",
                            data: KontaBaglog,
                            lineTension: 0, 
                            fill: false,
                            datalabels: {
                                color: '#000000',
                                anchor: 'end',
                                align: 'end',
                                offset: 0,
                                formatter: function(value, context) {
                                    var production = parseInt(Baglog[context.dataIndex]) + parseInt(value);
                                    var CRate = parseInt(value)/parseInt(production) * 100 ;
                                    var x = ["Production : " + production,"Ready To Use :" + Baglog[context.dataIndex] + "\n"+ Math.round(CRate, 0) + "%"]; 
                                    console.log(context);
                                    return x;
                                },
                                textAlign: 'left',
                                font: {
                                    size: 12,
                                }
                            } 
                        },

                        ]
                    },
                    options: {
                        responsive: false,
                        legend: {
                            display: false, // place legend on the right side of chart
                        },
                        scales: {
                            xAxes: [{
                                stacked: true // this should be set to make the bars stacked
                            }],
                            yAxes: [{
                                stacked: true // this also..
                            }]
                        }
                    }

                });
                chart.render();
                debugger;
                charts.push(chart);

                var dataMylea = <?php echo json_encode($Mylea, JSON_NUMERIC_CHECK); ?>;
                var dataKontaMylea = <?php echo json_encode($KontaminasiMylea, JSON_NUMERIC_CHECK); ?>;
                var labelMylea = [];
                var Mylea = [];
                var KontaMylea = [];
                for(i = 0; i < dataBaglog.length; i++){
                    if(dataMylea[i]["label"] != null){
                        labelMylea.push(dataBaglog[i]["label"]);
                        Mylea.push(dataMylea[i]["y"]);
                        var temp = dataKontaMylea.findIndex(item => item.label === dataMylea[i]["label"]);
                        console.log(temp)
                        if(temp != (-1)){
                            KontaMylea.push(dataKontaMylea[temp]["y"]);
                        } else{
                            KontaMylea.push("0");
                        }
                        Mylea[i] = Mylea[i] - KontaMylea[i];
                        console.log(Mylea[i]);
                    }

                }
                var chart2 = new Chart("chartContainer2", {
                    plugins: [ChartDataLabels],
                    type: "bar",
                    data: {
                        labels: label,
                        datasets: [
                        {
                            type: "bar",
                            backgroundColor: "rgba(202,150,92, 0.8)",
                            borderColor: "rgba(202, 150, 92, 1)",
                            borderWidth: 1,
                            data: Mylea,
                            label: "Production",
                            legends: {
                                display: false,
                            },
                            datalabels: {
                                display: false,
                            }
                        },
                        {
                            type: "bar",
                            backgroundColor: "rgba(92, 144, 202, 1)",
                            borderColor: "rgba(92, 144, 202, 1)",
                            borderWidth: 1,
                            label: "Contamination",
                            data: KontaMylea,
                            lineTension: 0, 
                            fill: false,
                            datalabels: {
                                color: '#000000',
                                anchor: 'end',
                                align: 'end',
                                offset: 0,
                                formatter: function(value, context) {
                                    var production = parseInt(Mylea[context.dataIndex]) + parseInt(value);
                                    var CRate = parseInt(value)/parseInt(production) * 100 ;
                                    var x = ["Production : " + production,"Ready To Use :" + Mylea[context.dataIndex] + "\n"+ Math.round(CRate, 0) + "%"]; 
                                    console.log(context);
                                    return x;
                                },
                                textAlign: 'left',
                                font: {
                                    size: 12,
                                }
                            } 
                        },
                        ]
                    },
                    options: {
                        responsive: false,
                        legend: {
                            display: false, // place legend on the right side of chart
                        },
                        scales: {
                            xAxes: [{
                                stacked: true // this should be set to make the bars stacked
                            }],
                            yAxes: [{
                                stacked: true // this also..
                            }]
                        }
                    }
                });
                chart2.render();
                debugger;
                charts.push(chart2);


                }
                $(window).resize(function() {
                    for(var i = 0; i < charts.length; i++) {
                        charts[i].options.width = $('.chart').width();
                        charts[i].options.height = $('.chart').height();
                        console.log($('.chart').height())
                        charts[i].render();
                    }
                });
        </script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@1"></script>

@endsection