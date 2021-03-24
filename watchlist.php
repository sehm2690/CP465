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
        <option value="blue">First Watchlist</option> 
        <option value="purple">Second Watchlist</option>      
  </select>

  <input type="search" id="query" name="query" placeholder="Search Symbol...">
  <input type="submit" name = "submit" value="Add" >
</form>


<!-- <h1>&darr; SCROLL &darr;</h1> -->
<table class="blue">
  <thead>
    <tr>
      
      <th>Stock Name</th>
      <th>Last Price</th>
      <th>Change</th>
      <th>% Change</th>

    </tr>
  </thead>
  <tbody>
   
<!--     <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>

    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>

    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr> -->
    
  </tbody>
</table>
<?php 
 
  getFromDatabase($conn, $_SESSION['UserID']);

  ?>

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
    include_once'footer.php'
?>