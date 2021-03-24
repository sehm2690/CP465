
<?php
    session_start();
?>
<?php

    if (isset($_POST["submit"])){

        $watchlist = $_POST["watchlists"]; 
        $query = $_POST["query"];
        require_once "connection.php";
        require_once "api.inc.php";
        $toADD = oneTicker($query);
        $UID = $_SESSION["UserID"];
    
        addtoDatabase($conn,$UID,$watchlist,$toADD["symbol"],$toADD["name"], NULL);
        //error handling again
        // if(emptyInputLogin($email,$pwd) != false) {
        //     //header("location: ../login.php?error=emptyinput");
        //     exit();
        // }
        
        // loginUser($conn,$email,$pwd);
        // header("location: ../index.php");
    } else {
        header('location: ../login.php');
        
        echo "<p> ERROR </p>";
        exit();
    }
    
?>
