<?php

    function oneTicker($ticker){
        $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://apidojo-yahoo-finance-v1.p.rapidapi.com/market/v2/get-quotes?region=US&symbols=$ticker",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: apidojo-yahoo-finance-v1.p.rapidapi.com",
            "x-rapidapi-key: 1351fd3e73mshf9c79221e8acff1p127f35jsn6272bcbd7b09"
        ],
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
   

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        if (strlen($response) == 0){
                echo"<script>alert('Stock not found!');</script>";
                // header('location: ../portfolioTable.php');

        }else{
            $parse = json_decode($response);
            // var_dump($parse);
            
            $return_val = ["symbol" => $parse->quoteResponse->result[0]->symbol,"name" => $parse->quoteResponse->result[0]->longName, "price"=> $parse->quoteResponse->result[0]->regularMarketPrice, "price_change"=> $parse->quoteResponse->result[0]->regularMarketChange, "percent_change"=> $parse->quoteResponse->result[0]->regularMarketChangePercent   ];
            return $return_val;
        }
    }

}

function addtoDatabase($conn,$UID,$type,$symbol,$name,$description, $price, $price_change, $percent_change){
    $sql = "INSERT INTO watchlist (UID, type, symbol, name, description, price, price_change, percent_change) VALUES (?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../createacc.php?error=stmtfailed");
        exit();
    }
    //WID	UID	type	symbol	name	description	price	price_change	percent_change
    mysqli_stmt_bind_param($stmt,"ssssssss",$UID,$type,$symbol, $name,$description, $price, $price_change, $percent_change);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    //echo "works";
    //exit();
    return "";
}


function getFromWatchlist($conn, $UID){

    $query = $conn->query("SELECT symbol, name, price, price_change, percent_change FROM watchlist WHERE uid = $UID");
    $tickers = Array();
    while($result = $query->fetch_assoc()){
        $tickers[] = $result;
    }
    return $tickers;
}


function getFromPortfolioTable($conn, $UID){
    $query = $conn->query("SELECT symbol, name, qty, avg_price, current_price, total_val, todays_gain, total_gain, percent FROM portfolio WHERE uid = $UID");

    $tickers = Array();
    while($result = $query->fetch_assoc()){
        $tickers[] = $result;
    }
    return $tickers;
}


function updateDatabase($conn, $UID){
    $query = $conn->query("SELECT symbol FROM watchlist WHERE uid = $UID");
    $tickers = Array();
    while($result = $query->fetch_assoc()){
        $tickers[] = $result['symbol'];
    }
    $apiCall = apiCallfn($tickers);
    
    for ($i=0; $i <count($apiCall) ; $i++) {
        $symbol = $apiCall[$i]['symbol'];
        $price = $apiCall[$i]['price'];
        $price_change = $apiCall[$i]["price_change"];
        $percent_change = $apiCall[$i]["percent_change"];
        

        $sql = "UPDATE watchlist SET price = $price, price_change = $price_change, percent_change = $percent_change WHERE symbol = '$symbol' AND UID = '$UID'";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../watchlist.php?error=stmtfailed");
            exit();
        }
        //mysqli_stmt_bind_param($stmt,"ssssssss",$UID,$type,$symbol, $name,$description, $price, $price_change, $percent_change);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    echo("<meta http-equiv='refresh' content='1'>");
    //header("Refresh:0");
    //error_reporting(0);

    return "";
}

function updateDatabasePortfolio($conn, $UID){
    $query = $conn->query("SELECT symbol FROM portfolio WHERE uid = $UID");
    $tickers = Array();
    while($result = $query->fetch_assoc()){
        $tickers[] = ["avg_price"=>$result["avg_price"],"qty"=>$result['qty'],"symbol"=>$result['symbol']];
    }

    $apiCall = apiCallfn($tickers);
    
    for ($i=0; $i <count($apiCall) ; $i++) {
        $symbol = $apiCall[$i]['symbol'];
        $price = $apiCall[$i]['price'];
        $price_change = $apiCall[$i]["price_change"];
        $total_gain = ($tickers[$i]["avg_price"] - $price) *$tickers[$i]["qty"];
        $percent = (($tickers[$i]["avg_price"] - $price)/$tickers[$i]["avg_price"]) * 100;
        $newTotal_val = $tickers[$i]["qty"]*$price;

        $sql = "UPDATE portfolio SET current_price = $price, total_val = $newTotal_val, todays_gain = $price_change, total_gain = $total_gain, percent = $percent WHERE symbol = '$symbol' AND UID = '$UID'";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../watchlist.php?error=stmtfailed");
            exit();
        }
        //mysqli_stmt_bind_param($stmt,"ssssssss",$UID,$type,$symbol, $name,$description, $price, $price_change, $percent_change);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    echo("<meta http-equiv='refresh' content='1'>");
    //header("Refresh:0");
    //error_reporting(0);

    return "";
}


