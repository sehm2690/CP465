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
            header("location: ../login.php?error=emptyinput");
            exit();
        }
        
        loginUser($conn,$email,$pwd);
        header("location: ../index.php");
    } else {
        header('location: ../login.php');
        
        echo "<p> ERROR </p>";
        exit();
    }

?>