<?php
 
$dataPoints1 = array(
	array("label"=> "January", "y"=> $DataPoint[1]),
	array("label"=> "February", "y"=> $DataPoint[2]),
	array("label"=> "March", "y"=> $DataPoint[3]),
	array("label"=> "April", "y"=> $DataPoint[4]),
	array("label"=> "May", "y"=> $DataPoint[5]),
	array("label"=> "June", "y"=> $DataPoint[6]),
	array("label"=> "July", "y"=> $DataPoint[7]),
	array("label"=> "August", "y"=> $DataPoint[8]),
	array("label"=> "September", "y"=> $DataPoint[9]),
	array("label"=> "October", "y"=> $DataPoint[10]),
	array("label"=> "November", "y"=> $DataPoint[11]),
    array("label"=> "December", "y"=> $DataPoint[12]),
);

$dataPoints2 = array(
	array("label"=> "January", "y"=> $DataPoint2[1]),
	array("label"=> "February", "y"=> $DataPoint2[2]),
	array("label"=> "March", "y"=> $DataPoint2[3]),
	array("label"=> "April", "y"=> $DataPoint2[4]),
	array("label"=> "May", "y"=> $DataPoint2[5]),
	array("label"=> "June", "y"=> $DataPoint2[6]),
	array("label"=> "July", "y"=> $DataPoint2[7]),
	array("label"=> "August", "y"=> $DataPoint2[8]),
	array("label"=> "September", "y"=> $DataPoint2[9]),
	array("label"=> "October", "y"=> $DataPoint2[10]),
	array("label"=> "November", "y"=> $DataPoint2[11]),
    array("label"=> "December", "y"=> $DataPoint2[12]),
);
 
 
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer3", {
	title: {
		text: "Produksi Baglog"
	},
	theme: "light2",
	animationEnabled: true,
	toolTip:{
		shared: true,
		reversed: true
	},
	axisY: {
		title: "Jumlah Baglog",
		suffix: ""
	},
	legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [
		{
			type: "stackedColumn",
			name: "Produksi Baglog",
			showInLegend: true,
			yValueFormatString: "#",
			dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
		},
        {
			type: "line",
			name: "Kontaminasi",
			showInLegend: true,
			yValueFormatString: "#",
			dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
		},
	]
});
 
chart.render();
 
function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}
 
}
</script>
</head>
<body>
<div id="chartContainer3" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>  