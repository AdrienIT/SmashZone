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
    <title>Nouveau tournoi</title>
</head>

<body>
    <div class="creer_tournoi">
        <h1>Créer un nouveau tournoi</h1>
        <form method="post">
            <input type="text" required name="nom" placeholder="NOM TOURNOI">
            <br>
            <label for="start">Date de début :</label>
            <input type="date" id="start" name="date_debut" value="<?= $today ?>" min="1920-01-01" max="<?= $max_date ?>">
            <br>
            <label for="end">Date de fin</label>
            <input type="date" id="end" name="date_fin" value="<?= $today ?>" min="1920-01-01" max="<?= $max_date ?>">
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