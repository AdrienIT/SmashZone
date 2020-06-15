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
                    <button class="btn btn-outline-light my-2 my-sm-0"
                        onclick="location.href='../login_register/login.php'" type="button">Connexion
                        utilisateur</button>
                </form>
                <form class="form-inline">
                    <button class="btn btn-outline-danger my-2 my-sm-0" onclick="location.href='../admin/index.php'"
                        type="button">Administration</button>
                </form>
            </div>
        </nav>

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

                <button name="submit" type="submit" class="btn btn-danger btn-lg mb-3">Se
                    connecter</button> <br>
            </form>
            <a href="register.php">Créer une page club</a> <br>
            <a href="reset-password.php">Mot de passe oublié ?</a>
        </div>
    </body>

</html>