<?php
session_start();


 // Sicherstellen, dass der Benutzer angemeldet ist, bevor auf diese Seite zugegriffen wird.
 // Falls nicht, wird der Benutzer zur Login-Seite weitergeleitet.

if (!isset($_SESSION['user'])) {
    header('Location: login_page.php');
}


 // Dateiinhalt der Reservierungen aus "reservations.txt" lesen.
 // Die Inhalte werden durch das Zeichen "}" getrennt und in ein Array gespeichert.
 
$file_content = file_get_contents("./reservations.txt");
$serialized_arrays = explode("}", $file_content);
$reservations = [];


 // Durchlaufe jedes serialisierte String und versuche, es zu deserialisieren.
 // Gültige deserialisierte Daten, die ein Array sind, werden zur Liste der Reservierungen hinzugefügt.
foreach ($serialized_arrays as $serialized_array) {
    if (!empty($serialized_array)) {
        // Versuch, die Daten zu deserialisieren
        $unserialized_data = unserialize($serialized_array . '}');

        
         // Überprüfen, ob die Deserialisierung erfolgreich war und ob die deserialisierten Daten ein Array sind.
         // Falls ja, werden sie zur Liste der Reservierungen hinzugefügt.
        if ($unserialized_data !== false && is_array($unserialized_data)) {
            $reservations[] = $unserialized_data;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Reservierungen</title>
    <style>
        .table th{
            background: rgba(233, 225, 213, 0.8);
        }
    </style>
</head>

<body>
    <?php include("nav.php"); ?>
    <div class="bg-image" style="background-image: url('https://images.unsplash.com/photo-1507652313519-d4e9174996dd?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); height: 100vh; background-repeat: no-repeat; background-size: cover; background-position:center;">
    <div class="container">
        <div class="display-4 text-bold row justify-content-center mb-2">Ihre Reservierungen</div>
        <div class="table-responsive">
            <!-- Wenn Reservierungen vorhanden sind, erstellen eine Tabelle -->
            <?php if (!empty($reservations)) { ?>
    <table class="table table-bordered table-hover custom-table">
    <thead class="dark-brown-table-header">
    <tr>
        <th scope="col">Anreise</th>
        <th scope="col">Abreise</th>
        <th scope="col">Zimmertyp</th>
        <th scope="col">Frühstück</th>
        <th scope="col">Parkplatz</th>
        <th scope="col">Haustiere</th>
    </tr>
</thead>
        <tbody>
            <?php foreach ($reservations as $reservation) { ?>
                <tr>
                    <td><?php echo $reservation['anreise'] ?></td>
                    <td><?php echo $reservation['abreise'] ?></td>
                    <td><?php echo $reservation['room'] ?></td>
                    <td><?php echo $reservation['breakfast'] ?></td>
                    <td><?php echo $reservation['park'] ?></td>
                    <td><?php echo $reservation['tiere'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>Keine Reservierungen gefunden.</p>
<?php } ?>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>