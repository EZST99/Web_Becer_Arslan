<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="./Images/Untitled-design.svg">
    <title>Zimmer & Angebote</title>
    <style>
        .room-card {
            display: flex;
            margin-bottom: 20px;
        }

        .room-image {
            flex: 1;
        }

        .room-details {
            flex: 1;
            padding: 20px;
        }

        .btn1 {
            border: none;
            outline: none;
            height: 50px;
            width: 100%;
            background-color: rgba(108, 73, 9, 0.671);
            color: white;
            border-radius: 4px;
            font-weight: bold;
        }

        .btn1:hover {
            background: white;
            border: 1px solid;
            color: rgba(108, 73, 9, 0.671);
        }
    </style>
</head>

<body>
    <?php include 'nav.php' ?>

    <div class="bg-image"
        style="background-image: url('https://plus.unsplash.com/premium_photo-1669863547155-be11a345d599?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-position:center; background-size:cover; background-repeat:no-repeat; height:100%;">
        <div class="container">
            <div class="row pt-4 pb-5">
                <!-- Single Room Card -->
                <div class="col-12 col-md-6">
                    <div class="room-card">
                        <div class="room-image">
                            <img src="https://images.unsplash.com/photo-1424847262089-18a6858bd7e2?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="card-img-top" alt="Single Zimmer">
                        </div>
                        <div class="room-details">
                            <h5 class="card-title">Einzelzimmer</h5>
                            <p class="card-text">Unser gemütliches Einzelzimmer, inspiriert vom Boho-Chic, bietet ein
                                bequemes Einzelbett, umgeben von lebhaften, kunstvollen Textilien und Pflanzen. Ein
                                idealer Rückzugsort für Alleinreisende, mit handgefertigten Möbeln und einer
                                entspannenden Atmosphäre.</p>
                                <button class="btn1" <?php if (!isset($_SESSION["user"])) { ?> onclick="location.href='./login.php'" <?php } else { ?> onclick="location.href='./reservierung_neu.php'" <?php } ?>>
    Jetzt Buchen
</button>
                        </div>
                    </div>
                </div>

                <!-- Double Room Card -->
                <div class="col-12 col-md-6">
                    <div class="room-card">
                        <div class="room-image">
                            <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="card-img-top" alt="Double Zimmer">
                        </div>
                        <div class="room-details">
                            <h5 class="card-title">Doppelzimmer</h5>
                            <p class="card-text">Dieses stilvolle Doppelzimmer im Boho-Stil verfügt über ein
                                komfortables Doppelbett, umgeben von exotischen Kunstwerken und handgewebten Teppichen.
                                Perfekt für Paare, mit einer gemütlichen Sitzecke und einem Blick auf den malerischen
                                Garten.</p>
                            <button class="btn1" <?php if (!isset($_SESSION["user"])) { ?>
                                    onclick="location.href='./login.php'" <?php } else { ?>
                                    onclick="location.href='./reservierung_neu.php'" <?php } ?>>
                                Jetzt Buchen
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Suite Room Card -->
                <div class="col-12 col-md-6">
                    <div class="room-card">
                        <div class="room-image">
                            <img src="https://images.unsplash.com/photo-1568495248636-6432b97bd949?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="card-img-top" alt="Suite">
                        </div>
                        <div class="room-details">
                            <h5 class="card-title">Familiensuite</h5>
                            <p class="card-text">Unsere geräumige Familiensuite bietet ein bohemisches Erlebnis mit zwei
                                Schlafzimmern, bunten Textilien und handgefertigten Möbeln. Ideal für Familien, mit
                                einem Spielbereich für Kinder und einem entspannenden Wohnbereich für Erwachsene.</p>
                            <button class="btn1" <?php if (!isset($_SESSION["user"])) { ?>
                                    onclick="location.href='./login.php'" <?php } else { ?>
                                    onclick="location.href='./reservierung_neu.php'" <?php } ?>>
                                Jetzt Buchen
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Honeymoon Suite Room Card -->
                <div class="col-12 col-md-6">
                    <div class="room-card">
                        <div class="room-image">
                            <img src="https://images.unsplash.com/photo-1623050632591-13118534319e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="card-img-top" alt="Honeymoon-Suite">
                        </div>
                        <div class="room-details">
                            <h5 class="card-title">Honeymoon Suite</h5>
                            <p class="card-text">Die Honeymoon Suite, ein romantischer Zufluchtsort im Boho-Stil, bietet
                                ein luxuriöses Kingsize-Bett, eine private Terrasse und einen atemberaubenden Blick. Mit
                                handverlesenen Kunstwerken und einer freistehenden Badewanne, perfekt für frisch
                                Vermählte.</p>
                            <button class="btn1" <?php if (!isset($_SESSION["user"])) { ?>
                                    onclick="location.href='./login.php'" <?php } else { ?>
                                    onclick="location.href='./reservierung_neu.php'" <?php } ?>>
                                Jetzt Buchen
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>