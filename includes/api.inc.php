<?php


function getTop12($conn){
    $query = $conn->query("SELECT sd.symbol, sd.ask, sd.current_price, sd.percent_change, sd.todays_gain, sd.bid, si.name, si.marketCap FROM stockdaily sd INNER JOIN stockinfo si on sd.symbol = si.symbol ORDER BY si.marketCap DESC LIMIT 15");
    $tickers = Array();
    while($result = $query->fetch_assoc()){
        $tickers[] = $result;
    }
    return $tickers;
}

function addtoStock($conn, $info){
    
    $tableName = "stockinfo";
    $isinstock = isSymbolinStock($conn, $tableName, $info['symbol']);
   
    if ($isinstock == false){    
        $sql = "INSERT INTO stockdaily (ask, beta, bid, current_price, percent_change, regularMarketVolume, shortPercentFloat, symbol, todays_gain) VALUES (?,?,?,?,?,?,?,?,?);";
       
        $stmt = mysqli_stmt_init($conn);
       
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../createacc.php?error=stmtfailed1");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt,"sssssssss",$info['ask'],$info['beta'],$info['bid'],$info['current_price'],$info['percent_change'],$info['regularMarketVolume'],$info['shortPercentFloat'],$info['symbol'],$info['price_change']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $sql = "INSERT INTO stockinfo (bookValue, dividendsPerShare, forwardPE, marketCap, name, pegRatio, priceToSales, revenue, sharesOutstanding, symbol, trailingPE) VALUES (?,?,?,?,?,?,?,?,?,?,?);";

        $stmt = mysqli_stmt_init($conn);

            
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../createacc.php?error=stmtfailed2");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"sssssssssss", $info['bookValue'],$info['dividendsPerShare'],$info['forwardPE'],$info['marketCap'],$info['name'],$info['pegRatio'],$info['priceToSales'],$info['revenue'],$info['sharesOutstanding'],$info['symbol'],$info['trailingPE']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    
    } else {

        $sql = "UPDATE stockdaily SET ask = ?, beta = ?, bid = ?, current_price = ?, percent_change = ?, regularMarketVolume = ?, shortPercentFloat = ?, todays_gain = ? WHERE symbol = ?;";

      
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../createacc.php?error=stmtfailed3");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"sssssssss",$info['ask'],$info['beta'],$info['bid'],$info['current_price'],$info['percent_change'],$info['regularMarketVolume'],$info['shortPercentFloat'],$info['price_change'], $info['symbol']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $sql = "UPDATE stockinfo SET name = ?, bookValue = ?, dividendsPerShare = ?, forwardPE = ?, marketCap = ?, pegRatio = ?, priceToSales = ?, revenue = ?, sharesOutstanding = ?, trailingPE = ? WHERE symbol = ?;";

        $stmt = mysqli_stmt_init($conn);

            
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../createacc.php?error=stmtfailed4");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"sssssssssss", $info['name'],$info['bookValue'],$info['dividendsPerShare'],$info['forwardPE'],$info['marketCap'],$info['pegRatio'],$info['priceToSales'],$info['revenue'],$info['sharesOutstanding'],$info['trailingPE'],$info['symbol']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
    }
    return;
}




function addtoWatchlist($conn, $UID, $type, $symbol){
    $sql = "INSERT INTO watchlist (UID, type, symbol) VALUES (?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../createacc.php?error=stmtfailed5");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"sss", $UID, $type, $symbol);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return "";
}


function deleteFromWatchlist($conn, $UID, $symbol){
    $sql = "DELETE FROM watchlist WHERE symbol = '$symbol' AND UID = '$UID';";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../portfolioTable.php?error=stmtfailed6");
        exit();
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


function getFromWatchlist($conn, $UID){
    $query = $conn->query("SELECT w.UID, w.symbol, si.name, sd.current_price, sd.percent_change, sd.todays_gain FROM watchlist w INNER JOIN stockdaily sd on sd.symbol = w.symbol INNER JOIN stockinfo si on si.symbol = sd.symbol HAVING w.UID = $UID");

    $tickers = Array();
    while($result = $query->fetch_assoc()){
        $tickers[] = $result;
    }

    return $tickers;
}


function getFromPortfolioTable($conn, $UID){
    $query = $conn->query("SELECT p.UID, p.qty, p.avg_price, p.total_val, p.total_gain, p.percent, p.symbol, si.name, sd.current_price, sd.percent_change, sd.todays_gain FROM portfolio p INNER JOIN stockdaily sd on sd.symbol = p.symbol INNER JOIN stockinfo si on si.symbol = sd.symbol HAVING p.UID = $UID;");
    $tickers = Array();

    while($result = $query->fetch_assoc()){
        $tickers[] = $result;
    }    return $tickers;
}


function isSymbolinStock($conn, $tableName, $symbol){

    $sql = "SELECT * FROM $tableName WHERE symbol = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../createacc.php?error=stmtfailed7");
        exit();

    }
    mysqli_stmt_bind_param($stmt,"s", $symbol);
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

