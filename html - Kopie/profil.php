<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>News</title>
</head>

<body>
    <?php
    include 'nav.php';
    ?>


    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">Edogaru</span><span class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Name</label>
                            <input name="name" type="name" class="form-control" placeholder="Vorname">
                        </div>
                        <div class="col-md-6"><label class="labels">Surname</label>
                            <input name="name" type="name" class="form-control" placeholder="Nachname">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Name</label>
                            <input name="username" type="name" class="form-control" placeholder="Username">
                        </div>
                        <div class="col-md-6"><label class="labels">Password</label>
                            <input name="password" type="password" class="form-control" placeholder="******">
                        </div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
</body>

</html>