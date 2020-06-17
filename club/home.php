<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["club_id"])) {
    header('location: login.php');
}

$id = (int) $_SESSION["club_id"];

$query = $db->prepare('SELECT * FROM clubs WHERE club_id = :club_id');
$query->bindParam(':club_id', $id);
$query->execute();

$user = $query->fetch();

if (file_exists(str_replace(" ", "_", $user['nom_club']))) {
    $img_src = str_replace(" ", "_", $user['nom_club']) . "/" . str_replace(" ", "_", $user['nom_club']) . ".png";
} else {
    $img_src = "default-club.png";
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="../style/favicon.ico" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../style/style.css" rel="stylesheet">
    <title>Accueil club</title>
</head>

<body>
    <nav class="navbar navbar-expand-xl navbar-dark" style="background-color: #264653; margin-bottom: 20px; height: 55px;">
        <a class="logo" href="../index.php">
            <div><img class="main" src="../style/SmashZone2.png" /><img class="ball" src="../style/SmashZoneIcon.png" />
            </div>
        </a>
        <button class="navbar-toggler ml-auto" type=" button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse rubriques" id="navbarNav">
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <img class="imgdeprofil" src=<?= $img_src ?>>
                <div class="overlay">
                    <a href="avatar.php">
                        <i class="material-icons text-dark md-dark text mr-2">edit</i>
                    </a>
                </div>
            </div>
            <div class="col-sm-6">
                <h1 class="text-left"> <?php echo $user['nom_club'] ?></h1>
                <hr>
                <div class="d-flex">
                    <i class="material-icons md-dark mr-2 text-dark">mail</i>
                    <p class="infosjoueurs">Adresse E-mail</p>
                    <p class="ml-auto"><?php echo $user['email'] ?></p>
                </div>
                <div class="d-flex">
                    <i class="material-icons md-dark mr-2 text-dark">location_city</i>
                    <p class="infosjoueurs">Ville</p>
                    <p class="ml-auto"><?php echo $user['ville'] ?></p>
                </div>
                <div class="d-flex">
                    <i class="material-icons md-dark mr-2 text-dark">location_city</i>
                    <p class="infosjoueurs">Adresse</p>
                    <p class="ml-auto"><?php echo $user['adresse'] ?></p>
                </div>
                <div class="d-flex">
                    <i class="material-icons md-dark mr-2 text-dark">money</i>
                    <p class="infosjoueurs">Code postal</p>
                    <p class="ml-auto"><?php echo $user['postal_code'] ?></p>
                </div>
                <div class="d-flex">
                    <i class="material-icons md-dark mr-2 text-dark">phone</i>
                    <p class="infosjoueurs">Téléphone</p>
                    <p class="ml-auto"><?php echo $user['telephone'] ?></p>
                </div>
                <div class="d-flex">
                    <i class="material-icons md-dark mr-2 text-dark">access_time</i>
                    <p class="infosjoueurs">Date de création</p>
                    <p class="ml-auto"><?php $date = new DateTime($user['date_creation']);
                                        echo $date->format('d/m/Y') ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <button type="button" onclick="location.href='../tournois/new_tournoi.php'" class="btn btn-success col-xl-6 mx-auto justify-content-center mb-2">Créer un nouveau Tournoi</button>
                <br>
                <br>
                <button type="button" onclick="location.href='update.php'" class="btn btn-light col-xl-6 mx-auto justify-content-center mb-2">Editer le club</button>
                <button type="button" onclick="location.href='mes_tournois.php'" class="btn btn-primary col-xl-6 mx-auto justify-content-center mb-2">Mes tournois</button>
                <button type="button" onclick="location.href='logout.php'" class="btn btn-danger col-xl-6 mx-auto justify-content-center">Se déconnecter</button>
            </div>
        </div>
</body>

</html>