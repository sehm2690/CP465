
<?php
  include_once 'header.php';
  include_once 'includes/api.inc.php';
  include_once 'includes/connection.php';
?>
<main >
    <style>
    /* body {
      background-image: url('img/stock_back.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    } */
    table {
      border-collapse: collapse;
      width: 100%;
    }

  
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

<link rel='stylesheet' href='css/portfolioTable.scss' />
<link rel='stylesheet' href='css/style.css' />


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

  <!-- <input type="submit" name = "submit" value="Submit" onclick="purchasePopup1()"> -->

  <!-- <p style = "visibility: hidden;" id="test" name = "demo">hello</p> -->

  
</form>
<?php
  if(array_key_exists('updatePostBtn',$_POST)){
    updateDatabasePortfolio($conn, $_SESSION["UserID"]);
  }
?>


<form method = "post">
  <input type="submit"  name= "updatePostBtn" class = "button" value = "Get Current Price"/>
</form>

<?php
  $value = 0;
  $cash =  $_SESSION["cash"];
  echo "<h4>Current Cash: $$cash</h4>";
  //echo"<h4> Test :$value </h4>";
?>


<h4 id = "value2" name = "value">Current Value:$ </h4> 

<script>
  function updateVal(val){
    var  s =document.getElementByID("value2");
    s.value = val;
    return"";
  }
</script>


<h2>My Portfolio <i class="icon-minus"></i></h2>
<table class="numbers table2">
  <thead>
  <tr class="header">
    <th class="txt header">Symbol</th>
    <th class="txt header">Description</th>
    <th class="num header">Qty</th>
    <th class="num header">Average Price</th>
    <th class="num header">Current Price</th>
    <th class="num header">Total Value</th>
    <th class="num header">Today's Change</th>
    <th class="num header">Total Gain/Loss</th>
    <th class="num header">Percent % </th>
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
    for ($i=0; $i <count($PortfolioData) ; $i++) {
      $symbol = $PortfolioData[$i]["symbol"];
      $name = $PortfolioData[$i]["name"];
      $qty = $PortfolioData[$i]["qty"];
      $avg_price = $PortfolioData[$i]["avg_price"];
      $current_price = $PortfolioData[$i]["current_price"];
      $total_val = $PortfolioData[$i]["total_val"];
      $todays_gain = $PortfolioData[$i]["todays_gain"];
      $total_gain = $PortfolioData[$i]["total_gain"];
      $percent = $PortfolioData[$i]["percent"];

      $summary_total_value += $total_val;
      
      $summary_todays_gain += $qty*$todays_gain;
      $summary_total_gain += $total_gain;
      

      echo"<tr>";
        echo"<td>$symbol</td>";
        echo"<td>$name</td>";
        echo"<td class = 'num'> $qty</td>";
        echo"<td class = 'num'>$ $avg_price</td>";
        echo"<td class = 'num'>$ $current_price</td>";
        echo"<td class = 'num'>$ $total_val</td>";
        echo"<td class = 'num'>$ $todays_gain</td>";
        echo"<td class = 'num'>$ $total_gain</td>";
        echo"<td class='percent'>$percent %</td>";
      echo"</tr>";
    }
    // //getElementsByTagName("h4").innerHTML;
    if($summary_total_value!=0){
      $summary_percent = ((($summary_total_value + $_SESSION["cash"]) - 100000)/$summary_total_value) * 100;
    }
    $value = $summary_total_value + $_SESSION["cash"];

    //var_dump($value);
    
    echo"<h5>Current Value: $$value </h5>";
    echo '<script type="text/javascript"> updateVal($value); </script>';
    
    echo"</tbody>
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
          <td class='percent'>$summary_percent</td>
        </tr>
        </tfoot>
      </table>";





?>
<!-- 
</tbody>
  <tfoot>
  <tr class="summary">
    <td>Summary</td>
    <td class="number">$s </td>
    <td class="money">$14,993.35</td>
    <td class="money">$0.74</td>
    <td class="money">$0.00</td>
    <td class="money">$14,992.61</td>
    <td class="percent">100%</td>
  </tr>
  </tfoot>
</table> -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://dannocket.com/sandbox/IvtpK.js"></script>
<script src="js/portfolioTable.js"></script>
<script src="js/parseJson.js"></script>
  </main>
<?php



    include_once'footer.php';
?>