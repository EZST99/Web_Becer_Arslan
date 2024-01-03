<?php
$servername = "localhost"; // Der Name des Datenbankservers
$username = "admin1"; // Der Datenbankbenutzername
$password = "admin1"; // Das Passwort für den Datenbankbenutzer
$database = "db_helios"; // Der Name Ihrer Datenbank

// Datenbankverbindung erstellen
$conn = new mysqli($servername, $username, $password, $database);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
