<?php
    session_start();
?>
<?php


    if (isset($_POST["submit"])){
        $buySell = $_POST["buySell"]; 
        $query = $_POST["query"];
        $qty = $_POST["quantity"];
        var_dump($qty);
        require_once "connection.php";
        require_once "api.inc.php";

        

        $price = calculateCurrentPrice($query, $qty);
      
        $UID = $_SESSION["UserID"];
    
        addToPortfolio($conn,$UID,$watchlist,$toADD["symbol"],$toADD["name"], NULL,$toADD["price"],$toADD["price_change"], $toADD["percent_change"]);

        echo"<p>IN the IF </p>";
        //header('location: ../portfolioTable.php');

        //error handling again
        // if(emptyInputLogin($email,$pwd) != false) {
        //     //header("location: ../login.php?error=emptyinput");
        //     exit();
        // }
        
        // loginUser($conn,$email,$pwd);
        // header("location: ../index.php");
    } else {
        //header('location: ../watchlist.php');
        
        echo "<p> ERROR </p>";
        //exit();
    }
    //header('Location: ../index.php');


    
?>

