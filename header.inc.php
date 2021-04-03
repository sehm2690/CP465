<?php
    session_start();
?>
<?php


    if (isset($_POST["ttickerSearch"])){

        $ticker = $_POST["tickersearch"];
        $url = 'https://finance.yahoo.com/quote/'.$ticker;
        var_dump($url);
        //echo "<script>window.location.href=$url</script>";
        header("Location: $url");
}else {
    echo"<p>ERROR</p>";
}
    
    
    
?>