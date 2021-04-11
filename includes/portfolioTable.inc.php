<?php
    session_start();
?>
<?php


    if (isset($_POST["submit"])){
        $buySell = $_POST["buySell"]; 
        $query = $_POST["query"];
        $qty = $_POST["quantity"];
        
        
        require_once "connection.php";
        require_once "api.inc.php";
        
        $price = calculateCurrentPrice($query, $qty);
        $tableName = 'portfolio';
        var_dump($price);
        $UID = $_SESSION["UserID"];
        //$portResult =  isInPortfolio($conn, $UID, $price["symbol"]);
        $portResult = isSymbolInUser($conn, $tableName, $UID, $price["symbol"]);
        echo"<p>result = </p>";
        var_dump($portResult);

        $symbol = $price['symbol'];
        $name =  $price['name'];
        $cur_price = $price['price'];
        $total = $price['total'];

        $cash = $_SESSION["cash"];
        if($buySell == -1){
            if($cash > $total){               
                if($portResult == false){  
                    #addtoStockInfo
//addToPortfolio($conn,$UID,$symbol,$qty, $avg_price, $total, $total_gain, $percent)
                    addToPortfolio($conn,$UID, $price["symbol"],$qty, $price["price"], $price["total"], 0, 0.0);

                }else{
                    $newQty = $qty + $portResult["qty"];
                    #$avg_price =( $qty  * $price["price"]+$portResult["avg_price"]*$portResult["qty"])/($qty+$portResult["qty"]);
                    $avg_price = (($qty  * $price["price"]) + ($portResult["avg_price"] * $portResult["qty"]))/$newQty;
                    #$newTotal_val = $qty * $price["price"] + $portResult["total_val"];
                    $newTotal_val = $newqty * $price["price"];
                    $todays_change =  $price["price_change"];
                    $total_gain = ($price['price'] - $avg_price) *$newQty;
                    $percent = (($price['price'] - $price['price'])/$avg_price) * 100;

                    #updateStockInfro
                                        //updatePortfolio($conn,$UID,$symbol,$newQty, $avg_price, $newTotal_val, $total_gain, $percent)

                    updatePortfolio($conn,$UID,$symbol, $newQty, $avg_price, $newTotal_val, $total_gain, $percent);

                }

                $amount = $price["total"] * -1;
                $date = date("Y-m-d H:i:s");  
                addtoTransac($conn, $UID, $buySell, $price["symbol"], $qty, $amount, $date);
                addtoStock($conn, $price);
                //header('location: ../portfolioTable.php');//  <<<<<<<<<<neeed to uncomment later 


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
                    //updatePortfolio($conn,$UID,$symbol,$newQty, $avg_price, $newTotal_val, $total_gain, $percent)
                        updatePortfolio($conn, $UID, $symbol, 0, 0,0,0,0);

                    }else{
                        $newQty =  $portResult["qty"] - $qty;
                        $avg_price = (($portResult["avg_price"]*$portResult["qty"])-($qty  * $price["price"]))/$newQty;
                        $newTotal_val = $newqty * $price["price"];
                        $todays_change =  $price["price_change"];
                        $total_gain = ($price['price'] - $avg_price) *$newQty;
                        $percent = (($price['price'] - $avg_price )/$avg_price) * 100;
                        //updatePortfolio($conn,$UID,$symbol,$newQty, $avg_price, $newTotal_val, $total_gain, $percent)

                        updatePortfolio($conn, $UID, $symbol, $newQty, $avg_price, $newTotal_val, $total_gain, $percent);
                    } 
                
                    $amount = $price["total"];
                    addtoTransac($conn, $UID, $buySell, $price["symbol"], $qty, $amount);
                    addtoStock($conn, $price);

                //header('location: ../portfolioTable.php');//  <<<<<<<<<<neeed to uncomment later 
               // addtoStock($conn, $price);


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

 