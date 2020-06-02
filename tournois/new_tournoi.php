<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../config.php');
session_start();
if (!isset($_SESSION["club_id"])) {
    header("Location: ..login/login.php");
}
$today = new DateTime(date("Y-m-d"));
$today = $today->format("Y-m-d");
$max_date = new DateTime(date("Y-m-d"));
$max_date->add(new DateInterval("P1Y"));
$max_date = $max_date->format("Y-m-d");
$_SESSION["club_id"] = 1;

if (isset($_POST["submit"])) {
    if ($_POST["date_debut"] >= $_POST["date_fin"]) {
        $msg = "Vos dates ne sont pas cohérentes !";
    } else if ($_POST["age_min"] > $_POST["age_max"]) {
        $msg = "Votre catégorie d'âge n'est pas cohérente !";
    } else {
        $insert = $db->prepare("INSERT INTO tournois (club_id, nom_tournoi, date_debut, date_fin, age_min, age_max) VALUES (:id, :nom, :date_debut, :date_fin, :age_min, :age_max)");
        $insert->bindParam(":id", $_SESSION["club_id"]);
        $insert->bindParam(":nom", $_POST["nom"]);
        $insert->bindParam(":date_debut", $_POST["date_debut"]);
        $insert->bindParam(":date_fin", $_POST["date_fin"]);
        $insert->bindParam(":age_min", $_POST["age_min"]);
        $insert->bindParam(":age_max", $_POST["age_max"]);
        $insert->execute();
        $msg = "Votre offre a été publiée avec succès !";
    }
}
?>

<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <link href="../style/style.css" rel="stylesheet">
        <title>Nouveau tournoi</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-xl navbar-dark"
            style="background-color: #264653; margin-bottom: 20px; height: 55px;">
            <a class="logo" href="../index.php">
                <div><img class="main" src="../style/SmashZone2.png" /><img class="ball"
                        src="../style/SmashZoneIcon.png" />
                </div>
            </a>
            <button class="navbar-toggler ml-auto" type=" button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> </button>
            </div>
            <form class="form-inline my-2 my-lg-0">
                <button class="btn btn-outline-info my-2 my-sm-0" onclick="location.href='login_register/index.php'"
                    type="button">Se
                    connecter/S'inscrire</button>
            </form>
            <form class="form-inline my-2 my-lg-0">
                <button class="btn btn-outline-info my-2 my-sm-0" onclick="location.href='login_register/index.php'"
                    type="button">Se
                    connecter/S'inscrire</button>
            </form>
        </nav>

        <div class="creer_tournoi">
            <h1>Créer un nouveau tournoi</h1>
            <form method="post">
                <input type="text" required name="nom" placeholder="NOM TOURNOI">
                <br>
                <label for="start">Date de début :</label>
                <input type="date" id="start" name="date_debut" value="<?= $today ?>" min="1920-01-01"
                    max="<?= $max_date ?>">
                <br>
                <label for="end">Date de fin</label>
                <input type="date" id="end" name="date_fin" value="<?= $today ?>" min="1920-01-01"
                    max="<?= $max_date ?>">
                <br>
                <label for="age_min">Âge minimum :</label>
                <input type="number" id="age_min" name="age_min" min="3" max="100" value="3">
                <label for="age_max">Âge maximum :</label>
                <input type="number" id="age_max" name="age_max" min="3" max="100" value="100">
                <br>
                <button name="submit">Créer</button>
                <?php if (isset($msg)) { ?>
                <p><?= $msg ?></p>
                <?php } ?>
        </div>
        </form>
        </div>
    </body>

</html>