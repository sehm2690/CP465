<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="#">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <div class="form">
        <form method="post" action="includes/login.inc.php">
            <h1>Login</h1>

            <p>Email:</p>
            <input type="text" name="email" placeholder="Enter Email">


            <p>Password:</p>
            <input type="password" name="pw" placeholder="Enter Password">


            <input type="submit" name="submit" value="Login">


        </form>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p> Please fill in all fields! </p>";
            } else if ($_GET["error"] == "wronglogin") {
                echo "<p> Incorrect login information </p>";
            }
        }
        ?>
        <button class=createaccbtn onclick="window.location.href='createacc.php'">Create Account</button>
        <div id="divStatus"> </div>


    </div>



</body>


</html>