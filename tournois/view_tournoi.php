<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../config.php');
session_start();
if (!isset($_SESSION["user_id"])) {
    $connect = "Se connecter/S'inscrire";
} else {
    $connect = "Mon compte";
}

if (!isset($_SESSION["admin_id"])) {
    $connect = "Se connecter/S'inscrire";
} else {
    $connect = "Mon compte";
}

if (!isset($_SESSION["club_id"])) {
    $connect = "Se connecter/S'inscrire";
} else {
    $connect = "Mon compte";
}

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


if (file_exists(str_replace(" ", "_", "../club/" . $tournoi_infos['nom_club']))) {
    $img_src = str_replace(" ", "_", "../club/" . $tournoi_infos['nom_club']) . str_replace(" ", "_", "/" . $tournoi_infos['nom_club']) . ".png";
} else {
    $img_src = "default-club.png";
}

?>
<html>

<head>
    <title><?= $tournoi_infos['nom_tournoi'] ?></title>

    <!-- Important ! -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../style/favicon.ico" />
    <meta charset="utf-8">
    <!-- -->

    <!-- Scripts au chargement de la page -->
    <link href="../style/offre.css" rel="stylesheet">
    <script src="../script/checkbox.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../style/jquery-jvectormap-2.0.5.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="../script/jquery.js"></script>
    <script src="../script/jquery-jvectormap-2.0.5.min.js"></script>
    <script src="../script/map_fr.js"></script>
    <script src="../script/dep_fr.js"></script>

    <link href="../style/style.css" rel="stylesheet">
    <link href="../style/tournoi_preview.css" rel="stylesheet">
    <link href="../style/home.css" rel="stylesheet">
    <link href="../style/notification.css" rel="stylesheet">
    <!-- Scripts au chargement de la page -->

</head>

<body>

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-xl navbar-dark" style="background-color: #264653; height: 55px;">
        <a class="navbar-brand main" href="../index.php">
            <img class="main" src="../style/SmashZone2.png" /><img class="ball" src="../style/SmashZoneIcon.png" />
        </a>

        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03" style="background-color: #264653;">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-right text-right">
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../offres/list_offers.php'" type="button">Partenaires</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../liste_joueurs.php'" type="button">Joueurs</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../tournois/liste_tournoi.php'" type="button">Tournois</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../classement.php'" type="button">Classement</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../liste_clubs.php'" type="button">Clubs</button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-outline-light" onclick="location.href='../offres/new_offer.php'" type="button">Poster une annonce</button>
                </li>
            </ul>

            <div class="icon" onclick="toggleNotifi()" id="notif"></div>
            <div class="notifi-box" id="box">
            </div>
            <button class="btn btn-outline-info my-2 my-sm-0" onclick="location.href='../login_register/login.php'" type="button"><?= $connect ?></button>
        </div>
    </nav>
    <!-- Fin barre de navigation -->

    <div class="container d-flex justify-content-center">
        <div class="col-sm-10 aretrecir">
            <div class="row d-flex justify-content-center">
                <i class="material-icons md-dark text-dark iconeretreci">emoji_events</i>
                <h1><?= $tournoi_infos['nom_tournoi'] ?> </h1>
            </div>
            <div class="row d-flex justify-content-center">
                <img class="imgdeprofil" src=<?= $img_src ?>>
                <p class="mt-4">Organisé par <?= $tournoi_infos["nom_club"] ?></p>
            </div>
            <div class="row">
            </div>
            <hr class="relever">
            <div class="d-flex">
                <i class="material-icons md-dark mr-2 text-dark iconeretreci">location_city</i>
                <p class="infosjoueurs">Adresse</p>
                <p class="ml-auto"><?= $adresse ?></p>
            </div>
            <div class="d-flex">
                <i class="material-icons md-dark mr-2 text-dark iconeretreci">access_time</i>
                <p class="infosjoueurs">Date de fin</p>
                <p class="ml-auto"><?= $date_fin ?></p>
            </div>
            <div class="d-flex">
                <i class="material-icons md-dark mr-2 text-dark iconeretreci">face</i>
                <p class="infosjoueurs">Catégorie d'age</p>
                <p class="ml-auto"><?= $cat_age ?></p>
            </div>
            <div class="d-flex">
                <i class="material-icons md-dark mr-2 text-dark iconeretreci">phone</i>
                <p class="infosjoueurs">Numéro de téléphone</p>
                <p class="ml-auto"><?= $tournoi_infos["telephone"] ?></p>
            </div>
            <div class="d-flex">
                <i class="material-icons md-dark mr-2 text-dark iconeretreci">email</i>
                <p class="infosjoueurs">E-mail</p>
                <p class="ml-auto"><?= $tournoi_infos["email"] ?></p>
            </div>
            <a class="btn btn-primary text-light"> S'inscrire </a>
        </div>
    </div>
    </body>

    </html>