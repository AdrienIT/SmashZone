<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../config.php');
session_start();
$tournoi_id = $_GET["id"];
$get_infos = $db->prepare("SELECT * FROM tournois t INNER JOIN clubs c ON (t.club_id = c.club_id) WHERE t.tournoi_id = :id");
$get_infos->bindParam(":id", $tournoi_id);
$get_infos->execute();
$tournoi_infos = $get_infos->fetch();
if ($tournoi_infos['age_min'] == 3 && $tournoi_infos['age_max'] == 100) {
    $cat_age = "Tout âge";
} else if ($tournoi_infos['age_min'] == 3) {
    $cat_age = "- de " . $tournoi_infos['age_max'] . " ans";
} else if ($tournoi_infos['age_max'] == 100) {
    $cat_age = $tournoi_infos['age_min'] . "+";
} else {
    $cat_age = $tournoi_infos['age_min'] . " - " . $tournoi_infos['age_max'];
}
setlocale(LC_TIME, "fr_FR");
$date_debut = strftime("%A %d %B %G", strtotime($tournoi_infos["date_debut"]));
$date_fin = strftime("%A %d %B %G", strtotime($tournoi_infos["date_fin"]));

$adresse = $tournoi_infos["adresse"] . " " . $tournoi_infos["postal_code"] . " " . $tournoi_infos["ville"];
?>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $tournoi_infos['nom_tournoi'] ?></title>
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
        <link href="../style/tournoi_preview.css" rel="stylesheet">
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
            <div class="collapse navbar-collapse rubriques" id="navbarNav">
                <ul class=" navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item rubriquecolor">
                        Recherchez :
                    </li>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='list_offers.php'" type="button">Partenaires</button>
                    </form>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='../liste_joueurs.php'" type="button">Joueurs</button>
                    </form>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='recherchejouer.php'" type="button">Tournois</button>
                    </form>
                </ul>
            </div>
        </nav>

        <h1><?= $tournoi_infos['nom_tournoi'] ?> : </h1>

        <h2>Informations :</h2>
        <ul>
            <li>Club organisateur : <?= $tournoi_infos["nom_club"] ?></li>
            <li>Adresse : <?= $adresse ?></li>
            <li>Date de début : <?= $date_debut ?></li>
            <li>Date de fin : <?= $date_fin ?></li>
            <li>Catégorie d'age : <?= $cat_age ?></li>
        </ul>
        <h2>Contacter : </h2>
        <ul>
            <li>Téléphone : <?= $tournoi_infos["telephone"] ?></li>
            <li>Email : <?= $tournoi_infos["email"] ?></li>
        </ul>
        <a href="">S'inscrire</a>
    </body>

</html>