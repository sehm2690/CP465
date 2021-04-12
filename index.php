<?php
include_once 'header.php';
include_once 'includes/api.inc.php';
include_once 'includes/connection.php';
?>

<main>
    <link rel="stylesheet" href="css/index.css">

    <style>
        body {
            background-image: url('img/stock_back.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>

    <div class=row>
    <?php
    $theTop12 = getTop12($conn);
    for ($i=0; $i <12 ; $i++) {
        $symbol = $theTop12[$i]['symbol'];
        $price= $theTop12[$i]['current_price'];
        $todays_gain = $theTop12[$i]['todays_gain'];
        $percent_change= $theTop12[$i]['percent_change'];

        echo "  
        <div class=card>
            <div class='container'>
                <h5><b>$symbol</b></h5>
                <p>$$price</p>
                <p style='font-size: small; color:green;'>$todays_gain($percent_change%)</p>
            </div>
        </div>";
            
    }
    
    ?>
    
    </div>

    <br></br>

   

    <div class="container text-center">
        <div class="tpage">
            <div class="col-md-12">
                <h4 id="tpage">Welcome To:</h4>
                <h1 id="tpage">Stonks Trader</h1>
                <p id="tpage">We are Stonks Trade and we are here to help you practice trading without risking your hard earned money!</p>
                <p id="tpage">By using this product, you will learn how to trade ion the stock market and get the real-time practice you need to become a successful investor!</p>
            </div>
        </div>
    </div>


</main>


<?php
include_once 'footer.php';
?>