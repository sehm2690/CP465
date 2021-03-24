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
        return null;
    } else {
        $parse = json_decode($response);

        $return_val = ["symbol" => $parse->quoteResponse->result[0]->symbol,"name" => $parse->quoteResponse->result[0]->longName];
        return $return_val;
    }


}

function addtoDatabase($conn,$UID,$type,$symbol,$name,$description){
    $sql = "INSERT INTO watchlist (UID, type, symbol, name, description) VALUES (?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../createacc.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"sssss",$UID,$type,$symbol,$name,$description);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo "works";
    exit();

}

function getFromDatabase($conn, $UID){

    $query = $conn->query("SELECT symbol FROM watchlist WHERE uid = 1");
    $array = Array();
    while($result = $query->fetch_assoc()){
        $array[] = $result['symbol'];
    }
    return $array;

    /*
    $result = mysql_query("SELECT symbol FROM watchlist WHERE uid = ?");
    $storeArray = Array();
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $storeArray[] =  $row['symbol'];  
    }
    
    var_dump($storeArray);

    */

    // $stmt = $mysqli->prepare("SELECT Column FROM foo");
    // $stmt->execute();
    // $array = [];
    // foreach ($stmt->get_result() as $row)
    // {
    // $array[] = $row['column'];
    // }
    // print_r($array);

    /*
    $sql = "SELECT symbol FROM watchlist WHERE uid = ?";    
    var_dump($UID);
    mysql_select_db('stonkstrade');
    $retval = mysql_query( $sql, $conn );
   
   if(! $retval ) {
      die('Could not get data: ' . mysql_error());
   }
   */
    
    /*
    $stmt = mysqli_stmt_init($conn);
    var_dump($stmt);
    */
    /*
    $row = $retval->fetch_array(MYSQLI_ASSOC);
    var_dump($row);
    */
}

// function DatabaseTicker($tickers){

//     $curl = curl_init();
     
//     curl_setopt_array($curl, [
//         CURLOPT_URL => "https://apidojo-yahoo-finance-v1.p.rapidapi.com/market/v2/get-quotes?region=US&symbols=$tickers",
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_FOLLOWLOCATION => true,
//         CURLOPT_ENCODING => "",
//         CURLOPT_MAXREDIRS => 10,
//         CURLOPT_TIMEOUT => 30,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => "GET",
//         CURLOPT_HTTPHEADER => [
//             "x-rapidapi-host: apidojo-yahoo-finance-v1.p.rapidapi.com",
//             "x-rapidapi-key: 1351fd3e73mshf9c79221e8acff1p127f35jsn6272bcbd7b09"
//         ],
//     ]);

//     $response = curl_exec($curl);
//     $err = curl_error($curl);

//     curl_close($curl);

//     if ($err) {
//         echo "cURL Error #:" . $err;
//         return null;
//     } else {
//         $parse = json_decode($response);

//         $return_val = ["symbol" => $parse->quoteResponse->result[0]->symbol,"name" => $parse->quoteResponse->result[0]->longName];
//         return $return_val;
//     }


// }





?>