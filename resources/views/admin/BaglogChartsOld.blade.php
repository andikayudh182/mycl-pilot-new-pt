<?php
$JumlahBaglog = '0';
$Kontaminasi = '0';
foreach ($pembibitan as $data) {
     $JumlahBaglog = $JumlahBaglog + $data['JumlahBaglog'];
     foreach($konta as $data2){
         if($data2['KodeProduksi'] == $data['KodeProduksi']){
             $Kontaminasi = $Kontaminasi + $data2['JumlahKonta'];
         }
     }
}
if($JumlahBaglog == '0'){
    $PersenKonta = '0';
} else {
    $PersenKonta = $Kontaminasi/$JumlahBaglog*100;
}
?>
<?php
$dataPoints = array( 
    array("label"=>"Hasil Baglog", "y"=> 100-$PersenKonta),
    array("label"=>"Kontaminasi", "y"=> $PersenKonta),
)
 
?>

<script>
    window.onload = function() {
    
    
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: "Produksi Baglog"
        },
        subtitles: [{
            text: "<?php echo date('M-Y');?>"
        }],
        data: [{
            type: "pie",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK);?>
        }]
    });

    var chart2 = new CanvasJS.Chart("chartContainer2", {
        animationEnabled: true,
        theme: "light2",
        title:{
            text: "Data Produksi"
        },
        subtitles: [{
            text: "2022"
        }],
        data: [{        
            type: "line",
            indexLabelFontSize: 16,
            axisYType: "secondary",
            name: "Produksi Baglog",
            dataPoints: [
            <?php
             foreach($pembibitan as $data3){
                 $Tanggal = $data3['TanggalPanen'];
                 $Tahun = substr($Tanggal, 0, 4);
                 $Bulan = substr($Tanggal, 5, 2)-1;
                 $Hari = substr($Tanggal, 8, 2);
            ?>     
                { x:new Date(<?php echo $Tahun.", ".$Bulan.", ".$Hari?>), y: <?php echo $data3['JumlahBaglog'];?> },
            <?php
             }
            ?>
            ]
        }]
    });
    chart.render();
    chart2.render();
    }
</script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<div class="mx-auto">
    <div id="chartContainer" style="height: 370px; width: 47.5%; display: inline-block;"></div>
    <div id="chartContainer2" style="height: 370px; width: 47.5%; display: inline-block;"></div>
</div>