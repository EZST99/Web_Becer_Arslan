<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_helios";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
} else {
    echo "Verbindung zur Datenbank erfolgreich hergestellt.";
}
?>
