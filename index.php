<?php

include 'config.php';

session_start();
if (!isset($_SESSION["user_id"])) {
    $connect = "Se connecter/S'inscrire";
} else {
    $connect = "Mon compte";
}


?>

<!DOCTYPE html>
<html>

    <head>
        <title>SmashZone</title>
        <link rel="icon" href="style/favicon.ico" />
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
        <link href="style/style.css" rel="stylesheet">
        <link href="style/home.css" rel="stylesheet">
    </head>

    <body>
        <nav class="navbar navbar-expand-xl navbar-dark"
            style="background-color: #264653; margin-bottom: 0px; height: 55px;">
            <a class="logo" href="index.php">
                <div><img class="main" src="style/SmashZone2.png" /><img class="ball" src="style/SmashZoneIcon.png" />
                </div>
            </a>
            <button class="navbar-toggler ml-auto" type=" button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse rubriques" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item rubriquecolor">
                        Recherchez :
                    </li>
                    <form class="nav-item">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='offres/list_offers.php'" type="button">Partenaires</button>
                    </form>
                    <form class="nav-item">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='liste_joueurs.php'" type="button">Joueurs</button>
                    </form>
                    <form class="nav-item">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='tournois/liste_tournoi.php'" type="button">Tournois</button>
                    </form>
                    <form class="nav-item">
                        <button class="btn btn-outline-light my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='offres/new_offer.php'" type="button">Poster une annonce</button>
                    </form>
                </ul>
                <form class="nav-item">
                    <button class="btn btn-outline-info my-2 my-sm-0" onclick="location.href='login_register/login.php'"
                        type="button"><?= $connect ?></button>
                </form>
            </div>
        </nav>

        <section>
            <div class="slide">
                <div class="content">
                    <h2>Numéro 1 sur le tennis</h2>
                    <p>SmashZone est une référence dans le domaine du tennis, <a href="">Découvrez les dernières
                            nouveautés</a></p>
                </div>
            </div>
            <div class="slide">
                <div class="content">
                    <h2>Rencontrez de nouveaux partenaires</h2>
                    <p>Cherchez de nouveaux joueurs et organisez des rencontres amicales pour prendre du niveau ! <a
                            href="offres/list_offers.php">Voir les offres</a></p>
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
                        commencez votre carrière ! <a href="">Voir les clubs</a></p>
                </div>
            </div>
            </div>
    </body>

</html>