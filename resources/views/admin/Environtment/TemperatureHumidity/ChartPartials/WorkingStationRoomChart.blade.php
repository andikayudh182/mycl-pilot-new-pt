<html>
<head>
<script>
window.onload = function () {
        
    var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2",
    title: {
        text: "Working Station Room Temperature"
    },
    axisX: {
    valueFormatString: "DD MMM, YYYY HH:mm:ss",
    labelFormatter: function (e) {
        return CanvasJS.formatDate(new Date(e.value), "DD MMM, YYYY HH:mm:ss");
    },
    crosshair: {
        enabled: true,
        snapToDataPoint: true
    }
},


    axisY: {
        title: "",
        includeZero: true,
        crosshair: {
            enabled: true
        },
        titleFontSize: 25,
        titleFontWeight: "bold"
    },
    toolTip: {
        shared: true,
        contentFormatter: function (e) {
            var date = new Date(e.entries[0].dataPoint.x);
            var formattedDate = CanvasJS.formatDate(date, "DD MMM, YYYY HH:mm:ss");
            var content = "Date: " + formattedDate + "<br/>";

            for (var i = 0; i < e.entries.length; i++) {
                var dataSeriesName = e.entries[i].dataSeries.name;
                var dataPointValue = e.entries[i].dataPoint.y;

                // Ubah unit berdasarkan nama dataSeries
                if (dataSeriesName === "Temperature") {
                    content += "Temperature: " + dataPointValue + "°C<br/>";
                } else if (dataSeriesName === "Humidity") {
                    content += "Humidity: " + dataPointValue + "%<br/>";
                } else {
                    // Jika nama dataSeries tidak cocok, gunakan "Degree"
                    content += dataSeriesName + ": " + dataPointValue + " Degree<br/>";
                }
            }

            return content;
        }


    },
    legend: {
        cursor: "pointer",
        verticalAlign: "bottom",
        horizontalAlign: "left",
        dockInsidePlotArea: true,
        itemclick: toggleDataSeries
    },
    data: [
        {
            type: "line",
            showInLegend: true,
            name: "Temperature",
            markerType: "square",
            xValueFormatString: "DD MMM, YYYY HH:mm:ss",
            color: "#F08080",
            dataPoints: <?php echo $dataPointsTemperature; ?>
        },
        {
            type: "line",
            showInLegend: true,
            name: "Humidity",
            markerType: "square",
            xValueFormatString: "DD MMM, YYYY HH:mm:ss",
            color: "#4CAF50", // Ganti dengan warna yang sesuai
            dataPoints: <?php echo $dataPointsHumidity; ?>
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
    chart.render();
}
    
        function toogleDataSeries(e){
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else{
                e.dataSeries.visible = true;
            }
            chart.render();
        }
        
        }
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>