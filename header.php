<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<style>
    img {
        width: 1.3%;
        height: 1%;
        bottom: 0%;
        vertical-align: middle
    }

</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stonks Trader</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script src="js/confirmPurchase.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            font-family: 'Lato', sans-serif;
        }
    </style>

</head>

<body data-spy="scroll" data-target="#navbarResponsive">
    <header>
        <div class="container-fluid p-0">
            <div class=logo>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <img src=" img/barchartlogo.png" alt="">
                    <a class="navbar-brand" href="index.php">Stonks Trader</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="portfolioTable.php">My Portfolio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="watchlist.php">Watchlist</a>
                            </li>
                            <?php
                            if (isset($_SESSION["email"])) {
                                $x = $_SESSION["email"];
                                $uname = $_SESSION["fname"];
                                $cash = $_SESSION["cash"];


                                echo "<li class='nav-item dropdown'>";
                                echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
                                echo "$uname";
                                echo "</a>";
                                echo "<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                                echo "<a class='dropdown-item' href='profilePage.php'>Profile</a>";
                                echo "<a class='dropdown-item' href='includes/logout.inc.php'>Sign Out</a>";
                                echo "</div>";
                                echo "</li>";
                            } else {
                                echo " ";
                            }
                            ?>
                            </li>


                        </ul>
                        <form class="form-inline my-2 my-lg-0" method="post" action="header.inc.php">
                            <input id="tickersearch" name="tickersearch" class="form-control mr-sm-2" type="search" placeholder="Search Ticker..." aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" name="ttickerSearch" type="submit">Search</button>

                           
                        </form>

                    </div>
            </div>
            </nav>
        </div>
    </header>
</body>