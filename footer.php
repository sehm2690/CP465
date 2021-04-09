<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .footer {
            /* background-image: url(img/BlackMarble.png); */
            position: absolute;
            left: 0;
            bottom: 0;
            height: 100%;
            width: 100%;
            background-color: whitesmoke;
            color: black;
            text-align: center;
        }

        .wrapper {
            /*  This is breaking the margins of the footer */
            /* min-height: 20%; */
            position: relative;
        }

        .content {
            /* padding the footer adds 40 to footer height */
            padding-bottom: 140px;
        }

        #footer {
            position: fixed;
            bottom: 0;
            background: whitesmoke;
            width: 100%;
            font-family: 'Open Sans', sans-serif;
            color: #000000;
            text-align: center;
            /* padding: 20px; */
        }
    </style>
</head>

<body>
    <footer>
        <div class="wrapper">
            <div id="footer">
                <p>&copy; 2021 | Stock Simulator. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

</body>

</html>