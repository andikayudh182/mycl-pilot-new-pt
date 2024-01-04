<?php
 //Produksi
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
//Jumlah Panen
$dataPoints2 = array(
	array("label"=> "January", "y"=> $DataPoint2[1], "markerColor" => $DataMarker[1]),
	array("label"=> "February", "y"=> $DataPoint2[2], "markerColor" => $DataMarker[2]),
	array("label"=> "March", "y"=> $DataPoint2[3], "markerColor" => $DataMarker[3]),
	array("label"=> "April", "y"=> $DataPoint2[4], "markerColor" => $DataMarker[4]),
	array("label"=> "May", "y"=> $DataPoint2[5], "markerColor" => $DataMarker[5]),
	array("label"=> "June", "y"=> $DataPoint2[6], "markerColor" => $DataMarker[6]),
	array("label"=> "July", "y"=> $DataPoint2[7], "markerColor" => $DataMarker[7]),
	array("label"=> "August", "y"=> $DataPoint2[8], "markerColor" => $DataMarker[8]),
	array("label"=> "September", "y"=> $DataPoint2[9], "markerColor" => $DataMarker[9]),
	array("label"=> "October", "y"=> $DataPoint2[10], "markerColor" => $DataMarker[10]),
	array("label"=> "November", "y"=> $DataPoint2[11], "markerColor" => $DataMarker[11]),
    array("label"=> "December", "y"=> $DataPoint2[12], "markerColor" => $DataMarker[12]),
);

$dataPoints4 = array(
	array("label"=> "January", "y"=> $DataPoint4[1]),
	array("label"=> "February", "y"=> $DataPoint4[2]),
	array("label"=> "March", "y"=> $DataPoint4[3]),
	array("label"=> "April", "y"=> $DataPoint4[4]),
	array("label"=> "May", "y"=> $DataPoint4[5]),
	array("label"=> "June", "y"=> $DataPoint4[6]),
	array("label"=> "July", "y"=> $DataPoint4[7]),
	array("label"=> "August", "y"=> $DataPoint4[8]),
	array("label"=> "September", "y"=> $DataPoint4[9]),
	array("label"=> "October", "y"=> $DataPoint4[10]),
	array("label"=> "November", "y"=> $DataPoint4[11]),
    array("label"=> "December", "y"=> $DataPoint4[12]),
);

$dataPointsDirect1 = array(
	array("label"=> "January", "y"=> $DataPointDirect[1]),
	array("label"=> "February", "y"=> $DataPointDirect[2]),
	array("label"=> "March", "y"=> $DataPointDirect[3]),
	array("label"=> "April", "y"=> $DataPointDirect[4]),
	array("label"=> "May", "y"=> $DataPointDirect[5]),
	array("label"=> "June", "y"=> $DataPointDirect[6]),
	array("label"=> "July", "y"=> $DataPointDirect[7]),
	array("label"=> "August", "y"=> $DataPointDirect[8]),
	array("label"=> "September", "y"=> $DataPointDirect[9]),
	array("label"=> "October", "y"=> $DataPointDirect[10]),
	array("label"=> "November", "y"=> $DataPointDirect[11]),
    array("label"=> "December", "y"=> $DataPointDirect[12]),
);
//Kontaminasi
$dataPointsDirect2 = array(
	array("label"=> "January", "y"=> $DataPointDirect2[1], "markerColor" => $DataMarkerDirect[1]),
	array("label"=> "February", "y"=> $DataPointDirect2[2], "markerColor" => $DataMarkerDirect[2]),
	array("label"=> "March", "y"=> $DataPointDirect2[3], "markerColor" => $DataMarkerDirect[3]),
	array("label"=> "April", "y"=> $DataPointDirect2[4], "markerColor" => $DataMarkerDirect[4]),
	array("label"=> "May", "y"=> $DataPointDirect2[5], "markerColor" => $DataMarkerDirect[5]),
	array("label"=> "June", "y"=> $DataPointDirect2[6], "markerColor" => $DataMarkerDirect[6]),
	array("label"=> "July", "y"=> $DataPointDirect2[7], "markerColor" => $DataMarkerDirect[7]),
	array("label"=> "August", "y"=> $DataPointDirect2[8], "markerColor" => $DataMarkerDirect[8]),
	array("label"=> "September", "y"=> $DataPointDirect2[9], "markerColor" => $DataMarkerDirect[9]),
	array("label"=> "October", "y"=> $DataPointDirect2[10], "markerColor" => $DataMarkerDirect[10]),
	array("label"=> "November", "y"=> $DataPointDirect2[11], "markerColor" => $DataMarkerDirect[11]),
    array("label"=> "December", "y"=> $DataPointDirect2[12], "markerColor" => $DataMarkerDirect[12]),
);

