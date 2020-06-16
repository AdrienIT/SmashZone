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
        $msg = "Votre tournoi a été crée avec succès !";
    }
}
?>

<head>
    <title>Liste des tournois</title>

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
        <a class="navbar-brand main" href="../club/home.php">
            <img class="main" src="../style/SmashZone2.png" /><img class="ball" src="../style/SmashZoneIcon.png" />
        </a>

        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <!-- Fin barre de navigation -->

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="creer_tournoi">
                <h1 class="mb-4">Créer un nouveau tournoi</h1>
                <form method="post">
                    <div class="row mb-4">
                        <label for="start">Nom du tournoi</label>
                        <input type="text" required name="nom" class="form-control">
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <label for="start">Date de début :</label>
                            <input type="date" id="start" name="date_debut" value="<?= $today ?>" min="1920-01-01" class="form-control" max="<?= $max_date ?>">
                        </div>
                        <div class="col">
                            <label for="end">Date de fin</label>
                            <input type="date" id="end" name="date_fin" value="<?= $today ?>" min="1920-01-01" class="form-control" max="<?= $max_date ?>">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <label for="age_min">Âge minimum :</label>
                            <input type="number" id="age_min" name="age_min" min="3" max="100" value="3" class="form-control">
                        </div>
                        <div class="col">
                            <label for="age_max">Âge maximum :</label>
                            <input type="number" id="age_max" name="age_max" min="3" max="100" value="100" class="form-control">
                        </div>
                    </div>
                    <button class="btn btn-success btn-block" name="submit">Créer</button>
                </form>

                <?php if (isset($msg)) { ?>
                    <p><?= $msg ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>