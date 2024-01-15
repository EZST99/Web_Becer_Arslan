<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbaccess.php'; // Hier die Datenbankverbindung einbinden

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Daten aus dem Formular erhalten
    $email = $_POST['email'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $username = $_POST['username'];
    $status = $_POST['status'];
    $geburtsdatum = $_POST['geburtstag'];
    $passwort = $_POST['passwort'];
    $hashedPassword = password_hash($passwort, PASSWORD_DEFAULT);

    // SQL-Query zum Aktualisieren der Daten in der Datenbank
    $query = "UPDATE users SET vorname = '$vorname', nachname = '$nachname', username = '$username', user_status = '$status', geburtsdatum = '$geburtsdatum', passwort = '$hashedPassword' WHERE email = '$email'";

    if ($conn->query($query) === TRUE) {
        echo "Daten wurden erfolgreich aktualisiert.";
        header("Location: manage_users.php");
    } else {
        echo "Fehler beim Aktualisieren der Daten: " . $conn->error;
    }
}
?>
