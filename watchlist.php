<?php
include_once 'header.php';
include_once 'includes/api.inc.php';
include_once 'includes/connection.php';
//session_start();
?>

<main>
  <link rel='stylesheet' href='css/watchlist.scss' />
  <!-- <link rel='stylesheet' href='css/style.css' /> -->

  <style>
    table {
      border-collapse: collapse;
      width: 100%;
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

    body {
      background-image: url('img/stock_back.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }

    #gcpbtn {
      position: absolute;
      right: 0%;
    }
  </style>

  <form method="post" action="includes/watchlist.inc.php">

    <!--  <label for="watchlistTables">Choose a Watchlist:</label>

    <select name="watchlists" id="watchlists">
      <option value="0">First Watchlist</option>
      <option value="1">Second Watchlist</option>
    </select>

-->
    <input type="search" id="query" name="query" placeholder="Search Symbol...">
    <input type="submit" name="submit1" value="Add">
    <input type="submit" name="submit2" value="Remove">

    <input type="submit" id="gcpbtn" name="updateBtn" class="button" value="Get Current Price" />

  </form>

  <?php
  if (array_key_exists('updateBtn', $_POST)) {
    updateDatabase($conn, $_SESSION["UserID"]);
  }
  ?>

  <!-- <form method="post">
    <input type="submit" name="updateBtn" class="button" value="Get Current Price" />
  </form> -->


  <!-- <h1>&darr; SCROLL &darr;</h1> -->
  <table class="blue">
    <thead>
      <tr>

        <th>Stock Ticker</th>
        <th>Stock Name</th>
        <th>Current Price</th>
        <th>Price Change</th>
        <th>Percent Change </th>

        <!-- <th>% Change</th> -->

      </tr>
    </thead>
    <tbody>
      <?php
      $watchlistData = getFromWatchlist($conn, $_SESSION['UserID']);
      // var_dump($watchlistData);
      for ($i = 0; $i < count($watchlistData); $i++) {
        $symbol = $watchlistData[$i]["symbol"];
        $name = $watchlistData[$i]["name"];
        $price = $watchlistData[$i]["price"];
        $change = $watchlistData[$i]["price_change"];
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
  <br></br>
  <br></br>


  <!-- <h1 class="scrollMore">&darr; SCROLL MORE &darr;</h1> -->


  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://dannocket.com/sandbox/IvtpK.js"></script> -->
  <script src="js/watchlist.js"></script>

</main>

<?php
include_once 'footer.php'
?>