<?php
    
    
    function emptyInputSignup($Firstname,$Lastname,$email,$password1, $passwordRepeat){
        $result;
        if ( empty($Firstname)|| empty($Lastname) || empty($email)|| empty($password1)|| empty($passwordRepeat)) {
            $result = true;

        } else {
            $result = false; 
        }
        return $result;
    }
    
    function invalidEmail($email){
        $result;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result = true;
        } else{
            $result = false;
        }
        return $result;
    }
    
    function pwdMatch($password1,$passwordRepeat){
        $result;
        if ($password1 !== $passwordRepeat){
            $result = true;
        } else {
            $result = false;
        }
        return $result;

    }

    function emailExists($conn, $email){
        $sql = "SELECT * FROM users WHERE email = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../createacc.php?error=stmtfailed");
            exit();

        }
        mysqli_stmt_bind_param($stmt,"s",$email);
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
    
    //creating the user
    function createUser($conn,$Firstname,$Lastname,$email,$password1){
        $sql = "INSERT INTO users (firstname,lastname,email,password) VALUES (?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../createacc.php?error=stmtfailed");
            exit();

        }

        $hashedPwd = password_hash($password1,PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt,"ssss",$Firstname,$Lastname,$email,$hashedPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../createacc.php?error=none");
        exit();

    }
    function emptyInputLogin($email,$pwd){
        $result;
        if ( empty($email)|| empty($pwd)) {
            $result = true;

        } else {
            $result = false; 
        }
        return $result;
    }
    function loginUser ($conn, $email, $pwd){
        $emailExists = emailExists($conn,$email);
        if ($emailExists == false){
            header("location: ../login.php?error=wronglogin");
        }
        //checks password against  user types in  password (can use this function cause its assoc. array) 
        $pwdHashed = $emailExists["password"];
        $checkPwd = password_verify($pwd,$pwdHashed);

        if($checkPwd == false){          

            header("location: ../login.php?error=wronglogin");

            exit();
        }
        else if ($checkPwd == true){
            session_start();
            //make users info Accessible
            $_SESSION["email"] = $emailExists["email"];
            $_SESSION["fname"] = $emailExists["firstname"];
            
            $_SESSION["UserID"] = $emailExists["UID"];
            $_SESSION["cash"] = $emailExists["cash"];

            header("location: .. /index.php");
        }
    }
