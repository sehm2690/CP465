<?php

    if(isset($_POST["submit"])){
        $Firstname = $_POST["Fname"];
        $Lastname = $_POST["Lname"];
        $email = $_POST["email"];
        $password = $_POST["pas"];
        $passwordRepeat = $_POST["pwdrepeat"];
        // echo "Fname : $Firstname";
        // echo "Lname : $Lastname";
        // echo "email : $email";
        echo "password  : $password";
        echo "passwordRepeat: $passwordRepeat";


        require_once 'connection.php';
        require_once 'functions.inc.php';


        //if there is empty --> TRUE else pass onto other test
       if (emptyInputSignup($Firstname,$Lastname,$email, $password, $passwordRepeat) != false){
           //header("location: ../creatacc.php?error=emptyinput");
           exit();
        }
        //invalid email
        // if (invalidEmail($email) == false){
        //     header("location: ../creatacc.php?error=invalidemail");
        //     exit();

        // }
        //pwdMatch
        if (pwdMatch($password, $passwordRepeat) != false){
            //header("location: ../creatacc.php?error=pwdError");
            exit();

        }
        //userin database
        // if (emailExists($conn, $email) !== false){
        //     header("location: ../creatacc.php?error=takenUser");
        //     exit();
        // } 
        
        createUser($conn,$Firstname,$Lastname,$email,$password);




    }

   

    







// header("Content-Type: text/plain");

// //get information
// $suName = $_POST["uName"];
// $sPassword = $_POST["pw"];
// //$sPassword_confirm = $_POST["signup-reenter-password"];

// //create the SQL query string
// $sql = "Insert into users(Username,Password) values ('$suName', '$sPassword');";


// //database information
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "stonkstrade";

// $conn = new mysqli($servername, $username, $password, $dbname);
// if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// $result = $conn->query($sql);
// if ($result === TRUE) {
//     $last_id = $conn->insert_id;
//     echo "Insert successfully. Last inserted ID is: " . $last_id;
// } else {
// echo "Error creating database: " . $conn->error;
// }
// $conn->close();
?>







