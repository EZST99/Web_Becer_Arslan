<?php
include 'dbaccess.php';
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: login_page.php');
  exit(); // Fügen Sie exit() hinzu, um sicherzustellen, dass das Skript nach der Weiterleitung beendet wird
}

$conf_msg = $anreise = $abreise = $room = $breakfast = $park = $tiere = "";
$error_msg = "Bitte füllen Sie sowohl das Anreisedatum als auch das Abreisedatum aus!";
$isOk = 1;

// Zimmerkosten Mapping (pro Nacht)
$zimmerkosten = [
  'Single' => 100,
  'Double' => 120,
  'Familiensuite' => 160,
  'Honeymoonsuite' => 180
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["anreise"])) {
    $anreise = $_POST['anreise'];
  }
  if (isset($_POST['abreise'])) {
    $abreise = $_POST['abreise'];
  }
  if (isset($_POST['room'])) {
    $room = $_POST['room'];
  }
  if (isset($_POST['breakfast'])) {
    $breakfast = $_POST['breakfast'];
  }
  if (isset($_POST['park'])) {
    $park = $_POST['park'];
  }
  if (isset($_POST['tiere'])) {
    $tiere = $_POST['tiere'];
  }

  if (!empty($anreise) && !empty($abreise)) {
    if ($anreise <= $abreise) {
      // Berechnen Sie die Anzahl der Nächte
      $anreiseDatum = new DateTime($anreise);
      $abreiseDatum = new DateTime($abreise);
      $anzahlNaechte = $abreiseDatum->diff($anreiseDatum)->days;

      // Berechnen Sie die Kosten basierend auf dem ausgewählten Zimmertyp und Anzahl der Nächte
      if (array_key_exists($room, $zimmerkosten)) {
        $kostenProNacht = $zimmerkosten[$room];
        $kosten = $anzahlNaechte * $kostenProNacht;
      } else {
        // Fehlerbehandlung für ungültigen Zimmertyp
        $error_msg = "Ungültiger Zimmertyp ausgewählt!";
        $isOk = 0;
      }

      // Zusätzliche Kosten für Frühstück, Haustiere und Parkplatz
      $zusatzkosten = 0;

      if ($breakfast == 1) {
        $zusatzkosten += 15;
      }

      if ($tiere == 1) {
        $zusatzkosten += 20;
      }

      if ($park == 1) {
        $zusatzkosten += 15;
      }

      // Gesamtkosten einschließlich der Zusatzkosten
      $gesamtkosten = $kosten + $zusatzkosten;

      $reservation = [
        'anreise' => $anreise,
        'abreise' => $abreise,
        'room' => $room,
        'breakfast' => $breakfast,
        'park' => $park,
        'tiere' => $tiere
      ];

      $string_data = serialize($reservation);
      file_put_contents("reservations.txt", $string_data, FILE_APPEND);

      $sql = "INSERT INTO reservierung (anreisedatum, abreisedatum, zimmertyp, fruehstueck, parkplatz, haustiere, kosten) VALUES ('$anreise', '$abreise', '$room', '$breakfast', '$park', '$tiere', $gesamtkosten)";

      if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn); // Abrufen der zuletzt eingefügten reservierungs_id

        $username = $_SESSION['user']; // Angenommen, die Session enthält den Benutzernamen

        // Abfrage der E-Mail-Adresse des Benutzers aus der Datenbank
        $email_query = "SELECT email FROM users WHERE username = '$username'";
        $email_result = mysqli_query($conn, $email_query);

        if ($email_result && mysqli_num_rows($email_result) > 0) {
          $row = mysqli_fetch_assoc($email_result);
          $email = $row['email'];

          // Aktualisierte SQL-Abfrage für das Einfügen in die Tabelle user_reservierung
          $update_sql = "INSERT INTO user_reservierungen (reservierungs_id, user_email) VALUES ('$last_id', '$email')";
          mysqli_query($conn, $update_sql);

          $conf_msg = "Reservierung erfolgreich! Sie können Ihre Reservierungen <a href='./meine_reservierungen.php'>hier</a> sehen.";
        } else {
          $error_msg = "Benutzer-E-Mail konnte nicht aus der Datenbank abgerufen werden.";
        }
      } else {
        $error_msg = "Fehler beim Hinzufügen der Reservierung in die Datenbank: " . mysqli_error($conn);
      }
    } else {
      $isOk = 0;
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Hotel Reservierung</title>
  <style>
    /* Stile für die Vollbild-Slideshow */
    .slideshow {
      position: relative;
      height: 100vh;
      /* Vollbildhöhe */
      overflow: hidden;
    }

    .slide {
      display: none;
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      transition: opacity 0.5s ease-in-out;
      /* Sanfte Übergänge */
    }

    .slide.active {
      display: block;
    }

    .slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      /* Bild anpassen, um den gesamten Bereich zu füllen */
    }

    .navigation {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      z-index: 1;
    }

    .nav-arrow {
      cursor: pointer;
      background-color: rgba(255, 255, 255, 0.3);
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .nav-arrow:hover {
      background-color: rgba(255, 255, 255, 1.3);
    }

    /Reservierungssachen/ .body {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      /* Abgerundete Ecken */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      /* Schatten für Tiefe */
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-control {
      border-radius: 5px;
      /* Abgerundete Ecken für Eingabefelder */
      border: 1px solid #ccc;
      padding: 10px;
      width: 100%;
    }

    .form-select {
      border-radius: 5px;
      /* Abgerundete Ecken für Auswahlmenüs */
      border: 1px solid #ccc;
      padding: 10px;
      width: 100%;
    }

    #box {
      background-color: rgba(255, 255, 255, 0.5);
      /* White with 0.5 opacity */
      background-size: cover;
      margin: 2rem;
    }

    .btn {
      background-color: #007bff;
      /* Blaue Farbe für Buttons */
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      /* Abgerundete Ecken für Buttons */
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .btn:hover {
      background-color: #0056b3;
      /* Dunkleres Blau bei Hover */
    }


    #faqbody .accordion {
      padding: 3rem 3rem;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
    }

    .error_msg {
      color: red;
      margin-bottom: 15px;
    }

    .body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
    }

    .display-10 {
      font-weight: bold;
    }

    .card {
      margin-top: 5%;
      -webkit-transition: all .2s ease-out;
      -moz-transition: all .2s ease-out;
      -ms-transition: all .2s ease-out;
      -o-transition: all .2s ease-out;
      transition: all .2s ease-out;
      border-radius: 15px;
      border: none;
      background-color: white;
    }

    .btn-light {
      opacity: 0;
      position: absolute;
      left: 50%;
      top: 110%;
      transform: translate(-50%, -50%);
      box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0);
      -webkit-transition: all .2s ease-out;
      -moz-transition: all .2s ease-out;
      -ms-transition: all .2s ease-out;
      -o-transition: all .2s ease-out;
      transition: all .2s ease-out;
      border-radius: 10px;
      padding: 0.8rem 1.7rem;
      border: none;
      font-weight: bold;
    }

    .card:hover .btn {
      opacity: 1;
      top: 100%;
      box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);
    }

    .card:hover {
      box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.7);
      transform: scale(1.05);
    }

    body {
      font-family: 'Arial', sans-serif;
      /* Elegante und lesbare Schriftart */
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      background-color: #f5f5f5;
      /* Sanfter Hintergrund */
    }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 0 20px;
    }

    h1,
    h2,
    h3,
    label {
      color: #333;
      /* Dunklere Farbe für bessere Lesbarkeit */
    }
  </style>
