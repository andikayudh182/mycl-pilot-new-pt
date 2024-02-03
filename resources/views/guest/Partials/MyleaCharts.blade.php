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



// 2024
$dataPoints20241 = array(
	array("label"=> "January", "y"=> $DataPoint2024[1]),
	array("label"=> "February", "y"=> $DataPoint2024[2]),
	array("label"=> "March", "y"=> $DataPoint2024[3]),
	array("label"=> "April", "y"=> $DataPoint2024[4]),
	array("label"=> "May", "y"=> $DataPoint2024[5]),
	array("label"=> "June", "y"=> $DataPoint2024[6]),
	array("label"=> "July", "y"=> $DataPoint2024[7]),
	array("label"=> "August", "y"=> $DataPoint2024[8]),
	array("label"=> "September", "y"=> $DataPoint2024[9]),
	array("label"=> "October", "y"=> $DataPoint2024[10]),
	array("label"=> "November", "y"=> $DataPoint2024[11]),
    array("label"=> "December", "y"=> $DataPoint2024[12]),
);
//Jumlah Panen
$dataPoints20242 = array(
	array("label"=> "January", "y"=> $DataPoint20242[1], "markerColor" => $DataMarker2024[1]),
	array("label"=> "February", "y"=> $DataPoint20242[2], "markerColor" => $DataMarker2024[2]),
	array("label"=> "March", "y"=> $DataPoint20242[3], "markerColor" => $DataMarker2024[3]),
	array("label"=> "April", "y"=> $DataPoint20242[4], "markerColor" => $DataMarker2024[4]),
	array("label"=> "May", "y"=> $DataPoint20242[5], "markerColor" => $DataMarker2024[5]),
	array("label"=> "June", "y"=> $DataPoint20242[6], "markerColor" => $DataMarker2024[6]),
	array("label"=> "July", "y"=> $DataPoint20242[7], "markerColor" => $DataMarker2024[7]),
	array("label"=> "August", "y"=> $DataPoint20242[8], "markerColor" => $DataMarker2024[8]),
	array("label"=> "September", "y"=> $DataPoint20242[9], "markerColor" => $DataMarker2024[9]),
	array("label"=> "October", "y"=> $DataPoint20242[10], "markerColor" => $DataMarker2024[10]),
	array("label"=> "November", "y"=> $DataPoint20242[11], "markerColor" => $DataMarker2024[11]),
    array("label"=> "December", "y"=> $DataPoint20242[12], "markerColor" => $DataMarker2024[12]),
);

$dataPoints20244 = array(
	array("label"=> "January", "y"=> $DataPoint20244[1]),
	array("label"=> "February", "y"=> $DataPoint20244[2]),
	array("label"=> "March", "y"=> $DataPoint20244[3]),
	array("label"=> "April", "y"=> $DataPoint20244[4]),
	array("label"=> "May", "y"=> $DataPoint20244[5]),
	array("label"=> "June", "y"=> $DataPoint20244[6]),
	array("label"=> "July", "y"=> $DataPoint20244[7]),
	array("label"=> "August", "y"=> $DataPoint20244[8]),
	array("label"=> "September", "y"=> $DataPoint20244[9]),
	array("label"=> "October", "y"=> $DataPoint20244[10]),
	array("label"=> "November", "y"=> $DataPoint20244[11]),
    array("label"=> "December", "y"=> $DataPoint20244[12]),
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

var chart2024 = new CanvasJS.Chart("chartContainer2024", {
	title: {
		text:  "{!! 'Mylea Production (Total) '. $YearSetting2024!!}"
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
		itemclick: toggleDataSeries2024
	},
	data: [
		{
			type: "stackedColumn",
			name: "Mylea Production",
			showInLegend: true,
			yValueFormatString: "#",
			dataPoints: <?php echo json_encode($dataPoints20241, JSON_NUMERIC_CHECK); ?>
		},
        {
			type: "line",
			name: "Total Harvest",
			showInLegend: true,
			yValueFormatString: "#",
			dataPoints: <?php echo json_encode($dataPoints20242, JSON_NUMERIC_CHECK); ?>
		},
		{
			type: "line",
			name: "Under Incubation",
			showInLegend: true,
			yValueFormatString: "#",
			dataPoints: <?php echo json_encode($dataPoints20244, JSON_NUMERIC_CHECK); ?>
		},
	]
});
 

chart2024.render();


 
function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}
function toggleDataSeries2024(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart2024.render();
}
 
}
</script>
</head>
<body>
<div id="chartContainer3" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>  