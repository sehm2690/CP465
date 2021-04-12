<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="#">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login-page.css">



</head>

<body data-spy="scroll" data-target="#navbarSupportedContent">
    <style>
        body {
            background-image: url('img/stock_back.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            font-family: 'Lato', sans-serif;
        }
    </style>
    <header>
        <div class="container-fluid p-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
                <img src=" img/barchartlogo.png" alt="">
                <a class="navbar-brand" href="#">Stock Simulator</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </div>
    </header>
    <div class="createaccform">
        <form method="post" action="includes/make_accounts.inc.php">

            <h1>Create Account</h1>

            <p>First Name :</p>
            <input type="text" name="Fname" placeholder="Enter First Name">
            <p></p>
            <p>Last Name :</p>
            <input type="text" name="Lname" placeholder="Enter Last Name">
            <p></p>
            <p>Email :</p>
            <input type="text" name="email" placeholder="Enter Email">
            <p></p>
            <p>Password:</p>
            <input type="password" name="pwd" placeholder="Enter New Password">
            <p></p>
            <p>Re-enter Password:</p>
            <input type="password" name="pwdrepeat" placeholder="Re-enter New Password">
            <p></p>
            <p></p>
            <input type="submit" name="submit" value="Create Account">

        </form>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p> Please fill in all fields! </p>";
            } else if ($_GET["error"] == "invalidemail") {
                echo "<p> Please enter a valid email </p>";
            } elseif ($_GET["error"] == "pwdError") {
                echo "<p> Password does not match! </p>";
            } else if ($_GET["error"] == "usertaken") {
                echo "<p> The email has been taken, please enter a new email </p>";
            } else if ($_GET["error"] == "none") {
                echo "<p> Successful Sign-up </p>";
                header("location: ../CP465/login.php");

            }
        }
        ?>

        <div id="divStatus"> </div>



    </div>

</body>