function apiCallfn($tickers){

    $curl = curl_init();
    $apiCall = "";
    for ($i=0; $i < count($tickers) ; $i++) { 
        $apiCall .= $tickers[$i];

        if ($i!= count($tickers)-1){
            $apiCall .= "%2C";

        }
    }
    
    
     
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://apidojo-yahoo-finance-v1.p.rapidapi.com/market/v2/get-quotes?region=US&symbols=$apiCall",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: apidojo-yahoo-finance-v1.p.rapidapi.com",
            "x-rapidapi-key: 1351fd3e73mshf9c79221e8acff1p127f35jsn6272bcbd7b09"
            // "x-rapidapi-key: 7ffd8f2d08mshe7e8d337ccc22a7p19538cjsn5f66d598fcec"

            
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
        return null;
    } else {
        
        $parse = json_decode($response);
        $returnVar = [];
        for ($i=0; $i < count($tickers) ; $i++) { 
            $returnVar[] = ["symbol"=>$parse->quoteResponse->result[$i]->symbol,"name"=>$parse->quoteResponse->result[$i]->longName, "price"=> $parse->quoteResponse->result[$i]->regularMarketPrice, "price_change"=> $parse->quoteResponse->result[$i]->regularMarketChange, "percent_change"=> $parse->quoteResponse->result[$i]->regularMarketChangePercent];

        }
        
        return $returnVar;

        
    }


}

function calculateCurrentPrice($ticker, $qty){
    $apiReturn = oneTicker($ticker);
    var_dump($apiReturn);
    $price = ["symbol"=> $apiReturn["symbol"],"name"=>$apiReturn["name"],"price"=>$apiReturn["price"],"total"=>($qty * $apiReturn["price"]), "price_change"=>$apiReturn["price_change"]];
    

    return $price;
}



function isInPortfolio($conn, $UID, $symbol){

    $sql = "SELECT * FROM portfolio WHERE UID = ? AND symbol = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../createacc.php?error=stmtfailed");
        exit();

    }
    mysqli_stmt_bind_param($stmt,"ss", $UID, $symbol);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    
    if ( $row = mysqli_fetch_assoc($resultData)){
        return $row;

    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);   
}

function addToPortfolio($conn,$UID,$symbol,$name,$qty, $avg_price, $cur_price, $total, $todays_gain, $total_gain, $percent){
    $sql = "INSERT INTO portfolio (UID, symbol, name, qty, avg_price, current_price, total_val, todays_gain, total_gain, percent) VALUES (?,?,?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../createacc.php?error=stmtfailed1421212121");
        exit();
    }
    //WID	UID	type	symbol	name	description	price	price_change	percent_change
    mysqli_stmt_bind_param($stmt,"ssssssssss", $UID, $symbol, $name, $qty,$avg_price, $cur_price, $total, $todays_gain, $total_gain, $percent);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    //echo "works";
    //exit();
    return "";
}



function updatePortfolio($conn, $avg_price, $newQty, $newTotal_val, $UID, $symbol, $todays_change, $total_gain, $percent){
    if ($newQty == 0){
        $sql = "DELETE FROM portfolio WHERE symbol = '$symbol' AND UID = '$UID';";
    }else{
        $sql = "UPDATE portfolio SET avg_price = $avg_price, qty = $newQty, total_val = $newTotal_val, todays_gain= $todays_change,total_gain = $total_gain,percent = $percent WHERE symbol = '$symbol' AND UID = '$UID';";
    }
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../portfolioTable.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


function addToTransac($conn, $UID, $transact, $symbol, $qty, $amount){
    $sql = "INSERT INTO transactions (UID, transact, symbol, qty, amount) VALUES (?,?,?,?,?);"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../createacc.php?error=stmtfailedinsertIntoTransact");
        exit();
    }
    //WID	UID	type	symbol	name	description	price	price_change	percent_change
    mysqli_stmt_bind_param($stmt,"sssss", $UID, $transact, $symbol, $qty, $amount);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    //echo "works";
    //exit();
    
    $curr_cash = $_SESSION["cash"] + $amount;
    $sql = "UPDATE users SET cash =  $curr_cash WHERE users.UID = '$UID';";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../portfolioTable.php?error=stmtfailedToUpdatingCash");
        exit();
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $_SESSION["cash"] = $curr_cash;
    return "";
}

?>