<?php
session_start();
include 'nav.php';
include 'dbaccess.php'; // Hier die Datenbankverbindung einbinden

if ((isset($_SESSION["user_typ"]))) {
    $user_typ = $_SESSION["user_typ"];
    if ((!($user_typ == "admin"))) {
        header('Location: index.php');
        exit();
    }
    else {


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>User Management</title>

    <style>
        /* Globale Styles für den Körper (body) und den Footer */
        body {
            color: #566787;
            background: #f5f5f5;
            background-image: url('../images/admin_background.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Dies stellt sicher, dass der Footer am unteren Rand bleibt */
            margin: 0;
            /* Entfernen Sie den Standardseitenrand */
        }

        .container-xl {
            flex: 1;
            /* Nimmt den verfügbaren vertikalen Platz ein */
        }

        /* Styles für die Tabelle und den Footer */
        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            min-width: 800px;
            background: rgba(255, 255, 255, 0.92);
            padding: 20px 25px;
            border-radius: 5px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 15px;
            background: #dfd2bf;
            color: #fff;
            padding: 15px 30px;
            border-radius: 5px 5px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <?php
        // Überprüfen, ob die E-Mail-Adresse übergeben wurde
        if(isset($_GET['email'])) {
            $email = $_GET['email'];

            // SQL-Abfrage, um die Benutzerdaten anhand der E-Mail-Adresse abzurufen
            $query = "SELECT * FROM users WHERE email = '$email'";
            $result = $conn->query($query);

            // Überprüfen, ob ein Ergebnis gefunden wurde
            if($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $vorname = $row["vorname"];
                $nachname = $row["nachname"];
                $status = $row["user_status"];
                $geburtsdatum = $row["geburtsdatum"];
                $username = $row["username"];
                $passwort = $row["passwort"];
                $anrede = $row["anrede"];
                
                // Hier kannst du ein Formular anzeigen, um die Daten zu bearbeiten
                echo '
                <div class="container-xl">
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h2>User: <b>'.$vorname.' '.$nachname.'</b></h2>
                                </div>
                            </div>
                        </div>
                        <form action="speichern.php" method="post">
                            <div class="mb-3">
                                <br>
                                <label for="email" class="form-label">E-Mail:</label>
                                <input type="text" class="form-control" id="email" name="email" value="'.$email.'" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="anrede" class="form-label">Anrede:</label>
                                <input type="text" class="form-control" id="anrede" name="anrede" value="'.$anrede.'">
                            </div>
                            
                            <div class="mb-3">
                                        <label for="vorname" class="form-label">Vorname:</label>
                                        <input type="text" class="form-control" id="vorname" name="vorname" value="'.$vorname.'">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nachname" class="form-label">Nachname:</label>
                                        <input type="text" class="form-control" id="nachname" name="nachname" value="'.$nachname.'">
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username:</label>
                                        <input type="text" class="form-control" id="username" name="username" value="'.$username.'">
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status:</label>
                                        <input type="text" class="form-control" id="status" name="status" value="'.$status.'">
                                    </div>
                                    <div class="mb-3">
                                        <label for="geburtstag" class="form-label">Geburtstag:</label>
                                        <input type="date" class="form-control" id="geburtstag" name="geburtstag" value="'.$geburtsdatum.'">
                                    </div>
                                    <div class="mb-3">
                                        <label for="passwort" class="form-label">Passwort:</label>
                                        <input type="password" class="form-control" id="passwort" name="passwort" value="'.$passwort.'">
                                    </div>

                            <button type="submit" class="btn btn-primary">Änderungen speichern</button>
                        </form>
                    </div>
                </div>
            </div>
        </html>
                    <br>';
            } else {
                echo 'Benutzer nicht gefunden';
            }
        } else {
            echo 'E-Mail-Adresse nicht übergeben';
        }
        ?>
    </div>

    <?php
    include 'footer.php';
    ?>
</body>

</html>
<?php
    }
}
else {
    header('Location: index.php');
        exit();
}
?>