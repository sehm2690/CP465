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

        $price = apiCallfn($query);

        if ($price == false){
            header("location: ../portfolioTable.php?error=tickerDNE");
            exit();
        }
        $tableName = 'portfolio';

        $UID = $_SESSION["UserID"];
        $portResult = isSymbolInUser($conn, $tableName, $UID, $price["symbol"]);



        $symbol = $price['symbol'];
        $name =  $price['name'];
        $cur_price = $price['price'];
        $total = $qty*$price['price'];
        $cash = $_SESSION["cash"];

        if($buySell == -1){
            if($cash > $total){ //check if user has enough cash to purchase      
                addtoStock($conn, $price);
                if($portResult == false){// check if they already own thtis stock if they dont then add to their portfolio 
                    addToPortfolio($conn,$UID, $price["symbol"],$qty, $price["price"],  $total , 0, 0.0);

                }else{// update portfolio if the stock alredy exists 
                    $newQty = $qty + $portResult["qty"];
                    $avg_price = (($qty  * $price["price"]) + ($portResult["avg_price"] * $portResult["qty"]))/$newQty;
                    $newTotal_val = $newqty * $price["price"];
                    $todays_change =  $price["price_change"];
                    $total_gain = ($price['price'] - $avg_price) *$newQty;
                    $percent = (($price['price'] - $price['price'])/$avg_price) * 100;

                    updatePortfolio($conn,$UID,$symbol, $newQty, $avg_price, $newTotal_val, $total_gain, $percent);

                }

                $amount = $total  * -1;
                $date = date("Y-m-d H:i:s");  
                addtoTransac($conn, $UID, $buySell, $price["symbol"], $qty, $amount);
                header('location: ../portfolioTable.php'); 


            }else{

                header("location: ../portfolioTable.php?error=notEnoughCash");
                exit();

            }
        }else{

            if($portResult == false){  
                header("location: ../portfolioTable.php?error=dontOwnstock");
                exit();
            }else{
                if ($qty <= $portResult["qty"]){
                    addtoStock($conn, $price);
                    if( $qty-$portResult["qty"]==0){
                        updatePortfolio($conn, $UID, $symbol, 0, 0,0,0,0);

                    }else{
                        $newQty =  $portResult["qty"] - $qty;
                        $avg_price = (($portResult["avg_price"]*$portResult["qty"])-($qty  * $price["price"]))/$newQty;
                        $newTotal_val = $newQty * $price["price"];
                        
                        $todays_change =  $price["price_change"];
                        $total_gain = ($price['price'] - $avg_price) *$newQty;
                        $percent = (($price['price'] - $avg_price )/$avg_price) * 100;

                        updatePortfolio($conn, $UID, $symbol, $newQty, $avg_price, $newTotal_val, $total_gain, $percent);
                    } 

                    $amount = $total ;
                    addtoTransac($conn, $UID, $buySell, $price["symbol"], $qty, $amount);
                   header('location: ../portfolioTable.php'); 
                }else{
                    header("location: ../portfolioTable.php?error=dontOwnEnoughstock");
                    exit();

                }
            }
         
            
        }

    }else {   
        header("location: ../portfolioTable.php?error=unknown");
        exit();
    }


    
?>

 