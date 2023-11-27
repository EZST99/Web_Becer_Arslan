<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

        .header {
            height: 100vh;
            background: url('../images/Hotel_Hintergrund.png') center/cover no-repeat;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
        }

        .scroll-indicator {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 24px;
        }

        .content {
            padding: 50px;
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

    /*if (isset($_SESSION["user"])) {
        echo '<div class="welcome-message"> Hello <span style="color: red">' . $_SESSION["user"] . '</span></div>';
    }*/




    /*if (isset($_GET["logout"]) && $_GET["logout"] == "true") {
    echo '<h2> Bye, bye
        <span class="badge bg-secondary"> ' . $_SESSION["user"] . '</span>
        </h2>
        <a class="btn btn-primary" href="?logout=true">Logout</a>';
}*/


    ?>

    <div class="header">
        <?php
        // Begrüßungstext vor dem Einloggen
        $welcomeText = '<h1>Welcome to Hotel Helios!</h1>';

        // Überprüfen, ob der Benutzer eingeloggt ist
        if (isset($_SESSION["user"])) {
            // Wenn der Benutzer eingeloggt ist, füge den Benutzernamen zum Begrüßungstext hinzu
            $welcomeText = '<h1>Welcome to Hotel Helios <span style="color: red">' . $_SESSION["user"] . '</span>!</h1>';
        }

        // Begrüßungstext anzeigen
        echo '<div>' . $welcomeText . '<p class="scroll-indicator">Scroll down to explore</p></div>';
        ?>

        <p class="scroll-indicator">Scroll down to explore</p>
    </div>

    <div class="content">
        <h2>About Us</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at justo in elit laoreet ultrices.</p>

        <h2>Our Rooms</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at justo in elit laoreet ultrices.</p>

        <h2>Contact</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at justo in elit laoreet ultrices.</p>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <?php
    include 'footer.php';
    ?>

</body>

</html>