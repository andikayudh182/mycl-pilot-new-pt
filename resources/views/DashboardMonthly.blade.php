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
            .card, #chart{
            border-color: rgb(241, 241, 241, 0.8);
            background-color: rgb(241, 241, 241, 0.8);
            }
        </style>
        <?php
            use Carbon\Carbon;
            foreach($Baglog as $data){
                $data['week'] = (int)Carbon::parse($data->label)->format('W');
            }
            foreach($Mylea as $data){
                $data['week'] = (int)Carbon::parse($data->label)->format('W');
            }
            $Weekly = $Baglog->groupBy('week');
            $WeeklyMylea = $Mylea->groupBy('week');
        ?>
        <div id="Chart1" class="d-block pt-4" style="height:100vh;">
            <div id="chart-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="card border-black" style="border-radius: 25px; max-height:70vh;">
                                        <div class="card-body">
                                            <h2 class="card-title d-inline" style="font-weight:bold;">BAGLOG Making in Weekly Trend</h2> <h6 class="card-title d-inline pl-4" style="font-weight:bold; color:rgba(171, 171, 171, 0.6)"> last updated: 2023-03-20</h6>
                                            <h5 class="card-subtitle mb-2 mt-1 text-muted"><b>Baglog making</b> is a process to mix substrate and mushroom spawn</h5>
                                            <center><canvas id="chartContainer1" class="chart" style="max-height:55vh; width:110vh"></canvas><center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-4">
                                    <div class="card" style="height:10rem; border-radius: 25px;">
                                        <div class="card-body text-center">
                                            <h4 class="card-title" style="font-size:21px;">Total Production</h4>
                                            <h6 class="card-subtitle" style="font-size:16px;">in past 30 days</h6>
                                            <h2 class="card-text" style="font-weight: bold;font-size:40px; color:rgba(202, 150, 92, 1)">{{$Baglog->sum('y')}}</h2>
                                            <h6 class="card-subtitle text-muted pb-4" style="font-size:16px;">{{Carbon::now()->subMonth(1)->format('Y-m-01').' - '.Carbon::now()->format('Y-m-01')}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card" style="height:10rem; border-radius: 25px;">
                                        <div class="card-body text-center">
                                            <h4 class="card-title" style="font-size:21px;">Total Contamination</h4>
                                            <h6 class="card-subtitle" style="font-size:16px;">in past 30 days</h6>
                                            <h2 class="card-text" style="font-weight: bold;font-size:40px; color:rgba(92, 144, 202, 1);">{{$KontaminasiBaglog->sum('y')}}</h2>
                                            <h6 class="card-subtitle text-muted pb-4" style="font-size:16px;">{{Carbon::now()->subMonth(1)->format('Y-m-01').' - '.Carbon::now()->format('Y-m-01')}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card" style="height:10rem; border-radius: 25px;">
                                        <div class="card-body text-center">
                                            <h4 class="card-title" style="font-size:21px;">Total Contamination</h4>
                                            <h6 class="card-subtitle" style="font-size:16px;">in past 30 days</h6>
                                            <h2 class="card-text" style="font-weight: bold;font-size:40px; color:rgba(92, 144, 202, 1);">{{round($KontaminasiBaglog->sum('y')/$Baglog->sum('y')*100, 2)}}%</h2>
                                            <h6 class="card-subtitle text-muted pb-4" style="font-size:16px;">Quarterly basis target: 10%</h6>
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
                                            <h2 class="card-title d-inline" style="font-weight:bold;">MYLEA Making in Weekly Trend</h2> <h6 class="card-title d-inline pl-4" style="font-weight:bold; color:rgba(171, 171, 171, 0.6)"> last updated: 2023-03-20</h6>
                                            <h5 class="card-subtitle mb-2 mt-1 text-muted"><b>Mylea making</b>is a process to grow Mylea on incubation tray</h5>
                                            <center><canvas id="chartContainer2" class="chart" style="max-height:55vh; width:110vh"></canvas><center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-4">
                                    <div class="card" style="height:10rem; border-radius: 25px;">
                                        <div class="card-body text-center">
                                            <h4 class="card-title" style="font-size:21px;">Total Production</h4>
                                            <h6 class="card-subtitle" style="font-size:16px;">in past 30 days</h6>
                                            <h2 class="card-text" style="font-weight: bold;font-size:40px; color:rgba(202, 150, 92, 1)">{{$Mylea->sum('y')}}</h2>
                                            <h6 class="card-subtitle text-muted pb-4" style="font-size:16px;">{{Carbon::now()->subMonth(1)->format('Y-m-01').' - '.Carbon::now()->format('Y-m-01')}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card" style="height:10rem; border-radius: 25px;">
                                        <div class="card-body text-center">
                                            <h4 class="card-title" style="font-size:21px;">Total Contamination</h4>
                                            <h6 class="card-subtitle" style="font-size:16px;">in past 30 days</h6>
                                            <h2 class="card-text" style="font-weight: bold;font-size:40px; color:rgba(92, 144, 202, 1);">{{$KontaminasiMylea->sum('y')}}</h2>
                                            <h6 class="card-subtitle text-muted pb-4" style="font-size:16px;">{{Carbon::now()->subMonth(1)->format('Y-m-01').' - '.Carbon::now()->format('Y-m-01')}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card" style="height:10rem; border-radius: 25px;">
                                        <div class="card-body text-center">
                                            <h4 class="card-title" style="font-size:21px;">Total Contamination</h4>
                                            <h6 class="card-subtitle" style="font-size:16px;">in past 30 days</h6>
                                            <h2 class="card-text" style="font-weight: bold;font-size:40px; color:rgba(92, 144, 202, 1);">{{round($KontaminasiMylea->sum('y')/$Mylea->sum('y')*100, 2)}}%</h2>
                                            <h6 class="card-subtitle text-muted pb-4" style="font-size:16px;">Quarterly basis target: 10%</h6>
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
                debugger;
                height = $('.chart').height();

                $('.carousel').carousel({
                    interval: 7500
                });
                window.onload = function() {
                var i = 1;
                var dataBaglog = <?php echo json_encode($Weekly, JSON_NUMERIC_CHECK); ?>;
                var data = <?php echo json_encode($Weekly, JSON_NUMERIC_CHECK); ?>;
                var dataKontaBaglog = <?php echo json_encode($KontaminasiBaglog, JSON_NUMERIC_CHECK); ?>;
                var label = [];
                var Baglog = [];
                var KontaBaglog = [];
                for(i = 0; i < Object.keys(dataBaglog).length; i++){
                    console.log(Object.keys(dataBaglog));
                    var keys = Object.keys(dataBaglog);
                    if(dataBaglog[keys[i]] != null){
                        label.push(i+1);
                        y = 0;
                        console.log(dataBaglog[keys[i]]);
                        for(j = 0; j < Object.keys(dataBaglog[keys[i]]).length; j++){
                            y += dataBaglog[keys[i]][j]['y'];
                        }
                        Baglog.push(y);
                    }

                }
                console.log(label);
                var chart = new Chart("chartContainer1", {
                    type: "bar",
                    plugins: [ChartDataLabels],
                    data: {
                        labels: label,
                        legends: {
                                display: false,
                            },
                        datasets: [
                        {
                            type: "bar",
                            backgroundColor: "rgba(202,150,92,1)",
                            borderColor: "rgba(202, 150, 92, 1)",
                            borderWidth: 1,
                            lineTension: 0,
                            data: Baglog,
                            datalabels: {
                                color: "rgba(202, 150, 92, 1)",
                                anchor: 'end',
                                align: 'end',
                                offset: 0,
                                formatter: function(value, context) {
                                    var production = parseInt(Baglog[context.dataIndex]) + parseInt(value);
                                    var x = production + " (bags)"; 
                                    return x;
                                },
                                textAlign: 'center',
                                font: {
                                    size: 18,
                                    weight: 'bold',
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

                var dataMylea = <?php echo json_encode($WeeklyMylea, JSON_NUMERIC_CHECK); ?>;
                var dataKontaMylea = <?php echo json_encode($KontaminasiMylea, JSON_NUMERIC_CHECK); ?>;
                var Mylea = [];
                var KontaMylea = [];
                var labelMylea = [];
                for(i = 0; i < Object.keys(dataMylea).length; i++){
                    console.log(Object.keys(dataMylea));
                    var keys = Object.keys(dataMylea);
                    if(dataMylea[keys[i]] != null){
                        labelMylea.push(i+1);
                        y = 0;
                        console.log(dataMylea[keys[i]]);
                        for(j = 0; j < Object.keys(dataMylea[keys[i]]).length; j++){
                            y += dataMylea[keys[i]][j]['y'];
                        }
                        Mylea.push(y);
                    }

                }
                var chart2 = new Chart("chartContainer2", {
                    type: "bar",
                    plugins: [ChartDataLabels],
                    data: {
                        labels: labelMylea,
                        legends: {
                                display: false,
                            },
                        datasets: [
                        {
                            type: "bar",
                            backgroundColor: "rgba(202,150,92,1)",
                            borderColor: "rgba(202, 150, 92, 1)",
                            borderWidth: 1,
                            lineTension: 0,
                            data: Mylea,
                            datalabels: {
                                color: "rgba(202, 150, 92, 1)",
                                anchor: 'end',
                                align: 'end',
                                offset: 0,
                                formatter: function(value, context) {
                                    var production = parseInt(Mylea[context.dataIndex]) + parseInt(value);
                                    var x = production + " (bags)"; 
                                    return x;
                                },
                                textAlign: 'center',
                                font: {
                                    size: 18,
                                    weight: 'bold',
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
                        charts[i].render();
                    }
                });
        </script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@1"></script>

@endsection