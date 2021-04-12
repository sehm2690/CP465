<main>
    <style>
        #chartContainer {
            height: 370px;
            width: 25%;
            background: rgba(255, 255, 255, 1);
        }
    </style>

    <?php
    $value = 0;
    $cash =  round($_SESSION["cash"], 2);
    $value = getFromUsers($conn, $_SESSION["UserID"])["cur_value"];
    $dataPoints = array(
        array("label" => "Cash", "y" => $cash),
        array("label" => "Value", "y" => $value),
        // array("label" => "IE", "y" => 8.47),
        // array("label" => "Safari", "y" => 6.08),
        // array("label" => "Edge", "y" => 4.29),
        // array("label" => "Others", "y" => 4.59)
    )

    ?>

    <div id="chartContainer"></div>

    <script>
        window.onload = function() {


            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Yeet"
                },
                data: [{
                    type: "pie",
                    yValueFormatString: "$#,##0.00\"\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</main>