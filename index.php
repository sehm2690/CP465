<?php
include_once 'header.php';
// include_once 'pieChartHoldings.php';
?>

<main>
    <!-- <link rel="stylesheet" href="css/style.css"> -->

    <!-- <div style="background-image: url('stock_back.jpg');"> -->
    <style>
        body {
            background-image: url('img/stock_back.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .box1 {
            /* Stocks tiles banner */
            float: top;
            width: 100%;
            height: 30%;
            background-color: whitesmoke;
        }

        .card {
            /* Add shadows to create the "card" effect */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 8%;
            height: 20%;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.4);
        }

        /* Add some padding inside the card container */
        .container {
            padding: 2px 16px;
            text-align: left;
        }

        .tpage {
            
        }
    </style>

    <div class=box1>
        <div class=card>
            <div class="container">
                <h5><b>AAPL</b></h5>
                <p>$127.4</p>
                <p style="font-size: small; color:green;">+31.26(3.01%)</p>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <div class="row">
            <div class="col-md-7">
                <h6 style="color:white">Welcome To:</h6>
                <h1 style="color:white">Stock Simulator</h1>
                <p style="color:white">We are Stock Simulator and we are here to help you practice trading without risking your hard earned money!</p>
                <p style="color:white">By using this product, you will learn how to trade ion the stock market and get the real-time practice you need to become a successful investor!</p>
                <!-- <button id="logout-btn" class="btn btn-light px-5 py-2">Get Started</button> -->
            </div>
        </div>
    </div>



</main>


<?php
include_once 'footer.php'
?>