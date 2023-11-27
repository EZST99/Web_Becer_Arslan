<?php
session_start();
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
    <?php
    include 'nav.php';
    ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">News</h1>

        <?php
        if (isset($_SESSION["news"]) && is_array($_SESSION["news"]) && isset($_SESSION["newsPic"])) {
            // Iterate through each news item and corresponding picture
            foreach (array_map(null, $_SESSION["news"], $_SESSION["newsPic"]) as list($newsText, $newsPic)) {
                echo '<!-- News Article Card -->
                    <div class="card mb-4">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="' . $newsPic . '" class="img-fluid news-image" alt="News Image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <p class="card-text" style="font-weight: lighter; margin-left: 20px">' . $newsText . '</p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>