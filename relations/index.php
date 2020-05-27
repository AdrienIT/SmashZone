<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../config.php');
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../index.php");
}


$id = (int) $_SESSION["user_id"];

$getusername = $db->prepare('SELECT pseudo FROM users WHERE user_id = :user_id');
$getusername->bindParam(':user_id', $id);
$getusername->execute();
$username = $getusername->fetch();

$query = $db->prepare('SELECT prenom,nom FROM users WHERE user_id = :user_id');
$query->bindParam(':user_id', $id);
$query->execute();

$user = $query->fetch();

$queryfriend = $db->prepare('SELECT r.sender_id,u.pseudo,r.request_id FROM relationships r JOIN users u ON u.user_id = r.sender_id WHERE r.status = "En attente" AND r.receiver_name = :receiver_name');
$queryfriend->bindParam(':receiver_name', $username['0']);
$queryfriend->execute();

$querypote = $db->prepare('SELECT r.sender_id,u.pseudo,r.request_id FROM relationships r JOIN users u ON u.user_id = r.sender_id WHERE r.status = "Ami" AND r.receiver_name = :receiver_name');
$querypote->bindParam(':receiver_name', $username['0']);
$querypote->execute();

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
                        onclick="location.href='../login_register/login.php'" type="button">Se
                        connecter/S'inscrire</button>
                </form>
            </div>
        </nav>
        <div class="container">
            <h1> <img src=<?php echo "./" . $user['prenom'] . "/" . $user['prenom'] . ".png" ?>
                    style="overflow:hidden; -webkit-border-radius:50px; -moz-border-radius:50px; border-radius:50px; height:90px; width:90px">
                <?php echo $user['prenom'] . " " . $user['nom'] ?></h1>
            <button type="button" class="btn btn-primary" onclick="location.href='add_friend.php'">Ajouter un
                ami</button>
            <p>Demandes d'amis</p>
            <?php if(empty($queryfriend)) {
                echo "<p> Aucune demande d'ami</p>";
            } else {
                ?>
            <p> <?php 
            while ($row = $queryfriend->fetch()) {
            $senderid = $row['2'];
            echo $row['pseudo'];
            echo " souhaite devenir votre ami <form action='' method='post'>
            <button name='accepter' type='submit' class='btn btn-primary ml-4'>Accepter</button>";
            echo "<button name='refuser' type='submit' class='btn btn-danger ml-4'>Refuser</button>  </form>";
            var_dump($senderid);
            }  }

            if (isset($_POST["accepter"])) {
                echo $senderid;
            }

            if(empty($querypote)) {
                echo "<p> Vous n'avez pas d'ami, pleurez</p>";
            } else {
                ?>
                <p> <?php 
            while ($row2 = $querypote->fetch()) {
            echo $row2['pseudo'];
            echo "<button name='contacter' type='submit' class='btn btn-info ml-4'>Contacter</button>";
            echo "<button name='options' type='submit' class='btn btn-light ml-4'>Options</button>  </form>";
            }  }
            ?>
        </div>
    </body>

</html>