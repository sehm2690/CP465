
<?php
include_once'header.php'
?>
<main >
    <style>
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


<h2>My Portfolio <i class="icon-minus"></i></h2>
<table class="numbers table2">
  <thead>
  <tr class="header">
    <th class="txt header">Symbol</th>
    <th class="txt header">Description</th>
    <th class="num header">Qty</th>
    <th class="num header">Purchase Price</th>
    <th class="num header">Current Price</th>
    <th class="num header">Total Value</th>
    <th class="num header">Today's Change</th>
    <th class="num header">Total Gain/Loss</th>
    <th class="num header">Percent % </th>

  </tr>
  </thead>
  <tbody>
<?php
    $row1 = array("MPC","MARATHON PETROLEUM CORP", 10,17.99,58.13, 581.80, 22.60, 401.90,20);
    $row2 = array("FSR", "FISKER INC", 20, 11.75, 24.44, 235.80, 20.04,209.08, 60);
    $row3 = array('AAPL', 'APPLE INC', 12, 59.09, 119.98, 1439.76, 60.50 ,730.68, 70);
    $rows = array($row1,$row2,$row3);
    $i = 0;
    $total_rows = 3; 
    while ($i < $total_rows){
        echo "<tr>";
        
        echo "<td>". $rows[$i][0] ."</td>" ;
        echo "<td>". $rows[$i][1] ."</td>" ;
        echo '<td class="num">'. $rows[$i][2] ."</td>" ;
        echo '<td class="num">'. $rows[$i][3] ."</td>" ;
        echo '<td class="num">'. $rows[$i][4] ."</td>" ;
        echo '<td class="num">'. $rows[$i][5] ."</td>" ;
        echo '<td class="num">'. $rows[$i][6] ."</td>" ;
        echo '<td class="num">'. $rows[$i][7] ."</td>" ;
        echo '<td class="percent">'. $rows[$i][8] ."</td>" ;
    

        echo"</tr>";
        
        $i++;

    }
?>

</tbody>
  <tfoot>
  <tr class="summary">
    <td>Summary</td>
    <td class="number">225,924 </td>
    <td class="money">$14,993.35</td>
    <td class="money">$0.74</td>
    <td class="money">$0.00</td>
    <td class="money">$14,992.61</td>
    <td class="percent">100%</td>
  </tr>
  </tfoot>
</table>


<!--   <tr class="good">
    <td><a href="#">Publisher 1</a></td>
    <td class="number">213,450</td>
    <td class="money">$13,923.55</td>
    <td class="money"></td>
    <td class="money">$0.00</td>
    <td class="money">$13,923.55</td>
    <td class="percent">100% <i class="icon-up-bold"></i></td>
  </tr>
  <tr class="good">
    <td><a href="#">Publisher 2</a></td>
    <td class="number">1,020</td>
    <td class="money">$202.35</td>
    <td class="money"></td>
    <td class="money">$0.00</td>
    <td class="money">$202.35</td>
    <td class="percent">100% <i class="icon-arrow-combo"></i></td>
  </tr>
  <tr class="good">
    <td><a href="#">Publisher 3</a></td>
    <td class="number">11,450</td>
    <td class="money">$831.07</td>
    <td class="money">$0.74</td>
    <td class="money">$0.00</td>
    <td class="money">$830.33</td>
    <td class="percent">99.9% <i class="icon-up-bold"></i></td>
  </tr>
  <tr class="good">
    <td><a href="#">Publisher 4</a></td>
    <td class="number">4</td>
    <td class="money">$36.38</td>
    <td class="money"></td>
    <td class="money">$0.00</td>
    <td class="money">$36.38</td>
    <td class="percent">100% <i class="icon-up-bold"></i></td>
  </tr>
  </tbody>
  <tfoot>
  <tr class="summary">
    <td>Summary</td>
    <td class="number">225,924 </td>
    <td class="money">$14,993.35</td>
    <td class="money">$0.74</td>
    <td class="money">$0.00</td>
    <td class="money">$14,992.61</td>
    <td class="percent">100%</td>
  </tr>
  </tfoot>
</table>

<h2>EXE Publisher <i class="icon-minus"></i></h2>
<table class="numbers table3">
  <thead>
  <tr class="header">
    <th class="name">Name</th><th>DAU Stats</th><th>Revenue</th><th>Spent</th><th>Expenses</th><th>Final Profit</th><th>Margin</th>
  </tr>
  </thead>
  <tbody>
  <tr class="awful">
    <td><a href="#">Publisher 10</a></td>
    <td class="number">48,444</td>
    <td class="money">$613.35</td>
    <td class="money">$670.80</td>
    <td class="money">$41.35</td>
    <td class="money">($98.80)</td>
    <td class="percent">-16.1% <i class="icon-down-bold"></i></td>
  </tr>
  <tr class="awful">
    <td><a href="#">Publisher 11</a></td>
    <td class="number">8842</td>
    <td class="money">$7.23</td>
    <td class="money">$2.13</td>
    <td class="money">$7.55</td>
    <td class="money">($2.44)</td>
    <td class="percent">-33.8% <i class="icon-arrow-combo"></i></td>
  </tr>
  <tr class="good">
    <td><a href="#">Publisher 12</a></td>
    <td class="number">122444</td>
    <td class="money">$642.87</td>
    <td class="money">$82.45</td>
    <td class="money">$104.51</td>
    <td class="money">$445.91</td>
    <td class="percent">70.9% <i class="icon-up-bold"></i></td>
  </tr>
  <tr class="good">
    <td><a href="#">Publisher 13</a></td>
    <td class="number">8778</td>
    <td class="money">$185.89</td>
    <td class="money">$0.12</td>
    <td class="money">$7.49</td>
    <td class="money">$178.28</td>
    <td class="percent">95.9% <i class="icon-up-bold"></i></td>
  </tr>
  
  <tr class="good publisher14">
    <td><a href="#">Publisher 14</a></td>
    <td class="number">596</td>
    <td class="money">$5.63</td>
    <td class="money">$0.25</td>
    <td class="money">$0.51</td>
    <td class="money">$4.87</td>
    <td class="percent">86.5% <i class="icon-down-bold"></i></td>
  </tr>
  <tr class="row-details">
    <td colspan="7">
      <img src="http://www.jqplot.com/images/linestyles2.jpg" />
      <img src="http://www.jqplot.com/images/barchart.jpg" />
      <img src="http://www.jqplot.com/images/shadow2.jpg" />
      <img src="http://www.jqplot.com/images/linestyles2.jpg" />
      <img src="http://www.jqplot.com/images/barchart.jpg" />
      <img src="http://www.jqplot.com/images/shadow2.jpg" />
    </td>
  </tr>
  <tr class="marginal">
    <td><a href="#">Publisher 15</a></td>
    <td class="number">9153</td>
    <td class="money">$9.64</td>
    <td class="money">$0.09</td>
    <td class="money">$7.81</td>
    <td class="money">$1.73</td>
    <td class="percent">18.0% <i class="icon-up-bold"></i></td>
  </tr>
  </tbody>
  <tfoot>
  <tr class="summary">
    <td>Summary</td>
    <td class="number">154,657</td>
    <td class="money">$1,464.61</td>
    <td class="money">$755.84</td>
    <td class="money">$169.22</td>
    <td class="money">$538.55</td>
    <td class="percent">36.9%</td>
  </tr>
  </tfoot>
</table> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://dannocket.com/sandbox/IvtpK.js"></script>
<script src="js/portfolioTable.js"></script>
<script src="js/parseJson.js"></script>
  </main>
<?php
    include_once'footer.php'
?>