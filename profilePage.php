<?php
include_once 'header.php';
include_once 'includes/api.inc.php';
include_once 'includes/connection.php';
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="htp://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/profilePage.css">

    <style type="text/css">
        body {
            background-image: url('img/stock_back.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>

</head>

<body>
    <div class="container emp-profile">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="img/profilepic2.png" alt="" />
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">

                        <?php
                        $data = getFromUsers($conn, $_SESSION["UserID"]);
                        $name = $data["firstname"] . " " . $data["lastname"];
                        echo "<h5>$name</h5>  
                                        <h6>Learning Investor</h6>";
                        $value = $data["cur_value"];
                        $valueFormatted = number_format($value, 2);
                        $cash =   $data["cash"];
                        $cashFormatted = number_format($cash, 2);
                        echo "<div style='clear: both'>
                            <p class='proile-rating' style='float:left' >Current Portfolio Value: </p>
                            <p class='proile-rating' style='float:right' ><span>$$valueFormatted</span></p>
                            </div>
                            <div style='clear: both'>
                            <p class='proile-rating' style='float:left' >Current Portfolio Cash: </p>
                            <p class='proile-rating' style='float:right' ><span>$$cashFormatted</span></p>
                            </div>";
                        ?>

                        <br></br>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a style='float:bottom;' class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Transactions</a>
                            </li>
                        </ul>
                    </div>
                </div>
         
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <?php
                            $data = getFromUsers($conn, $_SESSION["UserID"]);
                            $Fname = $data["firstname"];
                            $Lname = $data["lastname"];
                            $email = $data["email"];

                            echo "
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <label>First Name</label>
                                    </div>
                                    <div class='col-md-6'>
                                        <p>$Fname</p>
                                    </div>
                                </div>
                            
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <label>Last Name</label>
                                    </div>
                                    <div class='col-md-6'>
                                        <p>$Lname</p>
                                    </div>
                                </div>
                        
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <label>Email</label>
                                    </div>
                                    <div class='col-md-6'>
                                        <p>$email</p>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <label>Phone</label>
                                    </div>
                                    <div class='col-md-6'>
                                        <p>123 456 7890</p>
                                    </div>
                                </div>";
                            ?>

                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <table id="stock-portfolio-table" class="table1 bdr1">
                                <thead>
                                    <tr>
                                        
                                        <th class="txt_header">Buy/Sell</th>
                                        <th class="num_header">Symbol</th>
                                        <th class="num_header">Quantity</th>
                                        <th class="num_header">Price</th>
                                        <th class="num_header">Total Amount</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $data = getFromTransaction($conn, $_SESSION['UserID']);

                                    for ($i = 0; $i < count($data); $i++) {
                                        $qty = $data[$i]["qty"];
                                        $symbol = $data[$i]["symbol"];
                                        if ($data[$i]["amount"] < 0) {
                                            $amount = -1 * $data[$i]["amount"];
                                        } else {
                                            $amount = $data[$i]["amount"];
                                        }
                                        $perstock = round($amount / $qty, 2);
                                        if ($data[$i]["transact"] == 1) {
                                            $transact = 'Sell';
                                        } else {
                                            $transact = 'Buy';
                                        }
                                        echo "<tr>";
                                        echo "<td>$transact</td>";
                                        echo "<td > $symbol</td>";
                                        echo "<td >$qty</td>";
                                        echo "<td >$$perstock</td>";
                                        echo "<td >$$amount</td>";

                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <br></br>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>
    <script type="text/javascript">

    </script>
</body>




<?php
include_once 'footer.php'
?>