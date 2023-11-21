<?php

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Überprüfe, ob das Passwort und die Passwort-Wiederholung übereinstimmen
    if (isset($_POST["password"]) && isset($_POST["repassword"]) && !empty($_POST["password"]) && !empty($_POST["repassword"])) {
        $password = $_POST["password"];
        $repassword = $_POST["repassword"];
        if ($password !== $repassword) {
            $error_message = "Passwörter stimmen nicht überein.";
            exit;
        }
    } 
    if (!empty($error_message)) {
        // Es gibt Fehler, das Formular wird nicht abgesendet
        echo "$error_message";
    } else {
        // Alle Validierungen sind erfolgreich, verarbeite das Formular
        setcookie("loginCookie", $_POST["username"], time()+3600);
        header("Location: index.php");
    }
} 
