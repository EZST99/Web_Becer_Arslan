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
    <title>User Management</title>
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
                            <h2>User <b>Management</b></h2>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>EMail</th>
                            <th>Status</th>
                            <th>Reservierungen</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $users_query = $conn->query("SELECT vorname, nachname, user_status, email FROM users ORDER BY nachname ASC");

                        if ($users_query->num_rows > 0) {
                            // Iterate through each news item and display them
                            while ($row = $users_query->fetch_assoc()) {
                                $vorname = $row["vorname"];
                                $nachname = $row["nachname"];
                                $email = $row["email"];
                                $status = $row["user_status"];


                                echo '
                                <tr>
        <td>' . $nachname . ' ' . $vorname . '</td>
        <td>' . $email . '</td>';


                                if ($status == 'aktiv') {
                                    echo '<td><span class="status text-success">&bull;</span> ' . $status . '</td>
                                    
        <td><a href="admin_user_res.php?email=' . $email . '">Details</a></td>
                                    <td><a href="user_bearbeiten.php?email=' . $email . '">Bearbeiten</a></td>
            </tr>';
                                } else {
                                    echo '<td><span class="status text-danger">&bull;</span> ' . $status . '</td>
                                    
        <td><a href="admin_user_res.php?email=' . $email . '">Details</a></td>
                                    <td><a href="user_bearbeiten.php?email=' . $email . '">Bearbeiten</a></td>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>