<?php
session_start();
include 'nav.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Hilfeseite</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%; /* Stellt sicher, dass der Body die gesamte Höhe des Viewports einnimmt */
            display: flex;
            flex-direction: column; /* Richtet Kinder-Elemente vertikal aus */
        }

        .content {
            flex-grow: 1; /* Lässt den Inhalt wachsen und den verfügbaren Platz einnehmen */
        }

        footer {
            flex-shrink: 0; /* Verhindert, dass der Footer zusammengedrückt wird */
        }
    </style>
</head>

<body>
<div class="content">
  <!-- FAQ Bereich -->
  <section class="p-5 body-content">
    <div class="container">
      <h2 class="text-center mb-4">Häufig gestellte Fragen / FAQ</h2>
      <div class="accordion accordion-flush" id="questions">
        <!-- Item one -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
              Wie melde ich mich an?
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne">
            <div class="accordion-body">Um sich anzumelden, klicken Sie auf die Schaltfläche "Anmelden" oben rechts und
              geben Sie
              Ihre Anmeldeinformationen ein.</div>
          </div>
        </div>
        <!-- Item two -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
              Wie ändere ich mein Passwort?
            </button>
          </h2>
          <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo">
            <div class="accordion-body">Um Ihr Passwort zu ändern, gehen Sie zu Ihrem Profil und klicken Sie auf
              "Passwort ändern".
              Folgen Sie dann den Anweisungen, um Ihr neues Passwort einzugeben.</div>
          </div>
        </div>
        <!-- Item three -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
              Welche Zahlungsmethoden akzeptiert das Hotel?
            </button>
          </h2>
          <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree">
            <div class="accordion-body">Wir akzeptieren gängige Kreditkarten sowie Zahlungen per Banküberweisung.
              Weitere
              Informationen finden Sie auf unserer Buchungsseite.</div>
          </div>
        </div>
        <!-- Item four -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
              Kann ich meine Buchung stornieren oder ändern?
            </button>
          </h2>
          <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour">
            <div class="accordion-body">Ja, Sie können Ihre Buchung gemäß unseren Stornierungs- und Änderungsrichtlinien
              ändern oder
              stornieren.</div>
          </div>
        </div>
      </div>
  </section>
  </div>
  </div>
            <?php
            include 'footer.php'; // Hier wird der Footer eingefügt
            ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</body>

</html>