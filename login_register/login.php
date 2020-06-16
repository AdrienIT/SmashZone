<?php
include_once '../config.php';
session_start();
if (isset($_SESSION["user_id"])) {
    header('location: home.php');
}

if (isset($_POST["submit"])) {
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $password = md5($_POST["password"]);

    var_dump($pseudo);

    $query1 = $db->prepare("SELECT * FROM users WHERE pseudo = :pseudo AND password = :password");
    $query1->bindParam(':pseudo', $pseudo);
    $query1->bindParam(':password', $password);
    $query1->execute();
    $user = $query1->fetch();


    if (count($user) > 0) {
        $_SESSION['user_id'] = $user['user_id'];
        header('Location: home.php');
    } else {
        $err = "<pre>C'est con frere</pre>";
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>

    <!-- Important ! -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../style/favicon.ico" />
    <meta charset="utf-8">
    <!-- -->

    <!-- Scripts au chargement de la page -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="../style/style.css" rel="stylesheet">
    <link href="../style/home.css" rel="stylesheet">
    <link href="../style/notification.css" rel="stylesheet">
    <script>
        var notifs = <?php echo json_encode($all_notifs) ?>
    </script>
    <!-- Scripts au chargement de la page -->

</head>

<body>

   <!-- Barre de navigation -->
   <nav class="navbar navbar-expand-sm navbar-dark mb-4" style="background-color: #264653; height: 55px;">
        <a class="navbar-brand main" href="../index.php">
            <i class="material-icons" style="font-size: 40px; color: white;">home</i>
        </a>

        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03" style="background-color: #264653;">

            <button class="btn btn-outline-light my-2 my-sm-0 mr-2 ml-auto" onclick="location.href='register.php'"
                type="button">S'inscrire</button>
            <button class="btn btn-outline-success my-2 my-sm-0 mr-2" onclick="location.href='../club/login.php'"
                type="button">Connexion
                club</button>
            <button class="btn btn-outline-danger my-2 my-sm-0" onclick="location.href='../admin/index.php'"
                type="button">Administration</button>
        </div>
        </nav>
    <!-- Fin barre de navigation -->

    <main>
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-sm">
                    <div class="logo2 d-flex justify-content-center">
                        <img class="main2 " src="../style/SmashZone1.png" />
                        <img class="ball2" src="../style/SmashZoneIcon.png" />
                    </div>
                    <h1 class="login-title">Connexion</h1>
                    <form method="post">
                        <div class="form-group">
                            <label for="email">Nom d'utilisateur / Email</label>
                            <input required type="text" name="pseudo" class="form-control">
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">Mot de passe</label>
                            <input required type="password" name="password" class="form-control">
                        </div>
                        <div class="d-flex justify-content-center flex-column ">
                            <button name="submit" class="btn btn-primary btn-lg mb-2">Se
                                connecter</button>
                    </form>
                    <?php if (isset($user)) { echo $err; }?>
                    <a href="reset-password.php" class="forgot-password-link">Mot de passe oublié ?</a>
                    <p class="login-wrapper-footer-text">Pas encore de compte ? <a href="register.php"
                            class="text-reset">S'inscrire</a></p>
                </div>
            </div>
        </div>
    </main>

    </body>

    </html>