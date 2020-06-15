<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';
session_start();
$all_notifs = "none";
if (!isset($_SESSION["user_id"])) {
    $connect = "Se connecter/S'inscrire";
} else {
    $connect = "Mon compte";
    $query = $db->prepare("SELECT n.*, u.pseudo FROM notifications n INNER JOIN users u ON (n.id_link = u.user_id) WHERE n.vu = 0 ORDER BY n.date ASC");
    $query->execute();
    $all_notifs = $query->fetchAll();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>SmashZone</title>

    <!-- Important ! -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="style/favicon.ico" />
    <meta charset="utf-8">
    <!-- -->

    <!-- Scripts au chargement de la page -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="style/style.css" rel="stylesheet">
    <link href="style/home.css" rel="stylesheet">
    <link href="style/notification.css" rel="stylesheet">
    <script>
        var notifs = <?php echo json_encode($all_notifs) ?>
    </script>
    <!-- Scripts au chargement de la page -->

</head>

<body onload="loadNotifi(notifs)">

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-xl navbar-dark" style="background-color: #264653; height: 55px;">
        <a class="navbar-brand main" href="index.php">
            <img class="main" src="style/SmashZone2.png" /><img class="ball" src="style/SmashZoneIcon.png" />
        </a>

        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03" style="background-color: #264653;">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-right text-right">
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='offres/list_offers.php'" type="button">Partenaires</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='liste_joueurs.php'" type="button">Joueurs</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='tournois/liste_tournoi.php'" type="button">Tournois</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='classement.php'" type="button">Classement</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='liste_clubs.php'" type="button">Clubs</button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-outline-light" onclick="location.href='offres/new_offer.php'" type="button">Poster une annonce</button>
                </li>
            </ul>

            <div class="icon" onclick="toggleNotifi()" id="notif"></div>
            <div class="notifi-box" id="box">
            </div>
            <button class="btn btn-outline-info my-2 my-sm-0" onclick="location.href='login_register/login.php'" type="button"><?= $connect ?></button>
        </div>
    </nav>
    <!-- Fin barre de navigation -->

    <section>
        <div class="slide">
            <div class="content">
                <h2>Numéro 1 sur le tennis</h2>
                <p>SmashZone est une référence dans le domaine du tennis. N'attendez plus, <a href="login_register/register.php">inscrivez-vous !</a></p>
            </div>
        </div>

        <div class="slide">
            <div class="content">
                <h2>Rencontrez de nouveaux partenaires</h2>
                <p>Cherchez de nouveaux joueurs et organisez des rencontres amicales pour prendre du niveau ! <a href="offres/list_offers.php">Voir les offres</a></p>
            </div>
        </div>

        <div class="slide">
            <div class="content">
                <h2>Triomphez dans les tournois</h2>
                <p>Visitez les tournois organisés pas les clubs, inscrivez vous et rafflez tout sur votre passage !
                    <a href="tournois/liste_tournoi.php">Voir le calendrier des tournois</a></p>
            </div>
        </div>

        <div class="slide">
            <div class="content">
                <h2>Débutez</h2>
                <p>Vous êtes novices et plein d'ambition ? Rechercher le club le plus proche de chez vous et
                    commencez votre carrière ! <a href="liste_clubs.php">Voir les clubs</a></p>
            </div>
        </div>

        <!-- Script à charger à la fin uniquement -->
        <script src="script/notification.js"></script>
        <!-- -->

</body>

</html>