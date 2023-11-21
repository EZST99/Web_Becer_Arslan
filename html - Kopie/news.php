<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Aktuelle Nachrichten</h1>

        <?php
        // Überprüfe, ob das Formular abgeschickt wurde
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["newsFile"])) {
            // Den Typ des Bildes auf image/jpeg überprüfen
            if ($_FILES["newsFile"]["type"] == "image/jpeg") {
                // Wenn wirklich ein Bild noch geladen wurde...
                // Dateipfad des Zieles dynamisch zusammensetzen <WorkingFolder>\news\<EindeutigeID>_<UrsprünglicherDateiname>
                $uploadDirectory = "news/";
                $destination = $uploadDirectory . uniqid() . "_" . $_FILES["newsFile"]["name"];

                // Hochgeladen Datei vom Zwischenspeicher zum vorher zusammengesetzten Dateipfad verschieben
                if (move_uploaded_file($_FILES["newsFile"]["tmp_name"], $destination)) {
                    echo "Die Datei " . htmlspecialchars(basename($_FILES["newsFile"]["name"])) . " wurde erfolgreich hochgeladen.";
                } else {
                    echo "Es gab einen Fehler beim Hochladen der Datei.";
                }
            } else {
                // Es wurde keine JPEG-Bild hochgeladen
                // Nur eine Fehlermeldung ausgeben
                echo "Der Dateityp wird nicht unterstützt.";
            }
        }

        // Zeige die Nachrichten nur an, wenn das Formular ausgefüllt wurde
        echo '
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="News Image">
                    <div class="card-body">
                        <h5 class="card-title">Schlagzeile 1</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in felis eget arcu hendrerit.</p>
                        <a href="#" class="btn btn-primary">Weiterlesen</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="News Image">
                    <div class="card-body">
                        <h5 class="card-title">Schlagzeile 2</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in felis eget arcu hendrerit.</p>
                        <a href="#" class="btn btn-primary">Weiterlesen</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="News Image">
                    <div class="card-body">
                        <h5 class="card-title">Schlagzeile 3</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in felis eget arcu hendrerit.</p>
                        <a href="#" class="btn btn-primary">Weiterlesen</a>
                    </div>
                </div>
            </div>
        </div>';
        ?>

        <!-- Zeige das Formular, wenn es noch nicht abgeschickt wurde -->
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="newsFile" class="form-label">Nachrichten-Datei auswählen</label>
                <input type="file" class="form-control" id="newsFile" name="newsFile" accept=".jpg, .jpeg">
            </div>
            <button type="submit" class="btn btn-primary">Hochladen</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