function isSymbolInUser($conn, $tableName, $UID, $symbol){

    $sql = "SELECT * FROM $tableName WHERE UID = ? AND symbol = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../createacc.php?error=stmtfailed8");
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


function updateDatabase($conn, $UID){
    $query = $conn->query("SELECT symbol FROM stockdaily");
    $tickers = Array();
    while($result = $query->fetch_assoc()){
        $tickers[] = $result['symbol'];
    }
    
    $apiCall = apiCallfn($tickers);
    
    for ($i=0; $i <count($apiCall) ; $i++) {

        addtoStock($conn, $apiCall[$i]);
        
    }
    echo("<meta http-equiv='refresh' content='1'>"); 
  

    return "";
}

function updatePortfolio1($conn, $UID, $cash){
    $query = $conn->query("SELECT symbol FROM stockdaily");
    $tickers = Array();
    while($result = $query->fetch_assoc()){
        $tickers[] = $result['symbol'];
    }
    
    $apiCall = apiCallfn($tickers);
    
    for ($i=0; $i <count($apiCall) ; $i++) {

        addtoStock($conn, $apiCall[$i]);
        
    }

    $query = $conn->query("SELECT p.UID, p.symbol,p.qty, p.avg_price, sd.current_price, sd.percent_change, sd.todays_gain FROM portfolio p INNER JOIN stockdaily sd on sd.symbol = p.symbol HAVING p.UID = $UID");
    if($query == false){
        echo("<meta http-equiv='refresh' content='1'>"); 
        //echo"FALSE";

        exit();
    }
    
    $tickers = Array();


    while($result = $query->fetch_assoc()){
        $tickers[] = $result;
    }

    var_dump($tickers);

    for ($i=0; $i <count($tickers) ; $i++) {
        $symbol = $tickers[$i]['symbol'];
        $price = $tickers[$i]['price'];
        $price_change = $tickers[$i]["price_change"];
        $total_gain = ($price - $tickers[$i]["avg_price"]) *$tickers[$i]["qty"];
        $percent = (($price- $tickers[$i]["avg_price"])/$tickers[$i]["avg_price"]) * 100;
        $newTotal_val = $tickers[$i]["qty"]*$price;
        $SUMtotal_val +=$newTotal_val;

        $sql = "UPDATE portfolio SET total_val = $newTotal_val, total_gain = $total_gain, percent = $percent WHERE symbol = '$symbol' AND UID = '$UID'";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../watchlist.php?error=stmtfailed9");
            exit();
        }
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    $value = $cash+ $SUMtotal_val;

    $sql = "UPDATE users SET cur_value = $value WHERE UID = $UID";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../portfolioTable.php?error=stmtfailed10");
        exit();
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    
   echo("<meta http-equiv='refresh' content='1'>"); 
    
}

function updateDatabasePortfolio($conn, $UID, $cash){
    $query = $conn->query("SELECT * FROM portfolio WHERE uid = $UID");
    $tickers = Array();
    $ticker =  Array();
        if($query == false){
        echo("<meta http-equiv='refresh' content='1'>"); 

        exit();
    }
    while($result = $query->fetch_assoc()){
        $tickers[] = ["avg_price"=>$result["avg_price"],"qty"=>$result['qty'],"symbol"=>$result['symbol']];
        $ticker[] =$result['symbol'];
    }
    if(!isset($ticker[0])){

        echo("<meta http-equiv='refresh' content='1'>");

        exit();
    }
    $apiCall = apiCallfn($ticker);
    $SUMtotal_val = 0;
    for ($i=0; $i <count($apiCall) ; $i++) {
        addtoStock($conn, $apiCall[$i]);
  
        $symbol = $apiCall[$i]['symbol'];
        $price = $apiCall[$i]['price'];
        $price_change = $apiCall[$i]["price_change"];
        $total_gain = ($price - $tickers[$i]["avg_price"]) *$tickers[$i]["qty"];
        $percent = (($price- $tickers[$i]["avg_price"])/$tickers[$i]["avg_price"]) * 100;
        $newTotal_val = $tickers[$i]["qty"]*$price;
        $SUMtotal_val +=$newTotal_val;

        $sql = "UPDATE portfolio SET total_val = $newTotal_val, total_gain = $total_gain, percent = $percent WHERE symbol = '$symbol' AND UID = '$UID'";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../watchlist.php?error=stmtfailed9");
            exit();
        }
        
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    $value = $cash+ $SUMtotal_val;

    $sql = "UPDATE users SET cur_value = $value WHERE UID = $UID";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../portfolioTable.php?error=stmtfailed10");
        exit();
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    
    echo("<meta http-equiv='refresh' content='1'>");
    
    return "";
}

