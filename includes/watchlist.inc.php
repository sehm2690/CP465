
<?php
    session_start();
?>
<?php
     $watchlist = $_POST["watchlists"]; 
     $query = $_POST["query"];
     require_once "connection.php";
     require_once "api.inc.php";
     $UID = $_SESSION["UserID"];
    if (isset($_POST["submit1"])){
        if (isInWatchlist($conn, $UID, $query) == true){
            echo "<script type='text/javascript'>alert('Already in watchlist');</script>";
        }
        else{
            $toADD = oneTicker($query);
            addtoDatabase($conn,$UID,$watchlist,$toADD["symbol"],$toADD["name"], NULL,$toADD["price"],$toADD["price_change"], $toADD["percent_change"]);
        }

        echo"<p>IN the IF </p>";
        header('location: ../watchlist.php');
        
        //error handling again
        // if(emptyInputLogin($email,$pwd) != false) {
        //     //header("location: ../login.php?error=emptyinput");
        //     exit();
        // }
        
        // loginUser($conn,$email,$pwd);
        // header("location: ../index.php");
    } 

    
    elseif(isset($_POST["submit2"])){
        if (isInWatchlist($conn, $UID, $query) == true){
            deleteFromWatchlist($conn, $UID, $query);
        }
        else{
            echo "<script type='text/javascript'>alert('Not in watchlist');</script>";
        }

        echo"<p>IN the IF </p>";
        header('location: ../watchlist.php');
    }
    
    else {
        header('location: ../watchlist.php');
        
        echo "<p> ERROR </p>";
        exit();
    }
    //header('Location: ../index.php');
    exit();


    
?>
