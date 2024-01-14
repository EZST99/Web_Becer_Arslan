<?php
include 'dbaccess.php'; // Hier die Datenbankverbindung einbinden

// Überprüfen, ob ein Benutzer angemeldet ist
if (isset($_SESSION["user"])) {
    // Benutzer ist angemeldet, holen Sie den user_typ aus der Datenbank
    $username = $_SESSION["user"];
    $stmt = $conn->prepare("SELECT user_typ FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $user_typ = $row["user_typ"];
        $_SESSION["user_typ"] = $user_typ;
    }
    $stmt->close();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .navbar {
            background-color: #dfd2bf;
        }

        .hotel-background {
            background-color: #dfd2bf;
        }

        .navbar {
            padding-top: 2px;
            padding-bottom: 2px;
        }
    </style>
    <!-- Weitere Head-Inhalte hier einfügen, falls erforderlich -->
</head>

<body>
    <footer>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <!-- Logo -->
                <a href="#" class="navbar-brand">
                    &copy; 2023, Hotel Helios GmbH, Inc
                </a>

                <div>
                    <ul class="navbar-nav ms-auto">
                        <?php
                        if (isset($_SESSION["user_typ"]) && $_SESSION["user_typ"] == "admin") {
                            // Links für Administrator
                            echo '<li class="nav-item"><a href="impressum.php" class="nav-link">Impressum</a></li>';
                            echo '<li class="nav-item"><a href="hilfe.php" class="nav-link">FAQ</a></li>';
                            echo '<li class="nav-item"><a href="news.php" class="nav-link">Post News</a></li>';
                            echo '<li class="nav-item"><a href="manage_users.php" class="nav-link">Manage User</a></li>';
                        } else {
                            // Standardlinks für andere Benutzer und nicht eingeloggte Benutzer
                            echo '<li class="nav-item"><a href="impressum.php" class="nav-link">Impressum</a></li>';
                            echo '<li class="nav-item"><a href="hilfe.php" class="nav-link">FAQ</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </footer>


</body>

</html>