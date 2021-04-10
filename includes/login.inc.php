<?php

    if (isset($_POST["submit"])){

        $email = $_POST["email"];
        $pwd = $_POST["pw"];
        require_once "connection.php";
        require_once "functions.inc.php";
        echo "<p>pwd : $pwd</p>";
        echo "<p>email : $email</p>";
    
        
        //error handling again
        if(emptyInputLogin($email,$pwd) != false) {
            //header("location: ../login.php?error=emptyinput");
            exit();
        }
        
        loginUser($conn,$email,$pwd);
        header("location: ../index.php");
    } else {
        header('location: ../login.php');
        
        echo "<p> ERROR </p>";
        exit();
    }



    // header("Content-Type: text/plain");

    // //get information
    // $suName = $_POST["uName"];
    // $sPassword = $_POST["pw"];
    // //$sPassword_confirm = $_POST["signup-reenter-password"];
    
    // //create the SQL query string
    // //$sql = "Insert into users(Username,Password) values ('$suName', '$sPassword');";
    // $sql = "Select * from users where username = '$suName';";

     

    // //database information
    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "stonkstrade";
    // >


    // $conn = new mysqli($servername, $username, $password, $dbname);
    // if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
  
    // $result = $conn->query($sql);
    // $row = $result->fetch_array();
    
    // if (strcmp($row[1], $sPassword) === 0) {

    //     echo"<script>loginAccess()</script>";
    //     // header("Location: http://localhost/CP465/index.php");
    //     // exit();

        
    // } else {
    // echo "Error conferming ID: " . $conn->error;
    // }
    // $conn->close();

    
?>