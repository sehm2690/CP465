<?php
    if(isset($_POST["submit"])){
        $Firstname = $_POST["Fname"];
        $Lastname = $_POST["Lname"];
        $email = $_POST["email"];
        $password1 = $_POST["pwd"];
        $passwordRepeat = $_POST["pwdrepeat"];
        echo "Fname : $Firstname";
        echo "Lname : $Lastname";
        echo "email : $email";
        echo "password  : $password1";
        echo "passwordRepeat: $passwordRepeat";

        if(isset($_POST["submit"])){
            
            require_once 'connection.php';
            require_once 'functions.inc.php';


            //if there is empty --> TRUE else pass onto other test
            if (emptyInputSignup($Firstname,$Lastname,$email, $password1, $passwordRepeat) != false){
                header("location: ../createacc.php?error=emptyinput");
                exit();
                }
                //invalid email
            if (invalidEmail($email) != false){
                header("location: ../createacc.php?error=invalidemail");
                exit();

            }

            //pwdMatch
            if (pwdMatch($password1, $passwordRepeat) != false){
                header("location: ../createacc.php?error=pwdError");
                exit();

            }
            //userin database
            if (emailExists($conn, $email) != false){
                header("location: ../createacc.php?error=usertaken");
                
                exit();
            } 
            
            createUser($conn,$Firstname,$Lastname,$email,$password1);




        }
    }
?>







