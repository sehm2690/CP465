<?php
    session_start();
?>
<?php


    if (isset($_POST["submit"])){
        $buySell = $_POST["buySell"]; 
        $query = $_POST["query"];
        $qty = $_POST["quantity"];
        // var_dump($qty);
        // var_dump($buySell);
        require_once "connection.php";
        require_once "api.inc.php";

        
        $price = calculateCurrentPrice($query, $qty);
        
        var_dump($price);
        $UID = $_SESSION["UserID"];
        $portResult =  isInPortfolio($conn, $UID, $price["symbol"]);
        var_dump($portResult);
        $symbol = $price['symbol'];
        $name =  $price['name'];
        $cur_price = $price['price'];
        $total = $price['total'];

        $cash = $_SESSION["cash"];
        if($buySell == -1){
            if($cash > $total){               
                if($portResult == false){  
                    addToPortfolio1($conn,$UID, $price["symbol"],$price["name"],$qty, $price["price"],$price["price"], $price["total"], 0, 0);
                }else{
                    $avg_price =( $qty  * $price["price"]+$portResult["avg_price"]*$portResult["qty"])/($qty+$portResult["qty"]);
                    $newQty = $qty + $portResult["qty"];
                    $newTotal_val = $qty * $price["price"] + $portResult["total_val"];
                    updatePortfolio($conn, $avg_price, $newQty, $newTotal_val, $UID, $symbol);
                }
                
                $amount = $price["total"] * -1;
                
                addtoTransac($conn, $UID, $buySell, $price["symbol"], $qty, $amount);
                //header('location: ../portfolioTable.php');

            }else{
                header('location: ../portfolioTable.php?contenoughcash');

            }
        }else{
            //implement sell

            if($portResult == false){  
                echo "Error can't sell";
                header('location: ../portfolioTable.php?dontOwnthestock');


            }else{
                if ($qty <= $portResult["qty"]){
                    $avg_price =( $portResult["avg_price"]*$portResult["qty"])-($qty  * $price["price"])/($qty+$portResult["qty"]);
                    $newQty =  $portResult["qty"] - $qty;
                    $newTotal_val = $portResult["total_val"] - ($qty * $price["price"]);
                    $percent = 
                    
                    updatePortfolio($conn, $avg_price, $newQty, $newTotal_val, $UID, $symbol);
                    $amount = $price["total"];
                    addtoTransac($conn, $UID, $buySell, $price["symbol"], $qty, $amount);
                    // header('location: ../portfolioTable.php');

                } 

            else{
                header('location: ../portfolioTable.php?Erroruselessqyt');
                }
            }
            
            // $amount = $price["total"];
            // addtoTransac($conn, $UID, $buySell, $price["symbol"], $qty, $amount);
            
        }

    }else {   
        echo "<p> ERROR </p>";
        exit();
    }


    
?>

 