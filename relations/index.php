<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../config.php');
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../index.php");
}


$id = (int) $_SESSION["user_id"];

$getusername = $db->prepare('SELECT user_id,pseudo,prenom,nom FROM users WHERE user_id = :user_id');
$getusername->bindParam(':user_id', $id);
$getusername->execute();
$user = $getusername->fetch();

$queryfriend = $db->prepare('SELECT r.sender_id,u.pseudo,r.request_id FROM relationships r JOIN users u ON u.user_id = r.sender_id WHERE r.status = "En attente" AND r.receiver_id = :receiver_id');
$queryfriend->bindParam(':receiver_id', $user['user_id']);
$queryfriend->execute();

$querypote = $db->prepare('SELECT r.sender_id,u.pseudo,r.request_id,r.receiver_id,receiver_name FROM relationships r JOIN users u ON u.user_id = r.sender_id WHERE (r.status = "Ami" AND r.receiver_id = :receiver_id) OR (r.status = "Ami" AND r.sender_id = :sender_id)');
$querypote->bindParam(':receiver_id', $user['user_id']);
$querypote->bindParam(':sender_id', $id);
$querypote->execute();


if (isset($_GET['accept'])) {
    $ami = (int) $_GET['accept'];
    $queryaccept = $db->prepare('UPDATE relationships SET status = "Ami" WHERE request_id = :request_id');
    $queryaccept->bindParam(':request_id', $ami);
    $queryaccept->execute();
    header("location: index.php");
}

if (isset($_GET['refuse'])) {
    $ami = (int) $_GET['refuse'];
    $queryaccept = $db->prepare('DELETE FROM relationships WHERE request_id = :request_id');
    $queryaccept->bindParam(':request_id', $ami);
    $queryaccept->execute();
    header("location: index.php");
}

if (isset($_GET['delete'])) {
    $ami = (int) $_GET['delete'];
    $queryaccept = $db->prepare('DELETE FROM relationships WHERE request_id = :request_id');
    $queryaccept->bindParam(':request_id', $ami);
    $queryaccept->execute();
    header("location: index.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Profil de <?php echo $user['pseudo'] ?></title>

    <!-- Important ! -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../style/favicon.ico" />
    <meta charset="utf-8">
    <!-- -->

    <!-- Scripts au chargement de la page -->
    <script src="../script/checkbox.js" type="text/javascript"></script>
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

        </div>
    </nav>
    <!-- Fin barre de navigation -->

        <div class="container">
            <a href="../login_register/home.php" class="text-decoration-none text-dark">
            <h1> <img src=<?php echo "../login_register/" . $user['pseudo'] . "/" . $user['pseudo'] . ".png" ?> style="overflow:hidden; -webkit-border-radius:50px; -moz-border-radius:50px; border-radius:50px; height:90px; width:90px">
                <?php echo $user['prenom'] . " " . $user['nom'] ?></h1>
</a>
            <div class="row justify-content-center mb-4">
                <div class="col-auto text-center">
                    <p>Demandes d'amis</p>
                    <?php
                if ($queryfriend->rowCount() == 0) {
                    echo "Vous n'avez aucune demande d'ami";
                }
                while ($row = $queryfriend->fetch()) {
                ?>
                    <p>
                        <?php echo $row['pseudo'];
                        ?> veut devenir votre ami

                        <a name='accepter' href='index.php?accept=<?php echo $row['request_id'] ?>' class=' btn btn-primary
                    ml-4'>Accepter</a>

                        <a name='refuser' href='index.php?refuse=<?php echo $row['request_id'] ?>' class=' btn btn-danger
                    ml-4'>Refuser</a></p>
                    <?php } ?>
                </div>
            </div>
            <div class="row d-flex align-items-center mb-4" style="background: #457b9d;">
                <div class="col-sm-10 text-center vosamis">
                    <p>Vos amis :</p>
                </div>
                <div class="col-sm text-center">
                    <button type="button" class="btn btn-primary" onclick="location.href='../liste_joueurs.php'">Ajouter
                        un
                        ami</button>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto"> <?php
                                    if ($querypote->rowCount() == 0) {
                                        echo "Vous n'avez pas d'ami, pleurez";
                                    }
                                    while ($row2 = $querypote->fetch()) {
                                    ?> <div class="row">
                        <p>
                            <?php if ($row2['sender_id'] == $id) {
                                            echo $row2['receiver_name'];
                                        } else {
                                            echo $row2['pseudo'];
                                        } ?>

                            <a name='contact'
                                href='../relations/chat_prive.php?message=<?php if ($row2['receiver_id'] == $id) {
                                    echo $row2['sender_id']; } else {
                                 echo $row2['receiver_id']; }?>' class=' btn btn-success ml-4
                    mr-4'>Contacter</a>

                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button"
                                    data-toggle="dropdown">Options
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <a name="infos" class="dropdown-item"
                                        href='../infos_joueur.php?contact=<?php echo $row2['receiver_id'] ?>'>Informations</a>
                                    <a name="supprimer" class="dropdown-item"
                                        href='index.php?delete=<?php echo $row2['request_id'] ?>'>Supprimer</a>
                            </div>
                        </p>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <script src="../script/notification2.js"></script>
    </body>

</html>