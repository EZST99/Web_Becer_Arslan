<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbaccess.php'; // Hier die Datenbankverbindung einbinden

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Daten aus dem Formular erhalten
    $reservierungs_id = $_POST['reservierungs_id'];
    $res_status = $_POST['res_status'];

    // SQL-Query zum Aktualisieren der Daten in der Datenbank
    $query = "UPDATE reservierung SET res_status = '$res_status' WHERE reservierungs_id = '$reservierungs_id'";

    if ($conn->query($query) === TRUE) {
        echo "Daten wurden erfolgreich aktualisiert.";
        header("Location: made_reservations.php");
    } else {
        echo "Fehler beim Aktualisieren der Daten: " . $conn->error;
    }
}
?>
