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
</head>

<body>
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