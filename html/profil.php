<?php
session_start();
include 'nav.php';
include 'dbaccess.php'; // Hier die Datenbankverbindung einbinden
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Profilverwaltung</title>
    <style>
    /* Fügen Sie diesem CSS-Stil die Klasse .footer-container hinzu */
    .footer-container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Fügen Sie diesem CSS-Stil die Klasse .footer hinzu */
    .footer {
        margin-top: auto;
    }
    .success-message {
        color: green;
    }

    /* Stil für Fehlermeldung */
    .error-message {
        color: red;
    }
</style>
</head>

<body>
    <?php

    // Überprüfen, ob ein Benutzer eingeloggt ist
    if (isset($_SESSION['user'])) {
        $username = $_SESSION['user'];

        // SQL-Abfrage, um Benutzerdaten anhand der E-Mail-Adresse abzurufen
        $query = "SELECT * FROM users WHERE username = '{$_SESSION['user']}'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $vorname = $row["vorname"];
            $nachname = $row["nachname"];
            $status = $row["user_status"];
            $geburtsdatum = $row["geburtsdatum"];
            $email = $row["email"];
            $passwort = $row["passwort"];
            $anrede = $row["anrede"];

            // Hier können Sie ein Formular anzeigen, um die Daten zu bearbeiten
            echo '<div class="footer-container">
            <div class="bg-image">
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                            class="rounded-circle mt-5" width="150px"
                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span
                            class="font-weight-bold">
                            ' . $vorname . ' '. $nachname . '
                            </span><span class="text-black-50">
                                ' . $email . '
                            </span><span> </span></div>
                        </div>
                        <div class="col-md-5 offset-md-1">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                     <h4 class="text-right">Profileinstellungen</h4>
                                        </div>
                                            <div class="row mt-3">
                                                <form action="speichernProfil.php" method="post">
                                                    <div class="form-group">
                                                        <label for="username" class="form-label">Username:</label>
                                                        <input type="text" class="form-control" id="username" name="username" value="'.$username.'" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email" class="form-label">E-Mail-Adresse:</label>
                                                        <input type="email" class="form-control" id="email" name="email" value="'.$email.'" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="anrede" class="form-label">Anrede:</label>
                                                        <input type="text" class="form-control" id="anrede" name="anrede" value="'.$anrede.'">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="vorname" class="form-label">Vorname:</label>
                                                        <input type="text" class="form-control" id="vorname" name="vorname" value="'.$vorname.'">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nachname" class="form-label">Nachname:</label>
                                                        <input type="text" class="form-control" id="nachname" name="nachname" value="'.$nachname.'">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="geburtstag" class="form-label">Geburtstag:</label>
                                                        <input type="date" class="form-control" id="geburtstag" name="geburtstag" value="'.$geburtsdatum.'">
                                                    </div>
                                                    <br>
                                                    <div class="col-12">
                                                        <button class="btn btn-dark" type="submit" name="register">Änderungen
                                                            speichern</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                    <div class="p-3 py-5">
                                        <h4 class="text-right">Passwort ändern</h4>
                                        <br>
                                        <form action="change_password.php" method="post">
                                            <div class="form-group">
                                                <label for="altesPasswort" class="form-label">Altes Passwort:</label>
                                                <input type="password" class="form-control" id="altesPasswort" name="altesPasswort">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="neuesPasswort">Neues Passwort</label>
                                                <input type="password" class="form-control" name="neuesPasswort" id="neuesPasswort">
                                            </div>
                                            <br>
                                            <div class="col-12">
                                                <button class="btn btn-dark" type="submit" name="register">Passwort ändern</button>
                                            </div>
                                        </form>';
                                        
                                        // Meldungen anzeigen, falls vorhanden
                                        if (isset($_SESSION['password_change_success'])) {
                                            echo '<p class="success-message">' . $_SESSION['password_change_success'] . '</p>';
                                            unset($_SESSION['password_change_success']); // Meldung entfernen, damit sie nicht erneut angezeigt wird
                                        }
                                        if (isset($_SESSION['password_change_error'])) {
                                            echo '<p class="error-message">' . $_SESSION['password_change_error'] . '</p>';
                                            unset($_SESSION['password_change_error']); // Meldung entfernen, damit sie nicht erneut angezeigt wird
                                        }
                                        
                                        echo '</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>';
        } else {
            echo 'Benutzer nicht gefunden';
        }
    } else {
        echo 'Benutzer nicht eingeloggt';
    }
    ?>

<div class="footer"> <!-- Diese Div umschließt den Footer-Inhalt -->
            <?php
            include 'footer.php'; // Hier wird der Footer eingefügt
            ?>
        </div>
        </div>
</body>

</html>
