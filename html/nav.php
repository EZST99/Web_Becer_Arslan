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
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <!-- Logo -->
                <a href="#" class="navbar-brand">
                    <img src="../images/Logo.png" alt="Helios Hotel Logo" height="150">
                </a>
                <a href="#" class="navbar-brand">Hotel Helios</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                    <span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navmenu">
                    <ul class="navbar-nav ms-auto">
                        <?php
                        if (isset($_SESSION["user"])) {
                            echo '<li class="nav-item">
                            <a href="logout.php" class="nav-link">Logout</a>
                        </li>';
                            echo ' <li class="nav-item">
                            <a href="news.php" class="nav-link">Poste neue News</a>
                        </li>';
                        } else {
                            echo '<li class="nav-item">
                            <a href="login.php" class="nav-link">Login</a>
                        </li>';
                            echo '<li class="nav-item">
                            <a href="registrierung.php" class="nav-link">Registrierung</a>
                        </li>';
                        }
                        ?>
                        <li class="nav-item">
                            <a href="posted_news.php" class="nav-link">News</a>
                        </li>


                    </ul>
                </div>

            </div>
        </nav>
    </header>
</body>

</html>