</head>

<body>
  <?php
  include 'nav.php';
  ?>
  <!-- Slideshow -->
  <div class="slideshow">
    <div class="slide active">
      <img
        src="https://images.unsplash.com/photo-1683914791874-2dcb78e58e09?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
        alt="Slide 1">
    </div>
    <div class="slide">
      <img
        src="https://images.unsplash.com/photo-1683914791867-20c3fa8734fe?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
        alt="Slide 2">
    </div>
    <div class="slide">
      <img
        src="https://images.unsplash.com/photo-1445019980597-93fa8acb246c?q=80&w=2074&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
        alt="Slide 3">
    </div>
    <div class="slide">
      <img
        src="https://images.unsplash.com/photo-1600210491305-7396500b5b31?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
        alt="Slide 4">
    </div>

    <!-- Navigation Pfeile -->
    <div class="navigation">
      <div class="nav-arrow" onclick="prevSlide()"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
          fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd"
            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
        </svg></div>
      <div class="nav-arrow" onclick="nextSlide()"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
          fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd"
            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
        </svg></div>
    </div>
  </div>

  <script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const slideCount = slides.length;

    function showSlide(n) {
      slides.forEach(slide => slide.classList.remove('active'));
      slides[n].classList.add('active');
    }

    function nextSlide() {
      currentSlide = (currentSlide + 1) % slideCount;
      showSlide(currentSlide);
    }

    function prevSlide() {
      currentSlide = (currentSlide - 1 + slideCount) % slideCount;
      showSlide(currentSlide);
    }
  </script>
  <br>
  <br>
  <div class="bg-image"
    style="background-image: url('https://images.unsplash.com/photo-1555181937-efe4e074a301?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">

    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="" style="border-radius: 1rem;">
            <div class="row g-0">
              <br>
              <br>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="body p-4 p-lg-5 text-black">
                  <h1 class="h3 mb-3 font-weight-normal text-center">Reservierung</h1>
                  <?php if ($isOk == 0) {
                    echo "<div class='error_msg display-8'> $error_msg </div>";
                  } else { ?>
                  <?php }
                  echo "<div class='display-8'> $conf_msg </div>" ?>
                  <form action="" method="post">
                    <div class="form-group ">
                      <label for="anreise">Anreisedatum</label>
                      <input type="date" name="anreise" class="form-control input-with-post-icon datepicker"
                        min="<?php echo date('Y-m-d'); ?>" inline="true" placeholder="Anreisedatum">
                    </div>
                    <div class="form-group mt-4">
                      <label for="abreise">Abreisedatum</label>
                      <input type="date" name="abreise" class="form-control input-with-post-icon datepicker"
                        min="<?php echo date('Y-m-d'); ?>" inline="true" placeholder="Abreisedatum">
                    </div>

                    <?php
                    // Überprüfen, ob der Zimmertyp als URL-Parameter übergeben wurde
                    if (isset($_GET["room"])) {
                      $selectedRoom = $_GET["room"];
                    } else {
                      // Fallback, falls kein Zimmertyp übergeben wurde
                      $selectedRoom = ""; // Hier den Standard-Zimmertyp festlegen
                    }
                    ?>

                    <div class="form-group mt-4">
                      <label for="zimmertyp">Zimmertyp</label>
                      <select class="form-select" aria-label="room" name="room">
                        <option <?php if ($selectedRoom === "")
                          echo "selected"; ?> disabled value="">Bitte wählen Sie den
                          Zimmertyp...</option>
                        <option <?php if ($selectedRoom === "Single")
                          echo "selected"; ?> value="Single">Single Zimmer (100€ pro Nacht)
                        </option>
                        <option <?php if ($selectedRoom === "Double")
                          echo "selected"; ?> value="Double">Double Zimmer (120€ pro Nacht)
                        </option>
                        <option <?php if ($selectedRoom === "Familiensuite")
                          echo "selected"; ?> value="Familiensuite">
                          Familien Suite (160€ pro Nacht) </option>
                        <option <?php if ($selectedRoom === "Honeymoonsuite")
                          echo "selected"; ?> value="Honeymoonsuite">
                          Honeymoon Suite (180€ pro Nacht)</option>
                      </select>
                    </div>


                    <div class="form-group mt-4">
                      <label for="breakfast">Frühstück</label>
                      <select class="form-select" aria-label="breakfast" name="breakfast">
                        <option selected disabled value="">Möchten Sie Frühstück? (+15€)</option>
                        <option value="1">Ja (+15€)</option>
                        <option value="0">Nein</option>
                      </select>
                    </div>

                    <div class="form-group mt-4">
                      <label for="park">Parkplatz</label>
                      <select class="form-select" aria-label="park" name="park">
                        <option selected disabled value="">Möchten Sie einen Parkplatz reservieren? (+15€)
                        </option>
                        <option value="1">Ja (+15€)</option>
                        <option value="0">Nein</option>
                      </select>
                    </div>

                    <div class="form-group mt-4">
                      <label for="tiere">Haustiere</label>
                      <select class="form-select" aria-label="tiere" name="tiere">
                        <option selected disabled value="">Bringen Sie Ihre Haustiere mit? (+20€)</option>
                        <option value="1">Ja (+20€)</option>
                        <option value="0">Nein</option>
                      </select>
                    </div>

                    <br>
                    <div class="btns">
                      <button type="submit" name="reservieren" value="reservieren"
                        class="btn btn-dark">Reservieren</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include 'footer.php';
  ?>
</body>

</html>