$dataPointsDirect4 = array(
	array("label"=> "January", "y"=> $DataPointDirect4[1]),
	array("label"=> "February", "y"=> $DataPointDirect4[2]),
	array("label"=> "March", "y"=> $DataPointDirect4[3]),
	array("label"=> "April", "y"=> $DataPointDirect4[4]),
	array("label"=> "May", "y"=> $DataPointDirect4[5]),
	array("label"=> "June", "y"=> $DataPointDirect4[6]),
	array("label"=> "July", "y"=> $DataPointDirect4[7]),
	array("label"=> "August", "y"=> $DataPointDirect4[8]),
	array("label"=> "September", "y"=> $DataPointDirect4[9]),
	array("label"=> "October", "y"=> $DataPointDirect4[10]),
	array("label"=> "November", "y"=> $DataPointDirect4[11]),
    array("label"=> "December", "y"=> $DataPointDirect4[12]),
);
 
 //print_r($DataMarkerDirect);
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer3", {
	title: {
		text:  "{!! 'Mylea Production (Total) '. $YearSetting!!}"
	},
	theme: "light2",
	animationEnabled: true,
	toolTip:{
		shared: true,
		reversed: true
	},
	axisY: {
		title: "Total Mylea",
		suffix: ""
	},
	legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [
		{
			type: "stackedColumn",
			name: "Mylea Production",
			showInLegend: true,
			yValueFormatString: "#",
			dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
		},
        {
			type: "line",
			name: "Total Harvest",
			showInLegend: true,
			yValueFormatString: "#",
			dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
		},
		{
			type: "line",
			name: "Under Incubation",
			showInLegend: true,
			yValueFormatString: "#",
			dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>
		},
	]
});
 
chart.render();

var chart4 = new CanvasJS.Chart("chartContainer4", {
		title: {
			text:  "{!! 'Mylea Production Direct Transfer '. $YearSetting!!}"
		},
		theme: "light2",
		animationEnabled: true,
		toolTip:{
			shared: true,
			reversed: true
		},
		axisY: {
			title: "Total Mylea",
			suffix: ""
		},
		legend: {
			cursor: "pointer",
			itemclick: toggleDataSeriesDirect
		},
		data: [
			{
				type: "stackedColumn",
				name: "Mylea Production",
				showInLegend: true,
				yValueFormatString: "#",
				dataPoints: <?php echo json_encode($dataPointsDirect1, JSON_NUMERIC_CHECK); ?>
			},
			{
				type: "line",
				name: "Total Harvest",
				showInLegend: true,
				yValueFormatString: "#",
				dataPoints: <?php echo json_encode($dataPointsDirect2, JSON_NUMERIC_CHECK); ?>
			},
			{
				type: "line",
				name: "Under Incubation",
				showInLegend: true,
				yValueFormatString: "#",
				dataPoints: <?php echo json_encode($dataPointsDirect4, JSON_NUMERIC_CHECK); ?>
			},
		]
		
	});
	 
	chart4.render();
	 
	function toggleDataSeriesDirect(e) {
		if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
			e.dataSeries.visible = false;
		} else {
			e.dataSeries.visible = true;
		}
		e.chart4.render();
	}
 
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