<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../config.php');
session_start();

if (!isset($_SESSION["user_id"])) {
    header('location: login.php');
}

$id = (int) $_SESSION["user_id"];

$idmessage = $_GET['message'];


$querypote = $db->prepare('SELECT r.sender_id,u.pseudo,r.request_id,r.receiver_id,receiver_name FROM relationships r JOIN users u ON u.user_id = r.sender_id WHERE (r.status = "Ami" AND r.receiver_id = :receiver_id) OR (r.status = "Ami" AND r.sender_id = :sender_id)');
$querypote->bindParam(':receiver_id', $user['user_id']);
$querypote->bindParam(':sender_id', $id);
$querypote->execute();

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../style/favicon.ico" />
        <link href="../style/style.css" rel="stylesheet">
        <link href="../style/offre.css" rel="stylesheet">
        <script src="../script/checkbox.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../style/jquery-jvectormap-2.0.5.css">
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
        <script src="../script/jquery.js"></script>
        <title>Chat</title>
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
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item rubriquecolor">
                        Recherchez :
                    </li>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='../offres/list_offers.php'" type="button">Partenaires</button>
                    </form>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='../liste_joueurs.php'" type="button">Joueurs</button>
                    </form>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='../tournois/liste_tournoi.php'" type="button">Tournois</button>
                    </form>
                    <form class="form-inline">
                        <button class="btn btn-outline-light my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='../offres/new_offer.php'" type="button">Poster une annonce</button>
                    </form>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <button class="btn btn-outline-info my-2 my-sm-0"
                        onclick="location.href='../login_register/login.php'" type="button">Mon compte</button>
                </form>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row d-flex">
                <div class="col-2">
                    <h2>Vos amis</h2>
                    <hr>
                    <?php
                if ($querypote->rowCount() == 0) {
                    echo "Vous n'avez pas d'ami, pleurez";
                } else {
                    while ($row2 = $querypote->fetch()) {
                ?>
                    <p>
                        <?php echo $row2['receiver_name'];
                    }
                } ?>
                </div>
                <div class="col">
                    <p>lol</p>
                    <hr>
                </div>
            </div>
        </div>
    </body>