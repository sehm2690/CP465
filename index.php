<?php
include_once 'header.php';
include_once 'includes/api.inc.php';
include_once 'includes/connection.php';
?>

<main>
    <!-- <link rel="stylesheet" href="css/titlePage.scss"> -->

    <style>
        body {
            background-image: url('img/stock_back.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .row {
            /* Stocks tiles banner */
            float: top;
            width: auto;
            /* Adds a slight more width to the page idk why */
            height: 30%;
            background-color: whitesmoke;
        }

        /* I know this is inefficient af but its hard-coded so whatever */
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 8%;
            height: 20%;
        }

        .card2 {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 8%;
            left: 8;
            height: 20%;
        }

        .card3 {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 8%;
            height: 20%;
        }

        .card4 {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 8%;
            height: 20%;
        }

        .card5 {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 8%;
            top: 0%;
            height: 20%;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.4);
        }

        .card2:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.4);
        }

        .card3:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.4);
        }

        .card4:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.4);
        }

        .card5:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.4);
        }

        /* Add some padding inside the card container */
        .container {
            padding: 2px 16px;
            text-align: left;
        }

        .tpage {
            color: whitesmoke;
            text-align: center;
        }

        .titlelogo {
            width: 500%;
            height: 100%;
            object-fit: cover;
        }

        h1 {
            font-size: 86px;
            font-family: "Sans-Serif-bold";
            padding: 80px 50px;
            text-align: center;
            text-transform: uppercase;
            text-rendering: optimizeLegibility;
        }
    </style>

    <!-- More inefficient code for prab -->
    <div class=row>
        <div class=card>
            <div class="container">
                <h5><b>AAPL</b></h5>
                <p>$127.4</p>
                <p style="font-size: small; color:green;">+31.26(3.01%)</p>
            </div>
        </div>
        <div class=card2>
            <div class="container">
                <h5><b>AAPL</b></h5>
                <p>$127.4</p>
                <p style="font-size: small; color:green;">+31.26(3.01%)</p>
            </div>
        </div>
        <div class=card3>
            <div class="container">
                <h5><b>AAPL</b></h5>
                <p>$127.4</p>
                <p style="font-size: small; color:green;">+31.26(3.01%)</p>
            </div>
        </div>
        <div class=card4>
            <div class="container">
                <h5><b>AAPL</b></h5>
                <p>$127.4</p>
                <p style="font-size: small; color:green;">+31.26(3.01%)</p>
            </div>
        </div>
        <div class=card5>
            <div class="container">
                <h5><b>AAPL</b></h5>
                <p>$127.4</p>
                <p style="font-size: small; color:green;">+31.26(3.01%)</p>
            </div>
        </div>

    </div>

    <br></br>

    <!-- <?php
            include_once 'pieChartHoldings.php';
            ?> -->

    <div class="container text-center">
        <div class="tpage">
            <div class="col-md-12">
                <h4 id="tpage">Welcome To:</h4>
                <h1 id="tpage">Stock Simulator</h1>
                <p id="tpage">We are Stock Simulator and we are here to help you practice trading without risking your hard earned money!</p>
                <p id="tpage">By using this product, you will learn how to trade ion the stock market and get the real-time practice you need to become a successful investor!</p>
            </div>
        </div>
    </div>


</main>


<?php
include_once 'footer.php';
include_once 'pieChartHoldings.php';
?>