<!DOCTYPE HTML>
<html>

<head>
    <script type="text/javascript">
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Holdings"
                },
                legend: {
                    maxWidth: 350,
                    itemWidth: 120
                },
                data: [{
                    type: "pie",
                    showInLegend: true,
                    legendText: "{indexLabel}",
                    dataPoints: [{
                            y: 4181563,
                            indexLabel: "Cash"
                        },
                        {
                            y: 2175498,
                            indexLabel: "Value"
                        }
                    ]
                }]
            });
            chart.render();
        }
    </script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>

<body>
    <div id="chartContainer" style="height: 250px; width: 15%;"></div>
</body>

</html>