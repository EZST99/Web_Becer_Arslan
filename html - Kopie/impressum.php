<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <style>
        .custom-container {
            background: white;
            padding: 10%;
            border-radius: 30px;
            box-shadow: 12px 12px 22px rgb(33, 32, 32);
        }
    </style>
    <title>Impressum</title>
</head>

<body>
    <?php
    include 'nav.php';
    ?>
    <section class="container">
        <h1 class="text-center" style="margin-bottom: 40px; margin-top: 40px"> Impressum</h1>
        <div class="row text-center"> <!-- Änderung in der Bootstrap-Klasse hier -->
            <div class="col-md-12"> <!-- Volle Breite, um Texte untereinander darzustellen -->
                <div class="mb-4 ms-3"> <!-- Klasse für leichte Einrückung beibehalten -->
                    <h2>Hotel Helios GmbH</h2>
                    <address>
                        Hotelstraße 31<br>
                        1020 Wien, Österreich
                    </address>
                    <p>Telefon: +43 1 000 00 01<p>
                    <p>E-Mail: <a href="mailto:kontakt@helios.com">kontakt@helios.com</a></p>
                    <p class="mt-4">Hotellerie</p>
                    <p>Firmenbuchnummer: 123456 v</p>
                    <p>UID-Nummer: ATU01020304</p>
                    <p>Firmenbuchgericht: HG Wien</p>
                    <p>Mitglied der WKÖ</p>
                    <br>
                </div>
            </div>
            <div class="col-md-12"> <!-- Volle Breite für zentrierte Darstellung -->
                <div class="ms-5 me-3"> <!-- Klasse für größere Einrückung beibehalten -->
                    <div class="container" style="max-width: 700px; margin: 0 auto;"> <!-- Begrenzung des Textcontainers -->
                        <h2>Hinweis zur Streitbeilegung</h2>
                    <p>
                        Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit, die
                        Sie unter <a href="https://ec.europa.eu/consumers/odr">https://ec.europa.eu/consumers/odr</a>
                        finden können. Unsere E-Mail-Adresse für den Kontakt in Bezug auf Beschwerden lautet <a
                            href="mailto:kontakt@helios.com">kontakt@helios.com</a>.
                    </p>
                    <br> 
                    <br>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <h2 class="text-center">Unsere Hotelverwaltung</h2>
        <div class="row justify-content-center g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <img src="../images/Hotelverwaltung_Dicle.jpg" alt="Hotelverwaltung Foto Dicle Becer" width="178"
                            height="273">
                        <h3 class="card-title mb-3">Dicle Becer</h3>
                        <p class="card-text">CEO und Mitbegründer</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <img src="../images/Hotelverwaltung_Irem.jpg" alt="Hotelverwaltung Foto Irem Arslan" width="200"
                            height="273">
                        <h3 class="card-title mb-3">Irem Arslan</h3>
                        <p class="card-text">CEO und Mitbegründer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>