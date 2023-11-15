<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Index</title>

    <style>
        .welcome-message {
            margin-top: 50px;
            margin-left: 110px;
            font-size: 24px;
            font-weight: bold;
            color: rgba(108, 73, 9, 0.671);
        }
    </style>
</head>

<body>
    <?php
    session_start();
    include 'nav.php';

   /* if (isset($_COOKIE["loginCookie"])) {
        $cookieValue = $_COOKIE["loginCookie"];
        echo '<div class="welcome-message"> Willkommen ' . $cookieValue . '!</div>';
    }*/

if (isset($_SESSION["user"])) {
    echo '<div class="welcome-message"> Hello <span style="color: red">' . $_SESSION["user"] . '</span></div>';
}




/*if (isset($_GET["logout"]) && $_GET["logout"] == "true") {
    echo '<h2> Bye, bye
        <span class="badge bg-secondary"> ' . $_SESSION["user"] . '</span>
        </h2>
        <a class="btn btn-primary" href="?logout=true">Logout</a>';
}*/
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>

</html>