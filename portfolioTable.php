<?php
include_once 'header.php';
include_once 'includes/api.inc.php';
include_once 'includes/connection.php';
#include_once 'pieChartHoldings.php';
?>
<main>
  <style>
    /* body {
      background-image: url('img/stock_back.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;header
    } */
    html,
    body,
    .container {
      height: 100%;
      min-height: 100%;
    }

    .box1 {
      /* Stocks tiles banner */
      float: top;
      width: 100%;
      height: 30%;
      background-color: purple;
    }

    .box2 {
      /*Third*/
      /*Portfolio */
      float: right;
      width: 80%;
      height: 80%;
      /* background-color: blue; */
    }

    .box3 {
      /*First*/
      /* Money stats */
      float: left;
      width: 20%;
      height: 30%;
      position: relative;
      /* background-color: whitesmoke; */
    }

    .box4 {
      /*Second*/
      /*Buy box*/
      float: left;
      width: 20%;
      height: 70%;
      /* background-color: green; */
    }

    #tableTitle {
      color: whitesmoke;
    }

    #moneyVal {
      color: whitesmoke;
      font-weight: bold;
      font-size: x-large;
    }

    #gcpbtn {
      position: absolute;
      right: 0%;
    }

    #ptext {
      color: whitesmoke;
      /* font-family: "Lucida Console", "Courier New", monospace; */
      font-size: larger;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    input[type=text]:focus {
      background-color: lightblue;
    }

    input[type=text] {
      margin: 8px 0;
      width: 65%;
      box-sizing: border-box;
      border: 1px solid #555;
      outline: none;
    }

    input[type=number]:focus {
      background-color: lightblue;
    }

    input[type=number] {
      margin: 8px 0;
      width: 65%;
      box-sizing: border-box;
      border: 1px solid #555;
      outline: none;
    }

    th,
    td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      padding: 12px 16px;
      z-index: 1;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    body {
      background-image: url('img/stock_back.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
  </style>
  <!-- <link rel="stylesheet" href="style.css"> -->

  <link rel='stylesheet' href='css/portfolioTable.scss' />
  <!-- <link rel='stylesheet' href='css/style.css' />
  <link rel='stylesheet' type='text/css' href='/css/testcss.css' /> -->

  <div class=box1>
    <p>Yessir</p>
  </div>


  <!-- <form method="post">
      <input type="submit" id="gcpbtn" name="updatePostBtn" class="button" value="Get Current Price" />
    </form> -->


  <?php
  #echo "<div class = box1>";
  #echo "<p>Yessir</p>";
  #echo "</div>";
  $value = 0;
  $cash =  round($_SESSION["cash"], 2);
  $value = getFromUsers($conn, $_SESSION["UserID"])["cur_value"];
  echo "<div style='clear: both' class = box3>";
  echo "<h4 style='float: left' id='ptext' >Total Cash (CAD): </h4>
        <h3 style='float: center' id='moneyVal' >$$cash</h3>
        <p> </p>
        <h5 style='float: left' id='ptext' >Current Value: </h5>
        <h5 style='float: center' id = moneyVal>$$value</h5>
        ";
  //echo"<h4> Test :$value </h4>";
  echo "<hr />";
  echo "</div>";
  ?>

  </form>
  <?php
  if (array_key_exists('updatePostBtn', $_POST)) {
    updateDatabasePortfolio($conn, $_SESSION["UserID"], $_SESSION["cash"]);
  }
  ?>


  <!-- <form method="post">
    <input type="submit" name="updatePostBtn" class="button" value="Get Current Price" />
  </form> -->

  <!--   <div class=box4>
    <form method="post" action="includes/portfolioTable.inc.php">
      <label style="color:whitesmoke;" for="watchlistTables">Select an option:</label>

      <select name="buySell" id="buySell">
        <option id="ptext" value="-1">Buy</option>
        <option id="ptext" value="1">Sell</option>
      </select>

      <input type="search" id="query" name="query" placeholder="Ticker Symbol...">

      <input name="quantity" id=quantity placeholder="Quantity" type=number min=1 max=100000>

      <script>
        function increment() {
          document.getElementById('quantity').stepUp();
        }

        function decrement() {
          document.getElementById('quantity').stepDown();
        }
      </script>
      <script src='js/confirmPurchase.js'></script>
      <input type="submit" name="submit" value="Submit">

  </div> -->

  <script>
    function updateVal(val) {
      var s = document.getElementByID("value2");
      s.value = val;
      return "";
    }
  </script>

  <div class="box2">
    <h2 id="tableTitle">My Portfolio <i class="icon-minus"></i></h2>
    <table class="numbers table2">
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
    <form method="post" action="includes/portfolioTable.inc.php">
      <label id="ptext" for="watchlistTables">Select an option:</label>

      <select name="buySell" id="buySell">
        <option id="ptext" value="-1">Buy</option>
        <option id="ptext" value="1">Sell</option>
      </select>

      <input type="text" id="query" name="query" placeholder="Ticker Symbol...">

      <input name="quantity" id=quantity placeholder="Quantity" type=number min=1 max=100000>

      <script>
        function increment() {
          document.getElementById('quantity').stepUp();
        }

        function decrement() {
          document.getElementById('quantity').stepDown();
        }
      </script>
      <script src='js/confirmPurchase.js'></script>
      <input type="submit" name="submit" value="Submit">

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