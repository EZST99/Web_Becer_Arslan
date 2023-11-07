<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background: rgb(214, 198, 180);
        }

        .row {
            background: white;
            border-radius: 30px;
            box-shadow: 12px 12px 22px rgb(33, 32, 32);
        }

        .img-fluid {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
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
    <section class="Form my-4 mx-5">
        <form action="/action_page.php" class="was-validated">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-5 p-0">
                        <img src="../images/Hotel_Login.png" class="img-fluid p-0 m-0" alt="Gäste Bild">
                    </div>
                    <div class="col-lg-7 px-5 pt-5">
                        <h1 class="font-weight-bold py-3">Hotel Helios</h1>
                        <h4>Account anmelden</h4>
                        <form>
                            <div class="form-row">
                                <div class="col-lg-7">
                                    <input type="username" placeholder="Username" class="form-control my-3 p-4"
                                        required>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">Bitte ausfüllen.</div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-7">
                                    <input type="password" placeholder="******" class="form-control my-3 p-4" required>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">Bitte ausfüllen.</div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-7">
                                    <button type="button" class="btn1 mt-3 mb-5">Login</button>
                                </div>
                            </div>
                            <a href="#">Passwort vergessen?</a>
                            <p>Noch gar keinen Account? <a href="registrierung.html">Registriere dich hier</a></p>
                        </form>
                    </div>
                </div>
            </div>
    </section>

</html>