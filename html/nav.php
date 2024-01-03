<?php
include 'dbaccess.php'; // Hier die Datenbankverbindung einbinden

// Überprüfen, ob ein Benutzer angemeldet ist
if(isset($_SESSION["user"])) {
    // Benutzer ist angemeldet, holen Sie den user_typ aus der Datenbank
    $username = $_SESSION["user"];
    $stmt = $conn->prepare("SELECT user_typ FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $user_typ = $row["user_typ"];
        $_SESSION["user_typ"] = $user_typ;
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html>

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

        .custom-logo {
            margin-right: 2px; /* Hier kannst du den Abstand des Logos nach links anpassen */
        }
    </style>
</head>

<body>
    
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <!-- Logo -->
                 <a href="#" class="navbar-brand custom-logo"> <!-- Füge die neue Klasse hier hinzu -->
                    <img src="../images/Logo.png" alt="Helios Hotel Logo" height="100">
                </a>
                <a href="#" class="navbar-brand">Hotel Helios</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navmenu">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">Home</a>
                        </li>
                        <?php
                        if(isset($_SESSION["user_typ"])) {
                            $user_typ = $_SESSION["user_typ"];
                            if($user_typ == "admin") {
                                // Links für Administrator
                                echo '<li class="nav-item">
                                    <a href="index.php" class="nav-link">Home</a>
                                </li>';
                                echo '<li class="nav-item">
                                    <a href="logout.php" class="nav-link">Logout</a>
                                </li>';
                                echo '<li class="nav-item">
                                    <a href="profil.php" class="nav-link">Profil</a>
                                </li>';
                                echo '<li class="nav-item">
                                    <a href="posted_news.php" class="nav-link">News</a>
                                </li>';
                                echo '<li class="nav-item">
                                    <a href="news.php" class="nav-link">Poste neue News</a>
                                </li>';
                            } else {
                                // Links für andere Benutzer
                                echo '<li class="nav-item">
                                    <a href="index.php" class="nav-link">Home</a>
                                </li>';
                                echo '<li class="nav-item">
                                    <a href="logout.php" class="nav-link">Logout</a>
                                </li>';
                                echo '<li class="nav-item">
                                    <a href="profil.php" class="nav-link">Profil</a>
                                </li>';
                                echo '<li class="nav-item">
                                    <a href="posted_news.php" class="nav-link">News</a>
                                </li>';
                            }
                        } else {
                            // Standardlinks für nicht angemeldete Benutzer
                            echo '<li class="nav-item">
                                <a href="index.php" class="nav-link">Home</a>
                            </li>';
                            echo '<li class="nav-item">
                                <a href="login.php" class="nav-link">Login</a>
                            </li>';
                            echo '<li class="nav-item">
                                <a href="registrierung.php" class="nav-link">Registrierung</a>
                            </li>';
                            echo '<li class="nav-item">
                                <a href="posted_news.php" class="nav-link">News</a>
                            </li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</body>

</html>