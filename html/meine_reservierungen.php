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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Reservierungen</title>
    <style>
        /* Globale Styles für den Körper (body) und den Footer */
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 14px;
            background-image: url('../images/admin_background.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Dies stellt sicher, dass der Footer am unteren Rand bleibt */
            margin: 0;
            /* Entfernen Sie den Standardseitenrand */
        }

        .container-xl {
            flex: 1;
            /* Nimmt den verfügbaren vertikalen Platz ein */
        }

        /* Styles für die Tabelle und den Footer */
        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            min-width: 800px;
            background: rgba(255, 255, 255, 0.92);
            padding: 20px 25px;
            border-radius: 5px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 15px;
            background: #dfd2bf;
            color: #fff;
            padding: 15px 30px;
            border-radius: 5px 5px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }
    </style>
</head>

<body>

    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2><b>Reservierungen</b></h2>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Anreise</th>
                            <th>Abreise</th>
                            <th>Zimmertyp</th>
                            <th>Frühstück</th>
                            <th>Parkplatz</th>
                            <th>Haustiere</th>
                            <th>Kosten</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $username = $_SESSION['user']; // Angenommen, die Session enthält den Benutzernamen
                        $email_query = "SELECT email FROM users WHERE username = '$username'";
                        $email_result = mysqli_query($conn, $email_query);

                        if ($email_result && mysqli_num_rows($email_result) > 0) {
                            $row = mysqli_fetch_assoc($email_result);
                            $email = $row['email'];

                            $query = "SELECT user_reservierungen.reservierungs_id, reservierung.anreisedatum, reservierung.abreisedatum, reservierung.zimmertyp, reservierung.fruehstueck, reservierung.parkplatz, reservierung.haustiere, reservierung.kosten, reservierung.res_status FROM user_reservierungen INNER JOIN reservierung ON user_reservierungen.reservierungs_id = reservierung.reservierungs_id WHERE user_reservierungen.user_email = '$email'";
                            $result = $conn->query($query);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $anreisedatum = $row["anreisedatum"];
                                    $abreisedatum = $row["abreisedatum"];
                                    $zimmertyp = $row["zimmertyp"];
                                    $fruehstueck = $row["fruehstueck"];
                                    $parkplatz = $row["parkplatz"];
                                    $haustiere = $row["haustiere"];
                                    $kosten = $row["kosten"];
                                    $res_status = $row["res_status"];

                                    echo '<tr>
                                            <td>' . $anreisedatum . '</td>
                                            <td>' . $abreisedatum . '</td>
                                            <td>' . $zimmertyp . '</td>
                                            <td>' . $fruehstueck . '</td>
                                            <td>' . $parkplatz . '</td>
                                            <td>' . $haustiere . '</td>
                                            <td>' . $kosten . '</td>
                                            <td>' . $res_status . '</td>
                                        </tr>';
                                }
                            }


                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
    include 'footer.php';
    ?>
</body>

</html>