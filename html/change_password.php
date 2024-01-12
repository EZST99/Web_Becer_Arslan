<?php
session_start();
include 'dbaccess.php'; // Hier die Datenbankverbindung einbinden

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Daten aus dem Formular erhalten
    $altesPasswort = $_POST['altesPasswort'];
    $neuesPasswort = $_POST['neuesPasswort'];

    // SQL-Abfrage, um die Benutzerdaten abzurufen
    $query = "SELECT passwort, email FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $_SESSION['user']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Überprüfen, ob das eingegebene alte Passwort korrekt ist
        if (password_verify($altesPasswort, $row["passwort"]) || ($altesPasswort == $row["passwort"])) {            // Das alte Passwort stimmt überein, Passwort aktualisieren
            $neuesPasswortHash = password_hash($neuesPasswort, PASSWORD_DEFAULT);
            $email = $row["email"];
            $updateQuery = "UPDATE users SET passwort = ? WHERE email = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("ss", $neuesPasswortHash, $email);

            if ($updateStmt->execute()) {
                $_SESSION['password_change_success'] = "Passwort wurde erfolgreich aktualisiert.";
            } else {
                $_SESSION['password_change_error'] = "Fehler beim Aktualisieren des Passworts: " . $conn->error;
            }
        } else {
            $_SESSION['password_change_error'] = "Das eingegebene alte Passwort ist nicht korrekt.";
        }
    } else {
        $_SESSION['password_change_error'] = "Benutzer nicht gefunden.";
    }
    $stmt->close();
}
header("Location: profil.php");
exit();
?>
