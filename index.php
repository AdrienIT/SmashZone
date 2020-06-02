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

<<<<<<< HEAD
<head>
    <title>SmashZone</title>
    <link rel="icon" href="style/favicon.ico" />
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link href="style/style.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-xl navbar-dark" style="background-color: #264653; margin-bottom: 20px; height: 55px;">
        <a class="logo" href="index.php">
            <div><img class="main" src="style/SmashZone2.png" /><img class="ball" src="style/SmashZoneIcon.png" />
            </div>
        </a>
        <button class="navbar-toggler ml-auto" type=" button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse rubriques" id="navbarNav">
            <ul class=" navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-inline rubriquecolor">
                    Effectuer une recherche :
                </li>
                <form class="form-inline">
                    <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch" onclick="location.href='offres/list_offers.php'" type="button">Partenaires</button>
                </form>
                <form class="form-inline">
                    <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch" onclick="location.href='liste_joueurs.php'" type="button">Joueurs</button>
                </form>
                <form class="form-inline">
                    <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch" onclick="location.href='tournois/liste_tournoi.php'" type="button">Tournois</button>
                </form>
                <form class="form-inline ml-5">
                    <button class="btn btn-outline-light my-2 my-sm-0 rubriquesearch" onclick="location.href='offres/new_offer.php'" type="button">Poster une annonce</button>
                </form>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <button class="btn btn-outline-info my-2 my-sm-0" onclick="location.href='login_register/login.php'" type="button"><?= $connect ?></button>
            </form>
        </div>
    </nav>

    <div class="container">
        <h1 class="mb-4">Dernières infos</h1>
        <div class="row border rounded mb-4">
            <div class="col-4">
                <img class="articleimg img-fluid" src="style/test.jpg" />
            </div>
            <div class="col-6">
                <h3 class="text-sm-left">Champion du monde tennis très fort là maintenant</h3>
                <p class="text-sm-left"> Maintes fois, précisément la phrase que le besoin de prendre l'offensive
                    dans ce cas que le ministre reprenait sa place de six mille braves en tant de manières qu'elle
                    gardait près d'elle pour être sa meilleure huile d'olive.</p>
            </div>
        </div>
        <div class="row border rounded mb-4">
            <div class="col-4">
                <img class="articleimg img-fluid" src="style/test.jpg" />
            </div>
            <div class="col-6">
                <h3 class="text-sm-left">Blablabla post sur le tennis t'as capté</h3>
                <p class="text-sm-left"> Uniformément aussi, la parole de son frère le duc d'une voix sèche, donnant
                    libre cours à vos ego naturellement vachards. Fils de soldat et de citoyen ; et se tournant vers
                    moi, je puis nombrer en elle plusieurs lacunes, la plupart de celles du paradis.</p>
            </div>
        </div>
        <div class="row border rounded mb-4">
            <div class="col-4">
                <img class="articleimg img-fluid" src="style/test.jpg" />
            </div>
            <div class="col-6">
                <h3 class="text-sm-left">AwayFromNetwork sponsorise le projet (c'est faux)</h3>
                <p class="text-sm-left"> Persuadé que ce sera impossible, répondit le greffier, un peu fat auprès
                    des femmes ? Indisposée par cette vision, qui est restée inachevée. Conscience, que vous
                    poursuivez, ils se retirèrent avec respect.</p>
            </div>
        </div>
    </div>

    <!-- <footer class="footer font-small pt-2" style="background-color: #264653; color: #2a9d8f">

            <div class="container" style="background-color: #264653;">
                <div class="row justify-content-around">
                    <a href="http://endless.horse/">
                        <img class="imgfooter" src=style/contact.png />
                    </a>
                    <a href="http://corndog.io/">
                        <img class="imgfooter" src=style/github.png />
                    </a>
                    <a href="https://ynov-bordeaux.com/">
                        <img class="imgfooter" src=style/ynov.png />
                    </a>
                    <a href="https://twitter.com/FantHaxV1">
                        <img class="imgfooter" src=style/twitter.png />
                    </a>
=======
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
>>>>>>> web_design
                </div>
            </div>
            </div>
<<<<<<< HEAD

        </footer> -->
</body>
=======
    </body>
>>>>>>> web_design

</html>