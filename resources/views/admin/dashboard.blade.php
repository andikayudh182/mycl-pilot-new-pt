@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="m-2">
                        <a href="{{url('/dashboard-production')}}" class="btn btn-primary">Dashboard Review Production</a>
                    </div>
                    <div id="chart" class="m-2">
                        <script type="text/javascript">
                            window.onload = function () {
                              var chart = new CanvasJS.Chart("chartContainer",
                              {
                                title:{
                                  text: "Data Produksi"
                                
                                },   
                                data: [{        
                                  type: "column",
                                  dataPoints: [
                                      <?php
                                      $x = 1;
                                      $produksi = 0;
                                      for($i = 1; $i < 13; $i++){
                                        $ThisYear = date("Y");
                                        $produksi = 0;
                                        foreach($pembibitan as $data){
                                            $TanggalPengerjaan = $data['TanggalPengerjaan'];
                                            if(substr($TanggalPengerjaan, 0, 4) == $ThisYear){
                                                if(substr($TanggalPengerjaan, 5, 2) == $i){
                                                    $produksi = $produksi + $data['JumlahBaglog'];
                                                }
                                            }
                                        }
                                        ?>
                                        { x: <?php echo $i;?>, y: <?php echo $produksi;?>},
                                        <?php       
                                      }

                                      ?>
                                  ]
                                },
                                {        
                                    type: "line",
                                    dataPoints: [
                                    <?php
                                      $produksi = 0;
                                      for($i = 1; $i < 13; $i++){
                                        $ThisYear = date("Y");
                                        $produksi = 0;
                                        foreach($konta as $data2){
                                            $TanggalPengerjaan = $data2['TanggalKonta'];
                                            if(substr($TanggalPengerjaan, 0, 4) == $ThisYear){
                                                if(substr($TanggalPengerjaan, 5, 2) == $i){
                                                    $produksi = $produksi + $data2['JumlahKonta'];
                                                }
                                            }
                                        }
                                        ?>
                                        { x: <?php echo $i;?>, y: <?php echo $produksi;?>},
                                        <?php       
                                      }

                                      ?>
                                    ]
                                }
                                ]
                              });
                          
                              chart.render();
                            }
                            </script>
                            <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                            <div id="chartContainer" style="height: 300px; width: 100%;">
                            </div>
                    </div>
                    <div id="TaskList" class="m-5">
                        <h3>Today Task List</h3>
                        <h5>Baglog</h5>
                        <div style="height: auto; border: 1px; border-color:rgb(119, 119, 119); border-style: dotted;">
                            <div class="m-2">
                                <h4>Inkubasi</h4>
                                    <table class="table">
                                        <tr>
                                            <th>Kode Produksi</th>
                                            <th>Proses</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    @foreach ($pembibitan as $datainkubasi)
                                        <tr>
                                            @if($datainkubasi['TanggalCrushing']==date('Y-m-d'))
                                            <td><?php echo $datainkubasi['KodeProduksi'];?></td>
                                            <td>Crushing</td>
                                            <td><?php echo $datainkubasi['JumlahBaglog'];?></td>
                                            @endif
                                            @if($datainkubasi['TanggalPanen']==date('Y-m-d'))
                                            <td><?php echo $datainkubasi['KodeProduksi'];?></td>
                                            <td>Panen</td>
                                            <td><?php echo $datainkubasi['JumlahBaglog'];?></td>
                                            @endif
                                        </tr>
                                    @endforeach    
                                    </table>
                                </div>
                        </div>
                        <h5>Mylea</h5>
                        <div style="height: 150px; border: 1px; border-color:rgb(119, 119, 119); border-style: dotted;">
                        </div>
                        <h5>Biobo</h5>
                        <div style="height: 150px; border: 1px; border-color:rgb(119, 119, 119); border-style: dotted;">
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
