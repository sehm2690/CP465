<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="#">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style-2.css">

    
    
</head>
<body data-spy="scroll" data-target="#navbarSupportedContent">
    <style>
        body {
          background-image: url('img/stock_back.jpg');
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-size: cover;
        }
      </style>
    <header>
        <div class="container-fluid p-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
                <a class="navbar-brand" href="#">Stock Simulator</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </div>
    </header>
    <div class="loginbox">
    <div class="form">
        <form method="post" action="includes/make_accounts.inc.php" >
        
        
        <!-- <img src="avatar.png" class="avatar"> -->
        <h1>Create Account</h1>
        
            <p>First Name :</p>
            <input  type="text" name = "Fname" placeholder="Enter First Name">
            <p>Last Name :</p>
            <input  type="text" name = "Lname" placeholder="Enter Last Name">
            <p>Email :</p>
            <input  type="text" name = "email" placeholder="Enter Email">
            <p>Password:</p>
            <input type="password" name = "pwd" placeholder="Enter New Password">
            <p>Re-enter Password:</p>
            <input type ="password" name = "pwdrepeat" placeholder="Re-enter New Password">
            <!--<button id="btn-login" onclick = "createacc()">Create Account</button><br><br> -->
        
        <input type="submit" name = "submit" value="Create Account" >
        

        </form>
        <?php 
        if (isset($_GET["error"])) {
            if($_GET["error"] == "emptyinput"){
                echo "<p> Please fill in all fields! </p>";
            }
            else if($_GET["error"] == "invalidemail"){
                echo "<p> Please enter a valid email </p>";
            }
            elseif($_GET["error"] == "pwdError"){
                echo "<p> Password does not match! </p>";
            }
            else if($_GET["error"] == "usertaken"){
                echo "<p> The email has been taken, please enter a new email </p>";
            }
            else if($_GET["error"] == "none"){
                echo "<p> Successful Sign-up </p>";
                header("Location: http://localhost/cp476/cp465/login.php");
            }
        }
        ?>
       
        <div id="divStatus"> </div>
        
        
       
    </div>
    
    </div>

    <!-- <script src="auth.js"></script>
    <script src="index.js"></script> -->
    <!--<script src="createacc.js"></script> -->
</body>


<!-- <script>
    function sendRequest() {
        var oForm = document.forms[0];
        var sBody = getRequestBody(oForm);
        var xhttp = new XMLHttpRequest();
        xhttp.open("post", oForm.action, true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4) {
                if (xhttp.status == 200) {
                    saveResult(xhttp.responseText);
                } else {
                    saveResult("An error occurred: " + xhttp.statusText);
                }
            }
        };
    xhttp.send(sBody);
    }

    function getRequestBody(oForm) {
        var aParams = new Array();
        for (var i = 0; i < oForm.elements.length; i++) {
            var sParam = encodeURIComponent(oForm.elements[i].name);
            sParam += "=";
            sParam += encodeURIComponent(oForm.elements[i].value);
            aParams.push(sParam);
        }
        return aParams.join("&");
    }

    function saveResult(sMessage) {
        var divStatus = document.getElementById("divStatus");
        divStatus.innerHTML = "Request completed: " + sMessage;
    }

</script> -->