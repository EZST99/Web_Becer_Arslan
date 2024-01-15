<!doctype html>
<html>

<head>
    <?php
    session_start();
    include 'nav.php';
    ?>

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
        <div class="col-lg-6">
            <h2>Über Uns</h2>
            <p>Willkommen im Boho-Hotel, Ihrem Zufluchtsort für unkonventionelle Eleganz und entspannten Luxus. Unsere
                Leidenschaft für die Schönheit des Bohemian-Stils spiegelt sich in jedem Detail unseres Hotels wider.
            </p>

            <h2>Unsere Zimmer</h2>
            <p>Willkommen in unserem Boho-Hotel, wo jede Zimmerkategorie eine einzigartige Erfahrung bietet.</p>

            <h2>Kontakt</h2>
            <p><a href="mailto:kontakt@helios.com">kontakt@helios.com</a> <br> Tel.: +43 1 000 00 01</p>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <?php
    include 'footer.php';
    ?>

</body>

</html>