<?php
    include_once'header.php';
    include_once 'includes/api.inc.php';
    include_once 'includes/connection.php';
?>

<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Bootstrap Profile Page Design - Bootsnipp.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body{
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
}
.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 70%;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
/* .profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
} */
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}
    </style>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="img/avatar.jpg" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">

                                    <?php
                                    $data = getFromUsers($conn, $_SESSION["UserID"]);
                                    $name = $data["firstname"]." ".$data["lastname"];
                                    echo "<h5>$name</h5>  
                                        <h6>Learning Investor</h6>";
                                    $value = $data["cur_value"];
                                    $cash =   $data["cash"];
                                    echo "<p class='proile-rating'>Current Portfolio Value : <span>$$value</span></p>
                                    <p class='proile-rating'>Current Portfolio Cash: <span>$$cash</span></p>";
                                    ?>
                                    
                                    <!-- <h5>
                                        Kshiti Ghelani
                                    </h5> 
                                    <h6>
                                        Learning Investor
                                    </h6> 
                                    <p class="proile-rating">Current Portfolio Value : <span>8/10</span></p>
                                    <p class="proile-rating">Current Portfolio Cash: <span>8/10</span></p>-->

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Transactions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <!-- <div class="profile-work">
                            <p>WORK LINK</p>
                            <a href="">Website Link</a><br/>
                            <a href="">Bootsnipp Profile</a><br/>
                            <a href="">Bootply Profile</a>
                            <p>SKILLS</p>
                            <a href="">Web Designer</a><br/>
                            <a href="">Web Developer</a><br/>
                            <a href="">WordPress</a><br/>
                            <a href="">WooCommerce</a><br/>
                            <a href="">PHP, .Net</a><br/>
                      </div> -->
                    </div> 
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        
                                <?php
                                    $data = getFromUsers($conn, $_SESSION["UserID"]);
                                    $Fname = $data["firstname"];
                                    $Lname = $data["lastname"];
                                    $email = $data["email"];

                                echo"
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
                                <table border=1 id="stock-portfolio-table" class="table1 bdr1">
                                    <thead>
                                        <tr>
                                            <!-- <th colspan="2" class="header"></th> -->
                                            <th class="txt header">Transaction ID</th>
                                            <th class="txt header">Buy/Sell</th>
                                            <th class="num header">Symbol</th>
                                            <th class="num header">Quantity</th>
                                            <th class="num header">Price</th>
                                            <th class="num header">Total Amount</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $data = getFromTransaction($conn, $_SESSION['UserID']);
                                         
                                        for ($i=0; $i <count($data) ; $i++) {
                                            $TID = $data[$i]["TID"];
                                            $qty = $data[$i]["qty"];
                                            $symbol = $data[$i]["symbol"];
                                            if($data[$i]["amount"] < 0){
                                                $amount = -1*$data[$i]["amount"];

                                            }else{
                                                $amount = $data[$i]["amount"];

                                            }
                                            // $amount = $data[$i]["amount"];
                                            $perstock = round($amount /$qty,2); 
                                            if($data[$i]["transact"]==1){
                                                $transact = 'Sell';
                                            }else{
                                                $transact = 'Buy';
                                            }
                                            echo"<tr>";
                                                echo"<td>$TID</td>";
                                                echo"<td>$transact</td>";
                                                echo"<td > $symbol</td>";
                                                echo"<td >$qty</td>";
                                                echo"<td >$$perstock</td>";
                                                echo"<td >$$amount</td>";
                                                
                                            echo"</tr>";
                                        }
                                    ?>
                                    </tbody>
                                    </table>
                <br></br>


                                <!-- <div class="row">
                                    <div class="col-md-6">
                                        <label>Experience</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Expert</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Hourly Rate</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>10$/hr</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Total Projects</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>230</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>English Level</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Expert</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Availability</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>6 months</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Your Bio</label><br/>
                                        <p>Your detail description</p>
                                </div> -->
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
    include_once'footer.php'
?>