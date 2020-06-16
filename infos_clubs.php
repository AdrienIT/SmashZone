<?php
include_once "config.php";
session_start();

if (!isset($_SESSION["user_id"]) && (!isset($_SESSION["admin_id"]) && (!isset($_SESSION["club_id"])))) {
    $connect = "Se connecter/S'inscrire";
} else {
    $connect = "Mon compte";
    $id = (int) $_SESSION["user_id"];
}

$idcontact = $_GET['contact'];

$query = $db->prepare('SELECT nom_club,email,ville,postal_code,telephone,adresse FROM clubs WHERE club_id = :club_id');
$query->bindParam(':club_id', $idcontact);
$query->execute();

$user = $query->fetch();
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
    <nav class="navbar navbar-expand-xl navbar-dark mb-4" style="background-color: #264653; height: 55px;">
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

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-2">
                <img src=<?php if (file_exists("club/" . str_replace(" ", "_", $user['nom_club']))) {
                                echo "club/" . str_replace(" ", "_", $user['nom_club']) . "/" . str_replace(" ", "_", $user['nom_club']) . ".png";
                            } else {
                                echo "club/default-club.png";
                            } ?> style="overflow:hidden; -webkit-border-radius:50px; -moz-border-radius:50px; border-radius:50px; height:90px; width:90px">
                <a href="avatar.php">
                </a>
            </div>
            <div class="col-sm-6">
                <h1 class="text-left"> <?php echo $user['nom_club'] ?></h1>
                <h3 class="text-left"><?php echo $user['nom_club'] ?></h3>
                <hr>
                <div class="d-flex">
                    <i class="material-icons md-dark mr-2">mail</i>
                    <p>Adresse E-mail</p>
                    <p class="ml-auto"><?php echo $user['email'] ?></p>
                </div>

                <div class="d-flex">
                    <i class="material-icons md-dark mr-2">location_city</i>
                    <p>Ville</p>
                    <p class="ml-auto"><?php echo $user['ville'] ?></p>
                </div>
                <div class="d-flex">
                    <i class="material-icons md-dark mr-2">location_city</i>
                    <p>Adresse</p>
                    <p class="ml-auto"><?php echo $user['adresse'] ?></p>
                </div>
                <div class="d-flex">
                    <i class="material-icons md-dark mr-2">money</i>
                    <p>Code postal</p>
                    <p class="ml-auto"><?php echo $user['postal_code'] ?></p>
                </div>
                <div class="d-flex">
                    <i class="material-icons md-dark mr-2">phone</i>
                    <p>Téléphone</p>
                    <p class="ml-auto"><?php if ($user['telephone'] == 0) {
                                            echo "Non renseigné";
                                        } else {
                                            echo $user['telephone'];
                                        } ?></p>
                </div>
                <?php if (!isset($_SESSION["user_id"])) {;
                } elseif ($checkIfAlreadyFriend->fetch() > 0) {  ?>
                    <form method="post">
                        <input type='submit' name='supprimer_ami' class="btn btn-danger btn-block justify-content-center" value="Supprimer des amis" />
                    </form>
                <?php } elseif ($checkIfAlreadyWaiting->fetch() > 0) { ?>
                    <form method="post">
                        <input type='submit' name='supprimer_ami' class="btn btn-danger btn-block justify-content-center" value="Annuler la demande d'ami" />
                    </form>
                <?php
                } elseif ($id == $idcontact) {;
                } else { ?> <form method="post">
                        <input type='submit' name='demande_ami' class="btn btn-primary btn-block justify-content-center" value="Demander en ami" /> </form>
                <?php } ?>
            </div>
        </div>
</body>

</html>