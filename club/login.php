<?php
include_once '../config.php';
session_start();
if (isset($_SESSION["club_id"])) {
	header('location: home.php');
}

if (isset($_POST["submit"])) {
	$nom_club = htmlspecialchars($_POST["nom_club"]);
	$password = md5($_POST["password"]);

	$query1 = $db->prepare("SELECT * FROM clubs WHERE nom_club = ? AND password = ? ");
	$query1->execute([$nom_club, $password]);
	$user = $query1->fetch();


	if (count($user) > 0) {
		$_SESSION['club_id'] = $user['club_id'];
		header('Location: home.php');
	} else {
		$err = "nom_club / Password incorrect";
		echo $err;
	}
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Connexion club</title>

    <!-- Important ! -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="style/favicon.ico" />
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

            <button class="btn btn-outline-light my-2 my-sm-0 mr-2 ml-auto" onclick="location.href='../login_register/login.php'"
                type="button">Connexion
                utilisateur</button>
            <button class="btn btn-outline-danger my-2 my-sm-0" onclick="location.href='../admin/index.php'"
                type="button">Administration</button>
        </div>
        </nav>
    <!-- Fin barre de navigation -->

        <div class="container text-center">
            <h1 class="mb-4">Connexion club</h1>
            <form method="post">
                <?php if (isset($err)) : ?>
                <div><?php echo $err ?></div>
                <?php endif ?>
                <div class="form-group col-sm-6 mx-auto">
                    <label>Nom du club</label>
                    <input class="form-control" required type="text" name="nom_club">
                </div>
                <div class="form-group col-sm-6 mx-auto">
                    <label>Mot de passe</label>
                    <input class="form-control" required type="password" name="password">
                </div>

                <button name="submit" type="submit" class="btn btn-success btn-lg mb-3">Se
                    connecter</button> <br>
            </form>
            <a href="register.php">Créer une page club</a> <br>
            <a href="reset-password.php">Mot de passe oublié ?</a>
        </div>
    </body>

</html>