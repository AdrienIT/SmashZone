<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../config.php');
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../index.php");
    $connect = "Se connecter/S'inscrire";
} else {
    $connect = "Mon compte";
}



$id = (int) $_SESSION["user_id"];


if (isset($_POST['name'])) {

    $search = $_POST['name'];
    $messagetrouver = "Une demande d'ami a été envoyée";
    $messagepastrouver = "Cet utilisateur n'existe pas";
    $messagedejaami = "Cet utilisateur est déjà votre ami !";

    $querydejaami = $db->prepare('SELECT receiver_id FROM relationships WHERE receiver_id = :receiver_id');
    $querydejaami->bindParam(':receiver_id', $recherche['user_id']);
    $querydejaami->execute();
    $queryami = $querydejaami->fetch();
    // if ($queryami == 0) {
    //     echo "Cet utilisateur est déjà votre ami !";
    // } else {

    $query = $db->prepare('SELECT user_id,pseudo,email FROM users WHERE email = :email OR pseudo = :pseudo');
    $query->bindParam(':email', $search);
    $query->bindParam(':pseudo', $search);
    $query->execute();
    $recherche = $query->fetch();

    if ($recherche > 0) {
        echo "<pre> $messagetrouver </pre>";

        $username = $_SESSION["user_id"];

        $addfriend = $db->prepare('INSERT INTO relationships (sender_id,receiver_id,status) VALUES (:sender_id,:receiver_id,"En attente")');
        $addfriend->bindParam(':sender_id', $id);
        $addfriend->bindParam(':receiver_id', $recherche['user_id']);
        $addfriend->execute();
    } else {
        echo "<pre> $messagepastrouver </pre>";
    }
}

?>

<!DOCTYPE html>
<html>

    <head>
        <title>SmashZone</title>
        <link rel="icon" href="../style/favicon.ico" />
        <meta charset="utf-8">
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
    </head>

    <body>
        <nav class="navbar navbar-expand-xl navbar-dark"
            style="background-color: #264653; margin-bottom: 20px; height: 55px;">
            <a class="logo" href="index.php">
                <div><img class="main" src="../style/SmashZone2.png" /><img class="ball"
                        src="../style/SmashZoneIcon.png" />
                </div>
            </a>
            <button class="navbar-toggler ml-auto" type=" button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse rubriques" id="navbarNav">
                <ul class=" navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-inline rubriquecolor">
                        Effectuer une recherche :
                    </li>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='../offres/list_offers.php'" type="button">Partenaires</button>
                    </form>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='recherchejouer.php'" type="button">Joueurs</button>
                    </form>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='recherchejouer.php'" type="button">Tournois</button>
                    </form>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <button class="btn btn-outline-info my-2 my-sm-0"
                        onclick="location.href='../login_register/login.php'" type="button"><?= $connect ?></button>
                </form>
            </div>
        </nav>
        <div class="container">
            <h1>Ajouter un ami</h1>
            <p>Entrez le pseudo ou l'adresse email de la personne à ajouter :</p>
            <form action="" method="post">
                <input required type="text" name="name" class="form-control">
                <button name="submit" type="submit" class="btn btn-primary">Ajouter aux amis</button>
            </form>
        </div>
    </body>

</html>