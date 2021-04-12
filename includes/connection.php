<?php
    //database information
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "stonkstrade";

    //establish connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
?>