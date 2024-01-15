<?php
session_start();
include 'dbaccess.php'; // Hier die Datenbankverbindung einbinden

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Daten aus dem Formular erhalten
    $email = $_POST['email'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $geburtsdatum = $_POST['geburtstag'];
    $anrede = $_POST['anrede'];

    // SQL-Query zum Aktualisieren der Daten in der Datenbank (ohne Passwort und Status)
    $query = "UPDATE users SET vorname = '$vorname', nachname = '$nachname', geburtsdatum = '$geburtsdatum', anrede = '$anrede' WHERE email = '$email'";

    if ($conn->query($query) === TRUE) {
        echo "Daten wurden erfolgreich aktualisiert.";
        header("Location: profil.php");
    } else {
        echo "Fehler beim Aktualisieren der Daten: " . $conn->error;
    }
}
?>
