<?php
include_once 'header.php';
include_once 'includes/api.inc.php';
include_once 'includes/connection.php';
?>
<main>
  <style>
    body {
      background-image: url('img/stock_back.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
  </style>

  
    th, td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
      background-color: #4CAF50;
      color: white;
    }
    </style>
    <!-- <link rel="stylesheet" href="style.css"> -->



<form method="post" action="includes/portfolioTable.inc.php"> 
  <label for="watchlistTables">Select an option:</label>

  <select name="buySell" id="buySell">
        <option value="-1">Buy</option> 
        <option value="1">Sell</option>
  </select>

  <input type="search" id="query" name="query" placeholder="Ticker Symbol...">

  <!-- <input type="search" id="quantity" name="quantity" placeholder="Quantity... "> -->
  <input name="quantity" id=quantity placeholder="Quantity" type=number min=1 max=100000>
  
  
 
  <script>
    function increment() {
      document.getElementById('quantity').stepUp();
    }
    function decrement() {
      document.getElementById('quantity').stepDown();
    }

    
  </script>
  <!-- <p id="test" name = "test"></p> -->
  <script src='js/confirmPurchase.js'></script>
  <input type="submit" name = "submit" value="Submit">
  
  <link rel='stylesheet' href='css/portfolioTable.scss' />
  <link rel='stylesheet' href='css/portfolio.css' />

  <br></br>

  <form method="post">
    <input type="image" src="img/refreshbutton.png" id="gcpbtn" name="updatePostBtn" class="button" />
  </form>
  
</form>
<?php
  if(array_key_exists('updatePostBtn',$_POST)){
    updateDatabasePortfolio($conn, $_SESSION["UserID"], $_SESSION["cash"]);//<--------------------------------------------------------should be stress tested 
    //updatePortfolio1($conn, $_SESSION["UserID"], $_SESSION["cash"]);
  }

  // if (isset($_GET["error"])) {
  //   echo "THE ERROR ";
  //   var_dump($_GET["error"]);
  //   if($_GET["error"] == "tickerDNE"){
  //     echo "<script> alert('This ticker does not exist!');</script>";
  //   }
  //   if($_GET["error"] == "notEnoughCash"){
  //     echo "<script> alert('You don't have enough Cash!');</script>";
  //   }
  //   if($_GET["error"]=="dontOwnstock"){
  //     echo "<script> alert('You do not own this stock!');</script>";
  //   }
  //   if($_GET["error"]== "dontOwnEnoughstock"){
  //     echo "<script> alert('You do not own enough shares!');</script>";
  //   }
  //   else{
  //     echo "<script> alert('Unknown error occured!');</script>";
  //   }
  // }

  

  if (isset($_GET["error"])) {

    $error = $_GET["error"];
    if(strcmp($error , "tickerDNE") == 0 ){
      echo "<script> alert('This ticker does not exist!');</script>";
      // header('location: ../portfolioTable.php'); 

     }
    else if(strcmp($error,"notEnoughCash") == 0){
      echo "<script> alert('You do not have enough cash!');</script>";
      // header('location: ../portfolioTable.php'); 

    }
    else if(strcmp($error ,"dontOwnstock") == 0 ){
      echo "<script> alert('You do not own this stock!');</script>";
      // header('location: ../portfolioTable.php'); 

    }
    else if(strcmp($error , "dontOwnEnoughstock") == 0 ){
      echo "<script> alert('You do not own enough shares!');</script>";
      // header('location: ../portfolioTable.php'); 

    }
    else if(strcmp($error , "nothingToUpdate") == 0 ){
      echo "<script> alert('There is nothing to update!');</script>";
      // header('location: ../portfolioTable.php'); 

    }else{
      echo "<script> alert('Unknown error occured!');</script>";
      // header('location: ../portfolioTable.php'); 

    }
    
    
  }
?>
<form method = "post">
  <input type="submit"  name= "updatePostBtn" class = "button" value = "Get Current Price"/>
</form>


  <?php
  $value = 0;
  $cash =  round($_SESSION["cash"], 2);
  $cashFormatted = number_format($cash, 2);
  $value = getFromUsers($conn, $_SESSION["UserID"])["cur_value"];
  $valueFormatted = number_format($value, 2);
  $profit = $value - 100000;
  $profitFormatted = number_format($profit, 2);
  echo "<div style='clear: both' class = box3>";
  echo "<h4 style='float: left' id='ptext' >Total Cash (CAD): </h4>
        <h5 style='float: right' id=moneyVal>$$cashFormatted</h5>
        <p> </p>
        <h5 style='float: left' id='ptext' >Current Value: </h5>
        <h5 style='float: right' id=moneyVal>$$valueFormatted</h5>
        <p></p>
        <div style='clear: both'>
        <h6 style='float: left' id='ptext' >Profit: </h6>
        <h5 style='float: right' id =moneyVal>$ $profitFormatted</h5>
        </div>";
  echo "<hr />";
  echo "</div>";
  ?>

  <?php
  if (array_key_exists('updatePostBtn', $_POST)) {
    updateDatabasePortfolio($conn, $_SESSION["UserID"], $_SESSION["cash"]);
  }
  ?>

  <script>
    function updateVal(val) {
      var s = document.getElementByID("value2");
      s.value = val;
      return "";
    }
  </script>

  <div class="box2">
    <h2 id="tableTitle">My Portfolio <i class="icon-minus"></i></h2>
    <table>
      <thead>
        <tr class="main_header">
          <th class="txt_header">Symbol</th>
          <th class="txt_header">Description</th>
          <th class="num_header">Qty</th>
          <th class="num_header">Average Price</th>
          <th class="num_header">Current Price</th>
          <th class="num_header">Current Value</th>
          <th class="num_header">Today's Change</th>
          <th class="num_header">Gain/Loss</th>
          <th class="num_header">% Gain/Loss </th>
        </tr>
      </thead>
      <tbody>
        <?php


        $PortfolioData = getFromPortfolioTable($conn, $_SESSION['UserID']);
        // var_dump($watchlistData);
        $summary_total_value = 0.0;
        $summary_todays_gain = 0.0;
        $summary_total_gain = 0.0;
        $summary_percent = 0.0;
        for ($i = 0; $i < count($PortfolioData); $i++) {
          $symbol = $PortfolioData[$i]["symbol"];
          $name = $PortfolioData[$i]["name"];
          $qty = $PortfolioData[$i]["qty"];
          $avg_price = $PortfolioData[$i]["avg_price"];
          $current_price = $PortfolioData[$i]["current_price"];
          $total_val = $PortfolioData[$i]["total_val"];
          $todays_gain = $PortfolioData[$i]["todays_gain"] * $qty;
          $total_gain = $PortfolioData[$i]["total_gain"];
          $percent = $PortfolioData[$i]["percent"];

          $summary_total_value += $total_val;

          $summary_todays_gain += $todays_gain;
          $summary_total_gain += $total_gain;

          echo "<tr>";
          echo "<td>$symbol</td>";
          echo "<td>$name</td>";
          echo "<td class = 'num'> $qty</td>";
          echo "<td class = 'num'>$ $avg_price</td>";
          echo "<td class = 'num'>$ $current_price</td>";
          echo "<td class = 'num'>$ $total_val</td>";
          echo "<td class = 'num'>$ $todays_gain</td>";
          echo "<td class = 'num'>$ $total_gain</td>";
          echo "<td class='percent'>$percent %</td>";
          echo "</tr>";
        }
        // //getElementsByTagName("h4").innerHTML;
        $value = getFromUsers($conn, $_SESSION["UserID"])["cur_value"];

        if ($summary_total_value != 0) {
          // $summary_percent_cacl = ((($summary_total_value + $_SESSION["cash"]) - 100000)/100000) * 100;
          $summary_percent_cacl = (($value - 100000) / 100000) * 100;

          $summary_percent = round($summary_percent_cacl, 2);
        }
        // $value = $summary_total_value + $_SESSION["cash"];

        // //var_dump($value);

        // echo"<h5>Current Value: $$value </h5>";

        // updateCurrentValue($conn, $_SESSION['UserID'], $value);


        echo '<script type="text/javascript"> updateVal($value); </script>';

        echo "</tbody>
        <tfoot>
        <tr class='summary'>
          <td ></td>
          <td class='number'></td>
          <td class='money'></td>
          <td class='money'></td>
          <td >SUMMARY:</td>
          <td class='money'>$ $summary_total_value</td>
          <td class='money'>$ $summary_todays_gain</td>
          <td class='money'>$ $summary_total_gain</td>
          <td class='percent'>$summary_percent %</td>
        </tr>
        </tfoot>
      </table>";
        ?>
  </div>

  <div class=box4>
    <br></br>
    <form method="post" action="includes/portfolioTable.inc.php">
      <label id="ptext" for="watchlistTables">Select an option:</label>

      <select name="buySell" id="buySell">
        <option id="ptext" name="buy" value="-1">Buy</option>
        <option id="ptext" name="sell" value="1">Sell</option>
      </select>

      <input type="text" id="query" name="query" placeholder="Ticker Symbol...">

      <input name="quantity" id=quantity placeholder="Quantity" type=number min=0 max=100000>

      <script>
        function increment() {
          document.getElementById('quantity').stepUp();
        }

        function decrement() {
          document.getElementById('quantity').stepDown();
        }
      </script>
      <script src='js/confirmPurchase.js'></script>
      <!-- <input type="image" src="img/greencheck.png" id="orderBtn" name="submit" placeholder="Place Order"> -->
      <input type="submit" id="orderBtn" name="submit" Value="">
    </form>

    <!-- <script>
      if (document.getElementByName("buy").value == "-1") {
        console.log("Yeet1");
        document.getElementByName("sell").src = "img/greencheck.png"
      } else if (document.getElementById("buySell").value == "1") {
        console.log("Yeet2");
        document.getElementById("orderBtn").src = "img/redx.png"
      }
    </script> -->

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://dannocket.com/sandbox/IvtpK.js"></script>
  <script src="js/portfolioTable.js"></script>
  <script src="js/parseJson.js"></script>
</main>

<br></br>
<?php
include_once 'footer.php';
?>