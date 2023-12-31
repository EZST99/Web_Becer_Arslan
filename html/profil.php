<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Profilverwaltung</title>

</head>

<body>
    <?php
    session_start();
    include 'nav.php';
    // Statische Daten für das Beispiel
    $_SESSION["updateVorname"] = "Max";
    $_SESSION["updateNachname"] = "Mustermann";
    $_SESSION["updateAnrede"] = "Herr";
    $_SESSION["updateEmail"] = "max.mustermann@mail.com";
    $_SESSION["updateUsername"] = "admin";
    $_SESSION["updatePassword_1"] = "admin";

    $msg = $msg_passwort = '';

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST["anrede"])) {
            if($_SESSION["updateAnrede"] != $_POST["anrede"]) {
            }
            $_SESSION["updateAnrede"] = $_POST["anrede"];
            $msg = "<span class='text-success'> Das Profil wurde aktualisiert! </span>";

        }

        if(isset($_POST["vorname"])) {
            if($_SESSION["updateVorname"] != $_POST["vorname"]) {
            }
            $_SESSION["updateVorname"] = $_POST["vorname"];
            $msg = "<span class='text-success'> Das Profil wurde aktualisiert! </span>";

        }
        if(isset($_POST["lastname"])) {
            if($_SESSION["updateNachname"] != $_POST["lastname"]) {
            }
            $_SESSION["updateNachname"] = $_POST["lastname"];
            $msg = "<span class='text-success'> Das Profil wurde aktualisiert! </span>";

        }
        if(isset($_POST["username"])) {
            if($_SESSION["updateUsername"] != $_POST["username"]) {
            }
            $_SESSION["updateUsername"] = $_POST["username"];
            $msg = "<span class='text-success'> Das Profil wurde aktualisiert! </span>";

        }

        if(isset($_POST["email"])) {
            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $msg_email = "Ungültige E-Mail-Adresse!";
            } else {
                if($_SESSION["updateEmail"] != $_POST["email"]) {
                }
                $_SESSION["updateEmail"] = $_POST["email"];
                $msg = "<span class='text-success'> Das Profil wurde aktualisiert! </span>";

            }
        }

        if(!empty($_POST["password"]) && !empty($_POST["password_2"])) {
            if($_POST["password"] == $_SESSION["updatePassword_1"]) {
                $_SESSION["updatePassword_1"] = $_POST["password_2"];
                $msg_passwort = "<span class='text-success'> Das Passwort wurde aktualisiert! </span>";
            } else {
                $msg_passwort = "<span class='text-danger'> Altes Passwort stimmt nicht überein! </span>";
            }
        } else if(!empty($_POST["password"]) xor !empty($_POST["password_2"])) {
            $msg_passwort = "<span class='text-danger'> Bitte altes und neues Passwort angeben! </span>";
        }
    }
    ?>

    <div class="bg-image">
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                            class="rounded-circle mt-5" width="150px"
                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span
                            class="font-weight-bold">
                            <?php echo $_SESSION["updateVorname"]." ".$_SESSION["updateNachname"] ?>
                        </span><span class="text-black-50">
                            <?php echo $_SESSION["updateEmail"] ?>
                        </span><span> </span></div>
                </div>
                <div class="col-md-5 offset-md-1">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profileinstellungen</h4>
                        </div>
                        <div class="row mt-3">
                            <form action="" method="post">
                                <select class="form-select" aria-label="anrede" name="anrede">
                                    <option disabled value="">Bitte wählen Sie den Anrede</option>

                                    <option <?php if($_SESSION["updateAnrede"] == "Herr")
                                        echo "selected"; ?>
                                        value="Herr">Herr</option>
                                    <option <?php if($_SESSION["updateAnrede"] == "2")
                                        echo "selected"; ?> value="2">Frau
                                    </option>
                                    <option <?php if($_SESSION["updateAnrede"] == "3")
                                        echo "selected"; ?> value="3">
                                        Divers</option>
                                    <option <?php if($_SESSION["updateAnrede"] == "4")
                                        echo "selected"; ?> value="5">
                                        --</option>
                                </select>
                                <br>
                                <div class="form-group">
                                    <label for="vorname">Vorname</label>
                                    <input type="text" class="form-control" name="vorname" id="vorname"
                                        value="<?php echo $_SESSION["updateVorname"] ?>">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="lastname">Nachname</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname"
                                        value="<?php echo $_SESSION["updateNachname"] ?>">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="email">E-mail Adresse</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="example@email.com"
                                        value="<?php echo $_SESSION["updateEmail"] ?>">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="username">Benutzername</label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="Gewünschter Benutzername"
                                        value="<?php echo $_SESSION["updateUsername"] ?>">
                                </div>
                                <br>
                                <?php echo $msg; ?>
                                <br>
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
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="password">Altes Passwort</label>
                                <input type="password" class="form-control" name="password" id="password" value="">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="password_2">Neues Passwort</label>
                                <input type="password" class="form-control" name="password_2" id="password_2" value="">
                            </div>
                            <br>
                            <?php echo $msg_passwort; ?>
                            <br>
                            <br>
                            <div class="col-12">
                                <button class="btn btn-dark" type="submit" name="register">Passwort ändern</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
<?php include 'footer.php' ?>

</html>
