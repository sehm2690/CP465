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
                    addToPortfolio($conn,$UID, $price["symbol"],$price["name"],$qty, $price["price"],$price["price"], $price["total"], $price["price_change"], 0, 0);
                }else{
                    $newQty = $qty + $portResult["qty"];
                    #$avg_price =( $qty  * $price["price"]+$portResult["avg_price"]*$portResult["qty"])/($qty+$portResult["qty"]);
                    $avg_price = (($qty  * $price["price"]) + ($portResult["avg_price"] * $portResult["qty"]))/$newQty;
                    #$newTotal_val = $qty * $price["price"] + $portResult["total_val"];
                    $newTotal_val = $newqty * $price["price"];
                    $todays_change =  $price["price_change"];
                    $total_gain = ($avg_price - $price['price']) *$newQty;
                    $percent = (($avg_price - $price['price'])/$avg_price) * 100;

                    updatePortfolio($conn, $avg_price, $newQty, $newTotal_val, $UID, $symbol, $todays_change, $total_gain, $percent, $price["price"]);
                }
                
                $amount = $price["total"] * -1;
                
                addtoTransac($conn, $UID, $buySell, $price["symbol"], $qty, $amount);
                header('location: ../portfolioTable.php');

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
                    if( $qty-$portResult["qty"]==0){
                        updatePortfolio($conn, 0, 0, 0, $UID, $symbol, 0, 0,0);

                    }else{
                        $newQty =  $portResult["qty"] - $qty;
                        $avg_price = (($portResult["avg_price"]*$portResult["qty"])-($qty  * $price["price"]))/$newQty;
                        $newTotal_val = $newqty * $price["price"];
                        $todays_change =  $price["price_change"];
                        $total_gain = ($avg_price - $price['price']) *$newQty;
                        $percent = (($avg_price - $price['price'])/$avg_price) * 100;
                        
                        updatePortfolio($conn, $avg_price, $newQty, $newTotal_val, $UID, $symbol, $todays_change, $total_gain, $percent, $price["price"]);
                    } 
                
                    $amount = $price["total"];
                    addtoTransac($conn, $UID, $buySell, $price["symbol"], $qty, $amount);
                    header('location: ../portfolioTable.php');

                }else{
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

 