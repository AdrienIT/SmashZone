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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <script src="../script/jquery.js"></script>
    <script src="../script/jquery-jvectormap-2.0.5.min.js"></script>
    <script src="../script/map_fr.js"></script>
    <script src="../script/dep_fr.js"></script>
    <link href="../style/tournoi_preview.css" rel="stylesheet">

    <link href="../style/style.css" rel="stylesheet">
    <link href="../style/home.css" rel="stylesheet">
    <link href="../style/notification.css" rel="stylesheet">
    <script>
        var notifs = <?php echo json_encode($all_notifs) ?>
    </script>
    <!-- Scripts au chargement de la page -->

</head>

<body onload="loadNotifi(notifs)">

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-xl navbar-dark mb-4" style="background-color: #264653; height: 55px;">
        <a class="navbar-brand main" href="../index.php">
            <img class="main" src="../style/SmashZone2.png" /><img class="ball" src="../style/SmashZoneIcon.png" />
        </a>

        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03" style="background-color: #264653;">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-right text-right">
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../offres/list_offers.php'"
                        type="button">Partenaires</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../liste_joueurs.php'"
                        type="button">Joueurs</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../tournois/liste_tournoi.php'"
                        type="button">Tournois</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../classement.php'"
                        type="button">Classement</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../liste_clubs.php'"
                        type="button">Clubs</button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-outline-light" onclick="location.href='../offres/new_offer.php'"
                        type="button">Poster une annonce</button>
                </li>
            </ul>

            <div class="icon" onclick="toggleNotifi()" id="notif"></div>
            <div class="notifi-box" id="box">
            </div>
            <button class="btn btn-outline-info my-2 my-sm-0" onclick="location.href='../login_register/login.php'"
                type="button"><?= $connect ?></button>
        </div>
    </nav>
    <!-- Fin barre de navigation -->

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
        <a href="inscription_tournoi.php?id=<?php echo $tournoi_id ?>"> s'inscrire </a>
    </body>

</html>