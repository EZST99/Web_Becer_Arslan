<?php
session_start();
include 'nav.php';
include 'dbaccess.php'; // Hier die Datenbankverbindung einbinden
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">

    <style>
        .news-image {
            max-width: 100%;
            height: auto;
        }

        .card {
            /* Add shadows to create the "card" effect */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
        }

        /* On mouse-over, add a deeper shadow */
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        /* Add some padding inside the card container */
        .container {
            padding: 2px 16px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center mb-4">News</h1>

        <?php
        $news_query = $conn->query("SELECT bild_pfad, text, DATE_FORMAT(datum, '%d.%m.%Y') AS formatted_date FROM news ORDER BY datum DESC, news_id DESC");

        if ($news_query->num_rows > 0) {
            // Iterate through each news item and display them
            while ($row = $news_query->fetch_assoc()) {
                $bild_pfad = $row["bild_pfad"];
                $text = $row["text"];
                $formatted_date = $row["formatted_date"];

                echo '<!-- News Article Card -->
                    <div class="card mb-4">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="' . $bild_pfad . '" class="img-fluid news-image" alt="News Image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <p class="card-text" style="font-weight: lighter; margin-left: 20px"><strong>' . $formatted_date . '</strong><br>' . $text . '</p>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        } else {
            echo "<p>Noch keine Nachrichten vorhanden.</p>";
        }
        ?>
    </div>
    <?php
    include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
