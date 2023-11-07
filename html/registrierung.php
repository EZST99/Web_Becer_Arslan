<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Registrierung</title>
    <style>
        body {
            background: rgb(214, 198, 180);
        }

        .form-container {
            border: 2px solid rgba(108, 73, 9, 0.671);
            border-radius: 10px;
            padding: 10px;
            /* Verkleinert den Innenabstand der Box */
            margin-top: 20px;
            background: white;
            box-shadow: 12px 12px 22px rgb(33, 32, 32);
            max-width: 800px;
            /* Erhöht die maximale Breite des Containers */
            margin: 0 auto;
            /* Zentriert den Container horizontal */
        }

        .img-fluid {
            width: 100%;
            /* Das Bild nimmt 100% der Breite des Elternelements ein */
            height: auto;
            /* Die Höhe des Bildes passt sich automatisch an */
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            margin: 0;
            padding: ;
        }

        .form-content {
            padding: 20px;
            /* Innenabstand für den Inhalt innerhalb der Box */
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
    <?php
    include 'nav.php';
    ?>
    <section class="Form my-4 mx-auto">
        <form action="/action_page.php" class="was-validated">
            <div class="container-fluid text-center">
                <div class="row no-gutters">
                    <div class="col-lg-12">
                        <div class="form-container"> <!-- Hier wird die Box um das gesamte Formular hinzugefügt -->
                            <img src="../images/Old_Lesbians.jpg" class="img-fluid" alt="Gäste Bild">
                            <!-- Das Bild wird ganz oben innerhalb der Box platziert -->
                            <div class="p-3"> <!-- Der restliche Inhalt, der unterhalb des Bildes erscheinen soll -->
                                <h1 class="font-weight-bold py-3">Hotel Helios</h1>
                                <h4>Account registrieren</h4>
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <input id="anrede" type="text" class="form-control my-3 p-4"
                                                    placeholder="Anrede" required>
                                                <div class="valid-feedback"></div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <input id="vorname" type="text" class="form-control my-3 p-4"
                                                    placeholder="Vorname" required>
                                                <div class="valid-feedback"></div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <input id="nachname" type="text" class="form-control my-3 p-4"
                                                    placeholder="Nachname" required>
                                                <div class="valid-feedback"></div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <input id="email" type="text" class="form-control my-3 p-4"
                                                    placeholder="E-Mail" required>
                                                <div class="valid-feedback"></div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <input id="geburtsdatum" type="date" class="form-control my-3 p-4"
                                                    required>
                                                <div class="valid-feedback"></div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <input id="username" type="text" class="form-control my-3 p-4"
                                                    placeholder="Username" required>
                                                <div class="valid-feedback"></div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <input id="password" type="password" class="form-control my-3 p-4"
                                                    placeholder="Passwort" required>
                                                <div class="valid-feedback"></div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <input id="repassword" type="password" class="form-control my-3 p-4"
                                                    placeholder="Passwort wiederholen" required>
                                                <div class="valid-feedback"></div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <button type="button" class="btn1 mt-3 mb-5">Registrieren</button>
                                    </div>
                                </form>
                                <a href="#">Passwort vergessen?</a>
                                <p>Noch gar keinen Account? <a href="registrierung.html">Registriere dich hier</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</body>

</html>