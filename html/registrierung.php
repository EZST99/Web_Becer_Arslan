<?php
include 'nav.php';
include 'dbaccess.php'; // Hier die Datenbankverbindung einbinden
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Registrierung</title>
    <style>
        .error {
            color: #FF0000;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background: rgb(214, 198, 180);
        }

        .row {
            background: white;
        }

        .img-fluid {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
        }

        .btn1 {
            border: none;
            outline: none;
            height: 50px;
            width: 100%;
            background-color: rgba(108, 73, 9, 0.671);
            color: white;
            border-radius: 4px;
            font-weight: bold;
        }

        .btn1:hover {
            background: white;
            border: 1px solid;
            color: rgba(108, 73, 9, 0.671);
        }

        .error-message {
            color: red;
        }

        .success {
            color: green;
        }
    </style>

</head>

<body>
    <?php    

    $nachnameErr = $emailErr = $usernameErr = $anredeErr = $vornameErr = $passwordErr = $repasswordErr = $geburtsdatumErr = $regErfolg = "";
    $username = $email = $geburtsdatum = $anrede = $nachname = $vorname = $password = $repassword = "";


    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validierung für Vorname
        if(empty($_POST["vorname"])) {
            $vornameErr = "Bitte ausfüllen!";
        } else {
            $vorname = test_input($_POST["vorname"]);
            if(!preg_match("/^[a-zA-Z ]*$/", $vorname)) {
                $vornameErr = "Nur Buchstaben und Leerzeichen erlaubt!";
            }
        }

        // Validierung für Nachname
        if(empty($_POST["nachname"])) {
            $nachnameErr = "Bitte ausfüllen!";
        } else {
            $nachname = test_input($_POST["nachname"]);
            if(!preg_match("/^[a-zA-Z ]*$/", $nachname)) {
                $nachnameErr = "Nur Buchstaben und Leerzeichen erlaubt!";
            }
        }

        // Validierung für Benutzername
        if(empty($_POST["username"])) {
            $usernameErr = "Bitte ausfüllen!";
        } else {
            $username = test_input($_POST["username"]);
        }

        // Validierung für Anrede
        if(empty($_POST["anrede"])) {
            $anredeErr = "Bitte ausfüllen!";
        } else {
            $anrede = test_input($_POST["anrede"]);
            if(!preg_match("/^[a-zA-Z ]*$/", $anrede)) {
                $anredeErr = "Nur Buchstaben erlaubt!";
            }
        }

        // Email-Validierung
        if(empty($_POST["email"])) {
            $emailErr = "Bitte ausfüllen!";
        } else {
            $email = test_input($_POST["email"]);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Ungültiges Format!";
            } else {
                // Überprüfen, ob die E-Mail-Adresse bereits in der Datenbank vorhanden ist
                $check_email_query = $conn->prepare("SELECT * FROM users WHERE email = ?");
                $check_email_query->bind_param("s", $email);
                $check_email_query->execute();
                $result = $check_email_query->get_result();

                if($result->num_rows > 0) {
                    $emailErr = "Diese E-Mail-Adresse ist bereits registriert!";
                }

                $check_email_query->close();
            }
        }

        // Validierung für Passwort
        if(empty($_POST["password"])) {
            $passwordErr = "Bitte ausfüllen!";
        } else {
            $password = test_input($_POST["password"]);
        }

        // Validierung für Passwort wiederholen
        if(empty($_POST["repassword"])) {
            $repasswordErr = "Bitte ausfüllen!";
        } else {
            $repassword = test_input($_POST["repassword"]);
            if($repassword !== $password) {
                $repasswordErr = "Die Passwörter stimmen nicht überein!";
            }
        }

        // Validierung für Geburtsdatum
        if(empty($_POST["geburtsdatum"])) {
            $geburtsdatumErr = "Bitte ausfüllen!";
        } else {
            $geburtsdatum = test_input($_POST["geburtsdatum"]);
        }

        // Überprüfen, ob keine Fehler aufgetreten sind
        if($vornameErr == "" && $nachnameErr == "" && $emailErr == "" && $usernameErr == "" && $geburtsdatumErr == "" && $anredeErr == "" && $passwordErr == "" && $repasswordErr == "") {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (anrede, vorname, nachname, email, geburtsdatum, username, passwort) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $anrede, $vorname, $nachname, $email, $geburtsdatum, $username, $hashedPassword);

            if($stmt->execute()) {
                $regErfolg = "Sie haben sich erfolgreich registriert!";
                // Weitere erfolgreiche Registrierungsausgaben...
            } else {
                echo "Fehler beim Speichern der Daten in die Datenbank: ".$stmt->error;
            }
            $stmt->close();
            $conn->close();
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <section class="Form my-4 mx-5">
        <div class="container">
            <div class="row no-gutters" style="border-radius: 30px; box-shadow: 12px 12px 22px rgb(33, 32, 32);">
                <div class="col-lg-7 px-5 pt-5">
                    <h1 class="font-weight-bold py-3">Hotel Helios</h1>
                    <h4>Registrieren</h4>
                    <p><span class="error"></span></p>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-row">
                                    <input name="anrede" type="text" class="form-control my-3 p-4" placeholder="Anrede">
                                    <span class="error">
                                        <?php echo $anredeErr; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-row">
                                    <input name="vorname" type="text" class="form-control my-3 p-4"
                                        placeholder="Vorname">
                                    <span class="error">
                                        <?php echo $vornameErr; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-row">
                                    <input name="nachname" type="text" class="form-control my-3 p-4"
                                        placeholder="Nachname">
                                    <span class="error">
                                        <?php echo $nachnameErr; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-row">
                                    <input name="email" type="email" class="form-control my-3 p-4" placeholder="E-Mail">
                                    <span class="error">
                                        <?php echo $emailErr; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-row">
                                    <input name="geburtsdatum" type="date" class="form-control my-3 p-4">
                                    <span class="error">
                                        <?php echo $geburtsdatumErr; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-row">
                                    <input name="username" type="text" class="form-control my-3 p-4"
                                        placeholder="Username">
                                    <span class="error">
                                        <?php echo $usernameErr; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-row">
                                    <input name="password" type="password" class="form-control my-3 p-4"
                                        placeholder="Passwort">
                                    <span class="error">
                                        <?php echo $passwordErr; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-row">
                                    <input name="repassword" type="password" class="form-control my-3 p-4"
                                        placeholder="Passwort wiederholen">
                                    <span class="error">
                                        <?php echo $repasswordErr; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <button type="submit" class="btn1 mt-3 mb-5">Registrieren</button>
                            <span class="success">
                                <?php echo $regErfolg; ?>
                                <br>
                            </span>
                        </div>
                    </form>
                    <p>Bereits ein Account? <a href="login.php">Melde dich an</a></p>
                </div>
                <div class="col-lg-5 p-0">
                    <img src="../images/Old_Lesbians_New.png" class="img-fluid p-0 m-0" alt="Gäste Bild">
                </div>
            </div>
        </div>
    </section>
</body>

</html>