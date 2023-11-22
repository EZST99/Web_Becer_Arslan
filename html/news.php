<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create News</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

<body>
    <?php
    include 'nav.php';
    ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">News Posten</h1>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["newsFile"])) {
            // Den Typ des Bildes auf image/jpeg überprüfen
            if ($_FILES["newsFile"]["type"] == "image/jpeg") {
                $uploadDirectory = "news/";
                $imageFileName = uniqid() . "_" . $_FILES["newsFile"]["name"];
                $imageDestination = $uploadDirectory . $imageFileName;
                $newPicture = $imageDestination; // Store the link here

                if (!isset($_SESSION["newsPic"]) || !is_array($_SESSION["newsPic"])) {
                    $_SESSION["newsPic"] = [];
                }
                $_SESSION["newsPic"][] = $newPicture;

                // Hochgeladen Datei vom Zwischenspeicher zum vorher zusammengesetzten Dateipfad verschieben
                if (move_uploaded_file($_FILES["newsFile"]["tmp_name"], $imageDestination)) {
                    if (isset($_POST["newsText"])) {
                        $newText = $_POST["newsText"];
                        if (!isset($_SESSION["news"]) || !is_array($_SESSION["news"])) {
                            $_SESSION["news"] = [];
                        }
                        $_SESSION["news"][] = $newText;
                        echo "Upload war erfolgreich.";
                    }
                } else {
                    echo "Es gab einen Fehler beim Hochladen der Datei.";
                }
            } else {
                // Es wurde keine JPEG-Bild hochgeladen
                echo "Der Dateityp wird nicht unterstützt.";
            }
        }
        ?>

        <!-- Zeige das Formular, wenn es noch nicht abgeschickt wurde -->
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="newsFile" class="form-label">Nachrichten-Datei auswählen</label>
                <input type="file" class="form-control" id="newsFile" name="newsFile" accept=".jpg, .jpeg">
            </div>
            <div class="mb-3">
                <label for="newsText" class="form-label">Text eingeben</label>
                <textarea class="form-control" id="newsText" name="newsText"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Hochladen</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
