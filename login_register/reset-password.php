<?php
include_once '../config.php';


if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $query = $db->prepare('SELECT email FROM users WHERE email = :email');
    $query->bindParam(':email', $email);
    $query->execute();
    if ($query->rowCount() > 0) {

        #Section token + lien
        $token = bin2hex(openssl_random_pseudo_bytes(16));

        $url = "http://localhost/smashzone/login_register/change_password.php?token=$token";

        #Section mail

        $mail_smashzone = "smashzone.ynov@gmail.com";

        $to_email = $email;
        $sujet = "Recupération du mot de passe";
        $body = "Pour changer votre mot de passe, merci de cliquer sur ce lien :" . $url;
        $headers = "From: $mail_smashzone";
        if (mail($to_email, $sujet, $body, $headers)) {
            echo "<pre>Un email a été envoyé avec un lien de récupération de mot de passe à cette adresse : $to_email</pre>";
            $query2 = $db->prepare('INSERT INTO reset_password(email,token) VALUES (:email,:token)');
            $query2->bindParam(':email', $email);
            $query2->bindParam(':token', $token);
            $query2->execute();
        } else {
            echo "<pre>L'envoie de mail a échoué</pre>";
        }
    } else {
        echo "<pre>email non disponible</pre>";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../style/favicon.ico" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
            integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../style/style.css" rel="stylesheet">
        <meta name="viewport" content="width=, initial-scale=1.0">
        <title>Mot de passe oublié</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-xl navbar-dark"
            style="background-color: #264653; margin-bottom: 20px; height: 55px;">
            <a class="logo" href="../index.php">
                <i class="material-icons" style="font-size: 40px; color: white;">home</i>
            </a>

            <button class="navbar-toggler ml-auto" type=" button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse rubriques" id="navbarNav">
                <form class="form-inline ml-auto p-2">
                    <button class="btn btn-outline-success my-2 my-sm-0"
                        onclick="location.href='login_register/login.php'" type="button">Connexion clubs</button>
                </form>
                <form class="form-inline">
                    <button class="btn btn-outline-danger my-2 my-sm-0" onclick="location.href='../admin/index.php'"
                        type="button">Administration</button>
                </form>
            </div>
        </nav>
        <div class="container">
            <div class="col-sm">
                <h1>Réinitialiser le mot de passe</h1>
                <p class="d-flex justify-content-center">Un e-mail vous sera envoyé avec votre nouveau mot de passe</p>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row justify-content-center">
                        <label>Mail</label>
                    </div>
                    <div class="row mb-4 justify-content-center">
                        <input class="form-control col-xl-4" required type="text" name="email">
                    </div>
                    <div class="row mb-4 justify-content-center">
                        <button name="submit" type="submit" class="btn btn-primary">Recevoir mon mot de passe</button>
                    </div>
                    <a class="row justify-content-center" href="login.php">Annuler</a>
                </form>
            </div>
        </div>
        </div>

    </body>

</html>