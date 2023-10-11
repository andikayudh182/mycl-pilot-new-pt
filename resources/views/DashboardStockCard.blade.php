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
        .card-text{
            color:rgba(202, 150, 92, 1);
        }
        .my-auto{
            margin-top: auto;
            margin-bottom: auto;
        }
        .card-title{
            font-weight: bold;
        }
        .container{
            background-color: rgba(255, 255, 255, 1);
            border-radius: 15px;
        }
    </style>
    <div id="Chart1" class="d-block pt-4" style="height:100vh; background-color: rgb(241, 241, 241, 0.5);">
        <div id="chart-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="background-color: ">
                    <div class="container pt-2 p-4" style="height:90vh;" >
                        <div class="header pb-4">
                            <div class="row"> 
                                <h2 class="col-6">MYCL Impact Metric</h2> <h6 class="col-6 pl-4 text-end" style="font-weight:bold; color:rgba(171, 171, 171, 0.6)"> last updated: 2022-12-31</h6>
                            </div>

                            <h6 class="text-muted">Impact Measurement from <b>Pilot Production</b> Facility</h6>
                        </div>
                        <div class="row">
                            <div class="col-4 d-table">
                                <div class="card border-black card-block d-table-cell align-middle" style="height:15rem; border-radius: 25px;">
                                    <div class="card-body text-center">
                                      <h4 class="card-title" style="font-size:21px;">Total Mylea Produced</h4>
                                      <h6 class="card-subtitle" style="font-size:16px;">(sqft)</h6>
                                      <h2 class="card-text" style="font-weight: bold;font-size:40px;">494</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-table">
                                <div class="card border-black card-block d-table-cell align-middle" style="height:15rem; border-radius: 25px;">
                                    <div class="card-body text-center">
                                      <h4 class="card-title" style="font-size:21px;"># Cow Avoided</h4>
                                      <h6 class="card-subtitle" style="font-size:16px;">(cow)</h6>
                                      <h2 class="card-text" style="font-weight: bold;font-size:40px;">14</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-table">
                                <div class="card border-black card-block d-table-cell align-middle" style="height:15rem; border-radius: 25px;">
                                    <div class="card-body text-center">
                                      <h4 class="card-title" style="font-size:21px;">Total Greenhouse Gasses (GHG)</h4>
                                      <h6 class="card-subtitle" style="font-size:16px;">(Kg CO2-e)</h6>
                                      <h2 class="card-text" style="font-weight: bold;font-size:40px;">4,200.42</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4 d-table">
                                <div class="card border-black card-block d-table-cell align-middle" style="height:15rem; border-radius: 25px;">
                                    <div class="card-body text-center">
                                      <h4 class="card-title" style="font-size:21px;"># Water Usage Reduction </br>(total production)</h4>
                                      <h6 class="card-subtitle" style="font-size:16px;">(L)</h6>
                                      <h2 class="card-text" style="font-weight: bold;font-size:40px;">477,803.4</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-table">
                                <div class="card border-black card-block d-table-cell align-middle" style="height:15rem; border-radius: 25px;">
                                    <div class="card-body text-center">
                                      <h4 class="card-title" style="font-size:21px;"># Water Usage Reduction</br> (post treatment only)</h4>
                                      <h6 class="card-subtitle" style="font-size:16px;">(L)</h6>
                                      <h2 class="card-text" style="font-weight: bold;font-size:40px;">3,137.7</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-table">
                                <div class="card border-black card-block d-table-cell align-middle" style="height:15rem; border-radius: 25px;">
                                    <div class="card-body text-center">
                                      <h4 class="card-title" style="font-size:21px;">GHG Avoided </br> Compared to Cow Leather</h4>
                                      <h6 class="card-subtitle" style="font-size:16px;">(Kg CO2-e)</h6>
                                      <h2 class="card-text" style="font-weight: bold;font-size:40px;">850.97</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="footer pt-4">
                            <p class="text-muted">Disclaimer: estimation data only for Mylea and using last year recapitulation. For detailed calculation, read MYCL sustainability report</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-treemap@2.0.1/dist/chartjs-chart-treemap.js"></script>
                    <div class="container pt-2" style="height:90vh;">
                        <div class="row pt-2">
                            <div class="col">
                                <div class="card border-black" style="background-color: rgb(241, 241, 241, 0.8); border-radius: 25px; max-height:70vh;">
                                    <div class="card-body">
                                        <h2 class="card-title d-inline" style="font-weight:bold;">MYLEA Inventory Stock Card</h2> <h6 class="card-title d-inline pl-4" style="font-weight:bold; color:rgba(171, 171, 171, 0.6)"> last updated: 2023-03-20</h6>
                                        <h5 class="card-subtitle mb-2 mt-1 text-muted">Total available MYLEA as finished good</h5>
                                        <center><canvas id="treemap" style="max-height:45vh; width:100%"></canvas><center>
                                    </div>
            
                                    <script>
                                        $('.carousel').carousel({
                                            interval: 7500
                                        });
                                        var data = [
                                            {x:'Mylea Original', z :'Grade A',y:20, color:'#CA965C'},
                                            {x:'Mylea Original', z :'Grade B',y:16, color:'#AD8A67'},
                                            {x:'Mylea Black', z :'Grade A',y:51, color:'#514438'},
                                            {x:'Mylea Black', z :'Grade B',y:80, color:'#737374'},
                                        ];
                                        var color = [
                                                ,
                                                '#AD8A67',
                                                '#514438',
                                                '#737374',
                                                '#DFE0DF',
                                        ];
                    
                                        const options = {
                                        type: 'treemap',
                                        data: {
                                            datasets: [{
                                            label: 'Stockcard Mylea',
                                            tree: data,
                                            groups: ['color'],
                                            key: 'y',
                                            backgroundColor: (ctx) => colorFromRaw(ctx),
                                            labels: {
                                                align: 'left',
                                                display: true,
                                                position: 'bottom',
                                                overflow: 'fit',
                                                formatter(ctx) {
                                                    if (ctx.type !== 'data') {
                                                    return;
                                                    }
                                                    return [ctx.raw._data.children[0].x, ctx.raw._data.children[0].z, ctx.raw._data.y];
                                                },
                                                color: (ctx) => colorText(ctx),
                                                font: {
                                                    size(ctx){
                                                        return ['18'];
                                                    },
                                                },
                                                
                                            },
                                            }]
                                        },
                                        options: {
                                            plugins:{
                                                legend: {
                                                    display: false, // place legend on the right side of chart
                                                },
                                            },
                                        }
                                        };
                                        const ctx = document.getElementById("treemap").getContext('2d');
                                        var chart = new Chart(ctx, options);
                                        function colorFromRaw(ctx){
                                            if (ctx.type !== 'data') {
                                                return 'blue';
                                            }
                                            return ctx.raw._data.children[0].color;
                                        }
                                        function colorText(ctx){
                                            if (ctx.type !== 'data') {
                                                return 'blue';
                                            }
                                            console.log(ctx);
                                            return 'white';
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div class="col-4">
                                <div class="card text-center" style="height:20vh; border-radius: 25px;">
                                    <div class="card-body">
                                        <h4 class="card-title" style="font-size:21px;">Total MYLEA</h4>
                                        <h6 class="card-subtitle" style="font-size:16px;">all grades in inventory</h6>
                                        <h2 class="card-text" style="font-weight: bold;font-size:40px; color:rgba(202, 150, 92, 1);">167</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="card" style="height:20vh; border-radius: 25px;">
                                    <div class="card-body">
                                        <h4 class="card-title" style="font-size:21px;">Grading Guideline</h4>
                                        <h2 class="card-text" style="font-size:16px;"><b>Grade A</b>: size range ; thickness </h2>
                                        <h2 class="card-text" style="font-size:16px;"><b>Grade B</b>: size range ; thickness </h2>
                                        <h2 class="card-text" style="font-size:16px;"><b>Grade C</b>: size range ; thickness </h2>
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

            <div class="d-block pt-2">
                <p class="text-center" style="font-weight: bold;font-size:16px; color:rgb(202, 92, 92);">For your eyes only!</p>
            </div>
        </div>
    </div>
@endsection