<?php
    
    
    function emptyInputSignup($Firstname,$Lastname,$email,$password, $passwordRepeat){
        $result;
        if ( empty($Firstname)|| empty($Lastname) || empty($email)|| empty($password)|| empty($passwordRepeat)) {
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
    
    function pwdMatch($password,$passwordRepeat){
        $result;
        if ($password !== $passwordRepeat){
            $result = true;
        } else {
            $result = false;
        }
        return $result;

    }
    
    // function invalidUid($conn, $email){
    //     $result;
    //     if ($ !== $passwordRepeat){
    //         $result = true;
    //     } else {
    //         $result = false;
    //     }
    //     return $result;

    // }


    function uIDexists($conn, $email){
        $sql = "SELECT * FROM users WHERE email = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../createacc.php?error=stmtfailed");
            exit();

        }
        mysqli_stmt_bind_param($stmt,"s","$email");
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
    function createUser($conn,$Firstname,$Lastname,$email,$password){
        $sql = "INSERT INTO users (firstname,lastname,email,password) VALUES (?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../createacc.php?error=stmtfailed");
            exit();

        }

        $hashedPwd = password_hash($password,PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt,"ssss",$Firstname,$Lastname,$email,$hashedPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../signup.php?error=none");
        exit();

    }
