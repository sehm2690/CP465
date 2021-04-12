<?php
include_once 'header.php';
include_once 'includes/api.inc.php';
include_once 'includes/connection.php';
?>

<main>
  <link rel='stylesheet' href='css/watchlist.css' />

  <style>
    body {
      background-image: url('img/stock_back.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
  </style>

  <br></br>

  <form method="post" action="includes/watchlist.inc.php">

   


    <div class=box4>
      <p id="txt" >Add a stock to your watchlist:</p>
      <input style="width:100%;" type="text" id="query" name="query" placeholder="Ticker to add...">
      <p></p>
      <input style="float:right;" type="submit" id="addBtn" name="submit1" value="">
      <input type="submit" id="removeBtn" name="submit2" value="">
    </div>

  </form>



<form method = "post">
  <input type="submit" id="gcpbtn" name= "updatePostBtn" class = "button" value=""/>
</form>


  <?php
  if (array_key_exists('updatePostBtn', $_POST)) {
    updateDatabase($conn, $_SESSION["UserID"]);
  }

  if (isset($_GET["error"])) {
    if($_GET["error"] == "tickerDNE"){
        echo "<script> alert('This ticker does not exist!');</script>";
    }

    elseif($_GET["error"]=="AlreadyInWatchlist"){
      echo "<script> alert('This stock is already in your watchlist!');</script>";
    }

    elseif($_GET["error"]=="NotInWatchlist"){
      echo "<script> alert('This stock is not in your watchlist!');</script>";

    }

    elseif($_GET["error"] == "unknown"){
      echo "<script> alert('Unknown error occured!');</script>";

    }
  }


?>



  <div class=box2>
    <h2 style="color:whitesmoke;">My Watchlist <i class="icon-minus"></i></h2>
    <table>
      <thead>
        <tr>
          <th>Stock Ticker</th>
          <th>Stock Name</th>
          <th>Current Price</th>
          <th>Price Change</th>
          <th>Percent Change </th>
        </tr>
      </thead>
      <tbody>
        <?php
        $watchlistData = getFromWatchlist($conn, $_SESSION['UserID']);
        for ($i = 0; $i < count($watchlistData); $i++) {
          $symbol = $watchlistData[$i]["symbol"];
          $name = $watchlistData[$i]["name"];
          $price = $watchlistData[$i]["current_price"];
          $change = $watchlistData[$i]["todays_gain"];
          $perChange = $watchlistData[$i]["percent_change"];


          echo "<tr>";
          echo "<td>$symbol</td>";
          echo "<td>$name</td>";
          echo "<td>$ $price</td>";
          echo "<td>$ $change</td>";
          echo "<td>$perChange%</td>";
          echo "</tr>";
        }

        ?>

      </tbody>
    </table>
  </div>


  <br></br>
  <br></br>

</main>

<?php
include_once 'footer.php'
?>
