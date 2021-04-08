<?php
include_once 'header.php';
include_once 'includes/api.inc.php';
include_once 'includes/connection.php';
//session_start();
?>

<main>
  <link rel='stylesheet' href='css/watchlist.scss' />
  <link rel='stylesheet' href='css/style.css' />


  <form method="post" action="includes/watchlist.inc.php">
    <label for="watchlistTables">Choose a Watchlist:</label>

    <select name="watchlists" id="watchlists">
      <option value="0">First Watchlist</option>
      <option value="1">Second Watchlist</option>
    </select>

    <input type="search" id="query" name="query" placeholder="Search Symbol...">
    <input type="submit" name="submit" value="Add">
  </form>

  <?php
  if (array_key_exists('updateBtn', $_POST)) {
    updateDatabase($conn, $_SESSION["UserID"]);
  }
  ?>


  <form method="post">
    <input type="submit" style="position: absolute;top: 4.7%;right: 0%;" name="updateBtn" class="button" value="Get Current Price" />
  </form>


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
      $watchlistData = getFromDatabase($conn, $_SESSION['UserID']);
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


  <!-- <h1 class="scrollMore">&darr; SCROLL MORE &darr;</h1> -->
  <table class="purple">
    <thead>
      <tr>
        <th>Stock Name</th>
        <th>Last Price</th>
        <th>Change</th>
        <th>% Change</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>JWN</td>
        <td>41.37</td>
        <td>3.97</td>
        <td>10.61</td>
      </tr>
      <tr>
        <td>JWN</td>
        <td>41.37</td>
        <td>3.97</td>
        <td>10.61</td>
      </tr>
      <tr>
        <td>JWN</td>
        <td>41.37</td>
        <td>3.97</td>
        <td>10.61</td>
      </tr>
      <tr>
        <td>JWN</td>
        <td>41.37</td>
        <td>3.97</td>
        <td>10.61</td>
      </tr>
      <tr>
        <td>JWN</td>
        <td>41.37</td>
        <td>3.97</td>
        <td>10.61</td>
      </tr>
      <tr>
        <td>JWN</td>
        <td>41.37</td>
        <td>3.97</td>
        <td>10.61</td>
      </tr>
      <tr>
        <td>JWN</td>
        <td>41.37</td>
        <td>3.97</td>
        <td>10.61</td>
      </tr>
      <tr>
        <td>JWN</td>
        <td>41.37</td>
        <td>3.97</td>
        <td>10.61</td>
      </tr>
      <tr>
        <td>JWN</td>
        <td>41.37</td>
        <td>3.97</td>
        <td>10.61</td>
      </tr>
      <tr>
        <td>JWN</td>
        <td>41.37</td>
        <td>3.97</td>
        <td>10.61</td>
      </tr>
      <tr>
        <td>JWN</td>
        <td>41.37</td>
        <td>3.97</td>
        <td>10.61</td>
      </tr>
      <tr>
        <td>JWN</td>
        <td>41.37</td>
        <td>3.97</td>
        <td>10.61</td>
      </tr>
      <tr>
        <td>JWN</td>
        <td>41.37</td>
        <td>3.97</td>
        <td>10.61</td>
      </tr>
      <tr>
        <td>JWN</td>
        <td>41.37</td>
        <td>3.97</td>
        <td>10.61</td>
      </tr>
      <tr>
        <td>JWN</td>
        <td>41.37</td>
        <td>3.97</td>
        <td>10.61</td>
      </tr>
      <tr>
        <td>JWN</td>
        <td>41.37</td>
        <td>3.97</td>
        <td>10.61</td>
      </tr>
    </tbody>
  </table>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://dannocket.com/sandbox/IvtpK.js"></script>
  <script src="js/watchlist.js"></script>

</main>

<?php
include_once 'footer.php'
?>