function getFromTransaction($conn ,$UID){

    $query = $conn->query("SELECT * FROM transactions WHERE uid = $UID");
    $tickers = Array();
    while($result = $query->fetch_assoc()){
        $tickers[] = ["TID"=>$result["TID"],"qty"=>$result['qty'],"symbol"=>$result['symbol'],"amount"=>$result['amount'],'transact'=>$result['transact']];
    }
    return $tickers;

}

function getFromUsers($conn ,$UID){

    $query = $conn->query("SELECT * FROM users where UID = $UID");

    $value = $query->fetch_assoc();

    return $value;
}

function apiCallfn($tickers){
    if(gettype($tickers)!="string"){
        
        $apiCall = "";
        for ($i=0; $i < count($tickers) ; $i++) { 
            $apiCall .= $tickers[$i];

            if ($i!= count($tickers)-1){
                $apiCall .= "%2C";

            }
        }

    }else{
        $apiCall = $tickers;
    }
    $curl = curl_init();
     
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
            //"x-rapidapi-key: 1351fd3e73mshf9c79221e8acff1p127f35jsn6272bcbd7b09"
             "x-rapidapi-key: 7ffd8f2d08mshe7e8d337ccc22a7p19538cjsn5f66d598fcec"

            
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
        if(gettype($tickers)!="string"){

            $maxI = count($tickers);
        }else{
            $maxI = 1;
        }

        for ($i=0; $i < $maxI  ; $i++) { 
            
            $return_val[] = [];
            
            if(isset($parse->quoteResponse->result[$i]->symbol)){
                $return_val[$i] ["symbol"] = $parse->quoteResponse->result[$i]->symbol;
            }

            else{
                $return_val[$i] ["symbol"] = 0;
            }
        
            if(isset($parse->quoteResponse->result[$i]->longName)){
                $return_val[$i]["name"] = $parse->quoteResponse->result[$i]->longName;

            }
            else{
                $return_val[$i] ["name"] = 0;
            }

            if(isset($parse->quoteResponse->result[$i]->regularMarketPrice)){
                $return_val[$i] ["price"] = $parse->quoteResponse->result[$i]->regularMarketPrice;

            }
            else{
                $return_val[$i] ["price"]  = 0;
            }
        

            if(isset($parse->quoteResponse->result[$i]->regularMarketChange)){
                $return_val[$i] ["price_change"] = $parse->quoteResponse->result[$i]->regularMarketChange;
            }
            else{
                $return_val[$i] ["price_change"]  = 0;
            }
        
            if(isset($parse->quoteResponse->result[$i]->regularMarketChangePercent)){
                $return_val[$i]["percent_change"] = $parse->quoteResponse->result[$i]->regularMarketChangePercent;
                
            }
            else{
                $return_val[$i]["percent_change"]  = 0;
            }
        

            if(isset($parse->quoteResponse->result[$i]->dividendsPerShare)){
                $return_val[$i] ["dividendsPerShare"] = $parse->quoteResponse->result[$i]->dividendsPerShare;
            }
            else{
                $return_val[$i] ["dividendsPerShare"]  = 0;
            }
        

            if(isset($parse->quoteResponse->result[$i]->forwardPE)){
                $return_val[$i] ["forwardPE"]  = $parse->quoteResponse->result[$i]->forwardPE;
            }
            else{
                $return_val[$i] ["forwardPE"]  = 0;
            }
        
            if(isset($parse->quoteResponse->result[$i]->marketCap)){
                $return_val[$i] ["marketCap"]  = $parse->quoteResponse->result[$i]->marketCap;
            }
            else{
                $return_val[$i] ["marketCap"]  = 0;
            }
        
            if(isset($parse->quoteResponse->result[$i]->pegRatio)){
                $return_val[$i] ["pegRatio"]  = $parse->quoteResponse->result[$i]->pegRatio;
            }
            else{
                $return_val[$i] ["pegRatio"]  = 0;
            }

            if(isset($parse->quoteResponse->result[$i]->priceToSales)){
                $return_val[$i] ["priceToSales"] = $parse->quoteResponse->result[$i]->priceToSales;
            }
            else{
                $return_val[$i] ["priceToSales"]  = 0;
            }
        
            if(isset($parse->quoteResponse->result[$i]->revenue)){
                $return_val[$i] ["revenue"] = $parse->quoteResponse->result[$i]->revenue;

            }
            else{
                $return_val[$i] ["revenue"]  = 0;
            }
        
            if(isset($parse->quoteResponse->result[$i]->sharesOutstanding)){
                $return_val[$i] ["sharesOutstanding"] = $parse->quoteResponse->result[$i]->sharesOutstanding;

            }
            else{
                $return_val[$i] ["sharesOutstanding"]  = 0;
            }
        


            if(isset($parse->quoteResponse->result[$i]->trailingPE)){
                $return_val[$i] ["trailingPE"] = $parse->quoteResponse->result[$i]->trailingPE;

            }
            else{
                $return_val[$i] ["trailingPE"]  = 0;
            }
        
            if(isset($parse->quoteResponse->result[$i]->bookValue)){
                $return_val[$i]  ["bookValue"] = $parse->quoteResponse->result[$i]->bookValue;
            }
            else{
                $return_val[$i] ["bookValue"]  = 0;
            }
        
            if(isset($parse->quoteResponse->result[$i]->ask)){
                $return_val[$i] ["ask"] = $parse->quoteResponse->result[$i]->ask;
            }
            else{
                $return_val[$i] ["ask"]  = 0;
            }
        

            if(isset( $parse->quoteResponse->result[$i]->beta)){
                $return_val[$i] ["beta"] = $parse->quoteResponse->result[$i]->beta;
            }

            else{
                $return_val[$i] ["beta"]  = 0;
            }
        
        

        
            if(isset($parse->quoteResponse->result[$i]->bid)){
                $return_val[$i] ["bid"] = $parse->quoteResponse->result[$i]->bid;
            }
            else{
                $return_val[$i] ["bid"]  = 0;
            }
        

            if(isset($parse->quoteResponse->result[$i]->regularMarketPrice)){
                $return_val[$i]  ["current_price" ]= $parse->quoteResponse->result[$i]->regularMarketPrice;

            }
            else{
                $return_val[$i] ["current_price"]  = 0;
            }
            
            if(isset($parse->quoteResponse->result[$i]->regularMarketVolume)){
                $return_val[$i] ["regularMarketVolume"] =$parse->quoteResponse->result[$i]->regularMarketVolume;
            }
            else{
                $return_val[$i] ["regularMarketVolume"]  = 0;
            }
        

            if(isset($parse->quoteResponse->result[$i]->shortPercentFloat)){
                $return_val[$i] ["shortPercentFloat"] =$parse->quoteResponse->result[$i]->shortPercentFloat;
            }
            else{
                $return_val[$i] ["shortPercentFloat"]  = 0;
            }
            
        }
        if(gettype($tickers)!="string"){

            return $return_val;
        }
        else{
            if ($return_val[0]["name"]===0){
                //throw new Exception('This ticker does not exist');
                return false;
            }else {
                return $return_val[0];
                
            }
        }
        
    }



}




 
function isInPortfolio($conn, $UID, $symbol){

    $sql = "SELECT * FROM portfolio WHERE UID = ? AND symbol = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../createacc.php?error=stmtfailed11");
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


function addToPortfolio($conn,$UID,$symbol,$qty, $avg_price, $total, $total_gain, $percent){
    $sql = "INSERT INTO portfolio (UID, symbol, qty, avg_price, total_val, total_gain, percent) VALUES (?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
 
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../createacc.php?error=stmtfailed1421212121");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"sssssss",$UID,$symbol,$qty,$avg_price, $total, $total_gain, $percent);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return "";
}


function updatePortfolio($conn,$UID,$symbol,$newQty, $avg_price, $newTotal_val, $total_gain, $percent){
    if ($newQty == 0){
        $sql = "DELETE FROM portfolio WHERE symbol = '$symbol' AND UID = '$UID';";
    }else{
        $sql = "UPDATE portfolio SET avg_price = $avg_price, qty = $newQty, total_val = $newTotal_val, total_gain = $total_gain,percent = $percent WHERE symbol = '$symbol' AND UID = '$UID';";
    }
    
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../portfolioTable.php?error=stmtfailed12");
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