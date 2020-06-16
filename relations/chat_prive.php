<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../config.php');
session_start();

if (!isset($_SESSION["user_id"])) {
    header('location: ../login_register/login.php');
}

$id = (int) $_SESSION["user_id"];

$idmessage = $_GET['message'];

$query = $db->prepare('SELECT prenom,nom,pseudo,email,ville,postal_code,date_creation,telephone,date_naissance,classement FROM users WHERE user_id = :user_id');
$query->bindParam(':user_id', $id);
$query->execute();
$user = $query->fetch();

$querypote = $db->prepare('SELECT r.send_id,u.pseudo,r.request_id,r.receiver_id,receiver_name FROM relationships r JOIN users u ON u.user_id = r.send_id WHERE (r.status = "Ami" AND r.receiver_id = :receiver_id) OR (r.status = "Ami" AND r.send_id = :send_id)');
$querypote->bindParam(':send_id', $user['user_id']);
$querypote->bindParam(':receiver_id', $id);
$querypote->bindParam(':receiver_id', $user['user_id']);
$querypote->bindParam(':send_id', $id);
$querypote->execute();

$querymessage = $db->prepare('SELECT * FROM messages WHERE (message_sender = :message_sender AND message_receiver = :message_receiver) OR (message_sender = :message_receiver AND message_receiver = :message_sender)');
$querymessage->bindParam(':message_sender', $id);
$querymessage->bindParam(':message_receiver', $idmessage);
$querymessage->execute();
$fetchmessage = $querymessage->fetchAll();

if (isset($_POST['messagebox'])) {
    $message = htmlspecialchars($_POST['messagebox']);
    $insermessage = $db->prepare('INSERT INTO messages (message_sender,message_receiver,content) VALUES (:message_sender,:message_receiver,:content) ORDER BY message_time');
    $insermessage->bindValue(':message_sender', $id);
    $insermessage->bindValue(':message_receiver', $idmessage);
    $insermessage->bindValue(':content', $message);
    $insermessage->execute();
    header("Refresh:0");
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
            <button class="btn btn-outline-info my-2 my-sm-0" onclick="location.href='../login_register/login.php'"
                type="button">Mon compte</button>

        </div>
    </nav>
    <!-- Fin barre de navigation -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                    <h2>Vos amis</h2>
                    <hr>
                    <?php
                if ($querypote->rowCount() == 0) {
                    echo "Vous n'avez pas de discussion active, pleurez";
                } else {
                    while ($row2 = $querypote->fetch()) {
                ?>
                    <div class="row pl-2">
                        <a class='listepotes text-decoration-none'
                            href='chat_prive.php?message=<?php if ($row2['3'] == $id) {
                                echo $row2['0']; 
                            } else { echo $row2['3']; }?>'>
                            <?php if ($row2['receiver_name'] == $user['pseudo']) { 
                                echo  $row2['pseudo']; } else {
                                echo $row2['receiver_name']; } ?> </a> </div>
                    <?php }
                } ?>
                </div>

                <div class="col">
                    <p>Discussion</p>
                    <hr>
                    <?php foreach ($fetchmessage as $m) {
                    $contenu = $m['content'];
                    if ($m['message_sender'] == $id) { ?>
                    <div class="col">
                        <?php

                            echo "<p class='messagesender mb-2 mt-2'>" . $contenu . "</p>"; ?>
                    </div>
                    <?php
                    } else { ?>
                    <div class="col"> <?php echo "<p class='messagereceiver mb-2 mt-2'>" . $contenu . "</p>"; ?>
                    </div>
                    <?php }
                } ?>
                    <form class="input-group" method="post">
                        <input required type="messagebox" class="form-control" name="messagebox"
                            aria-describedby="messagebox" placeholder="Message">
                        <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                    <small id="messageNotice" class="form-text text-muted">Ne partagez jamais votre mot de passe
                        avec
                        qui que ce soit.</small>
                </div>
            </div>
        </div>
        <script src="../script/notification2.js"></script>
    </body>