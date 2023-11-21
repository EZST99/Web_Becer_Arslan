<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
    <style>
        .error {
            color: #FF0000;
        }

        * {
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

    if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST["username"]) && isset($_POST["password"])) {
        if ($_POST["username"] == "user" && $_POST["password"] == "123") {
            setcookie("loginCookie", $_POST["username"], time()+3600);
            header("Location: index.php");
            exit;
        }
    }

    $usernameErr = $passwordErr = "";
    $username = $password = "";

    //Input fields validation  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (empty($_POST["username"])) {
            $usernameErr = "Bitte ausfüllen!";
        } else {
            $username = test_input($_POST["username"]);
        }

        if (empty($_POST["password"])) {
            $passwordErr = "Bitte ausfüllen!";
        } else {
            $password = test_input($_POST["password"]);
        }
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

   /* session_start();
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            if ($_POST["username"] == $_POST["password"]) {
                // Login erfolgreich
                $_SESSION["usernameSession"] = $_POST["username"];
            } else {
                // Login nicht erfolgreich
                echo "Schleich dich!";
            }
        }*/
    ?>
    
    <section class="Form my-4 mx-5">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-5 p-0">
                        <img src="../images/Hotel_Login.png" class="img-fluid p-0 m-0" alt="Gäste Bild">
                    </div>
                    <div class="col-lg-7 px-5 pt-5">
                        <h1 class="font-weight-bold py-3">Hotel Helios</h1>
                        <h4>Account anmelden</h4>
                        <p><span class="error"></span></p>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="form-row">
                                <div class="col-lg-7">
                                    <input name ="username" type="text" placeholder="Username" class="form-control my-3 p-4">
                                    <span class="error">
                                        <?php echo $usernameErr; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-7">
                                    <input name ="password" type="password" placeholder="******" class="form-control my-3 p-4">
                                    <span class="error">
                                        <?php echo $passwordErr; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-7">
                                    <button type="submit" class="btn1 mt-3 mb-5">Login</button>
                                </div>
                            </div>
                            <a href="#">Passwort vergessen?</a>
                            <p>Noch gar keinen Account? <a href="registrierung.php">Registriere dich hier</a></p>
                        </form>
                    </div>
                </div>
        
            </div>
    </section>

    <?php
    if (isset($_POST['submit'])) {
        if ($usernameErr == "" && $passwordErr == "") {
            echo "<h3 color = #FF0001> <b>Sie haben sich erfolgreich eingeloggt!</b> </h3>";
            echo "<h2>Your Input:</h2>";
            echo "Username: " . $username;
            echo "<br>";
            echo "Password: " . $password;
            echo "<br>";
        } else {
            echo "<h3> <b>Sie haben nicht alle Felder korrekt ausgefüllt!</b> </h3>";
        }
    }
    ?>

</html>

