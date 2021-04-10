<?php
include_once 'header.php';
include_once 'includes/api.inc.php';
include_once 'includes/connection.php';
//session_start();
?>

<main>
  <!-- <link rel='stylesheet' href='css/watchlist.scss' /> -->
  <!-- <link rel='stylesheet' href='css/style.css' /> -->

  <style>
    html,
    body,
    .container {
      height: 100%;
      min-height: 100%;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      border: 5px;
    }

    th,
    td {
      text-align: left;
      padding: 8px;
      border: 1px solid #000000;
    }

    tr {
      background-color: #f2f2f2
    }

    th {
      background-color: blue;
      opacity: 0.8;
      color: white;
    }

    #tableTitle {
      color: whitesmoke;
    }

    #gcpbtn {
      position: absolute;
      right: 0%;
      width: 1.5%;
      height: 3%;
    }

    .box2 {
      /*Third*/
      /*watchlist table*/
      float: right;
      width: 80%;
      height: 80%;
      padding-left: 2%;
      padding-bottom: 3%;
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
      /*Add/Remove box*/
      float: left;
      left: 0%;
      width: 20%;
      height: 70%;
      position: relative;
      padding: 2%;
      /* background-color: green; */
    }

    #addBtn {
      width: 9%;
      height: 15%;
      vertical-align: middle;
      background: url('img/greencheck.png');
      border: none;
      background-repeat: no-repeat;
      background-size: 100% 100%;
    }

    #removeBtn {
      width: 9%;
      height: 15%;
      vertical-align: middle;
      background: url('img/redx.png');
      border: none;
      background-repeat: no-repeat;
      background-size: 100% 100%;
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

    #txt {
      color: whitesmoke;
    }

    body {
      background-image: url('img/stock_back.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
  </style>

  <br></br>

  <form method="post" action="includes/watchlist.inc.php">

    <!--  <label for="watchlistTables">Choose a Watchlist:</label>

    <select name="watchlists" id="watchlists">
      <option value="0">First Watchlist</option>
      <option value="1">Second Watchlist</option>
    </select>
    -->

    <input type="image" src="img/refreshbutton.png" id="gcpbtn" name="updatePostBtn" class="button" />

    <div class=box4>
      <p id="txt" >Add a stock to your watchlist:</p>
      <input style="width:100%;" type="text" id="query" name="query" placeholder="Ticker to add...">
      <p></p>
      <input style="float:right;" type="submit" id="addBtn" name="submit1" value="">
      <input type="submit" id="removeBtn" name="submit2" value="">
    </div>

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
  </div>


  <br></br>
  <br></br>


  <!-- <h1 class="scrollMore">&darr; SCROLL MORE &darr;</h1> -->


  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://dannocket.com/sandbox/IvtpK.js"></script> -->
  <!-- <script src="js/watchlist.js"></script> -->

</main>

<?php
include_once 'footer.php'
?>