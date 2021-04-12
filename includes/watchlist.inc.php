
<?php
    session_start();
?>
<?php
    require_once "connection.php";
    require_once "api.inc.php";
    
    $tableName = "watchlist";
    $watchlist = $_POST["watchlists"]; 
    $query = $_POST["query"];
    $UID = $_SESSION["UserID"];
    if (isset($_POST["submit1"])){
        if (isSymbolInUser($conn, $tableName, $UID, $query )== true){
            header("location: ../watchlist.php?error=AlreadyInWatchlist");
            exit();
        }
        else{
            $toADD = apiCallfn($query);
            if ($toADD == false){
                header("location: ../watchlist.php?error=tickerDNE");
                exit();
            }
            addtoWatchlist($conn,$UID,$watchlist,$toADD["symbol"]);
            addtoStock($conn, $toADD);
        
        }

        header('location: ../watchlist.php');
        exit();

        
        
    } 

    
    elseif(isset($_POST["submit2"])){
        
        if (isSymbolInUser($conn, $tableName, $UID, $query ) == true){
            deleteFromWatchlist($conn, $UID, $query);
        }
        else{
            header("location: ../watchlist.php?error=NotInWatchlist");
            exit();
        }

        header('location: ../watchlist.php');
        exit();

    }else {
        header('location: ../watchlist.php?error=unknown');
                exit();
    }

    header('location: ../watchlist.php');

    exit();
    
?>
