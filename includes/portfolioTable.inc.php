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
        $portResult =  isInPortfolio($conn, $UID, $price["symbol"]);
                    
        if($portResult == false){  
                  
        $symbol = $price['symbol'];
        $name =  $price['name'];
        $cur_price = $price['price'];
        $total = $price['total'];
        
        $sql = "INSERT INTO portfolio (UID, symbol, name, qty, avg_price, current_price, total_val, todays_gain,total_gain) 
                    VALUES ($UID, $symbol, $name, $qty, $cur_price,$cur_price, $total, 0, 0);";

        updatePortfolio($conn, sql);
        // addToPortfolio($conn,$UID,$buySell,$price["symbol"],$price["name"],$qty, $price["price"],$price["price"], $price["total"]);

        }else{

            $avg_price =( $qty * $price["price"]+$portResult["avg_price"]*$portResult["qty"])/($qty+$portResult["qty"]);
            $newQty = $qty + $portResult["qty"];
            $newTotal_val = $qty * $price["price"] + $portResult["total_val"];
            $sql = "
            UPDATE portfolio 
            SET avg_price = $avg_price
            SET qty = $newQty,
            SET total_val = $newTotal_val
            WHERE
            UID = $UID AND
            symbol = $symbol
            ";
            updatePortfolio($conn, sql);
        }
        addtoTransac($conn, $UID, $buySell, $price["symbol"], $qty,$price["total"] );

    }










        //header('location: ../portfolioTable.php');

        //error handling again
        // if(emptyInputLogin($email,$pwd) != false) {
        //     //header("location: ../login.php?error=emptyinput");
        //     exit();
        // }
        
        // loginUser($conn,$email,$pwd);
        // header("location: ../index.php");
     else {
        //header('location: ../watchlist.php');
        
        echo "<p> ERROR </p>";
        //exit();
    }
    //header('Location: ../index.php');


    
?>

