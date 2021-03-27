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


    if ($err ) {
        echo "cURL Error #:" . $err;
        return null;
    } else {
        $parse = json_decode($response);
        
        $return_val = ["symbol" => $parse->quoteResponse->result[0]->symbol,"name" => $parse->quoteResponse->result[0]->longName, "price"=> $parse->quoteResponse->result[0]->regularMarketPrice, "price_change"=> $parse->quoteResponse->result[0]->regularMarketChange, "percent_change"=> $parse->quoteResponse->result[0]->regularMarketChangePercent   ];
        return $return_val;
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


function getFromDatabase($conn, $UID){

    $query = $conn->query("SELECT symbol, name, price, price_change, percent_change FROM watchlist WHERE uid = $UID");
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
        
        // echo "<p>$symbol</p>";
        // echo "<p>$price</p>";
        // echo "<p>$price_change</p>";
        // echo "<p>$percent_change</p>";
        // echo "<p>$UID</p>";

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
    $price = ["price"=>$apiReturn["price"],"total"=>($qty * $price)];
    return $price;
}




?>