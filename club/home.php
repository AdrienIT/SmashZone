<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["club_id"])) {
    header('location: ../login_register/login.php');
}

$id = (int) $_SESSION["club_id"];

$query = $db->prepare('SELECT * FROM clubs WHERE club_id = :club_id');
$query->bindParam(':club_id', $id);
$query->execute();

$user = $query->fetch();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Profil du <?php echo $user['nom_club'] ?></title>

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

            <div class="icon" onclick="toggleNotifi()" id="notif"></div>
            <div class="notifi-box" id="box">
            </div>

        </div>
    </nav>
    <!-- Fin barre de navigation -->

    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <img src=<?php echo $user['nom_club'] . "/" . $user['nom_club'] . ".png" ?> class="image" style="overflow:hidden; -webkit-border-radius:50px; -moz-border-radius:50px; border-radius:50px; height:90px; width:90px">
                <div class="overlay">
                    <a href="avatar.php">
                        <i class="material-icons text-dark md-dark text mr-2">edit</i>
                    </a>
                </div>
            </div>
            <div class="col-sm-6">
                <h1 class="text-left"> <?php echo $user['nom_club']?></h1>
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
                    <i class="material-icons md-dark mr-2">money</i>
                    <p>Code postal</p>
                    <p class="ml-auto"><?php echo $user['postal_code'] ?></p>
                </div>
                <div class="d-flex">
                    <i class="material-icons md-dark mr-2">phone</i>
                    <p>Téléphone</p>
                    <p class="ml-auto"><?php echo $user['telephone'] ?></p>
                </div>
                <div class="d-flex">
                    <i class="material-icons md-dark mr-2">access_time</i>
                    <p>Date de création</p>
                    <p class="ml-auto"><?php $date = new DateTime($user['date_creation']);
                                        echo $date->format('d/m/Y') ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <button type="button" onclick="location.href='update.php'" class="btn btn-light col-xl-6 mx-auto justify-content-center mb-2">Editer le club</button>
                <button type="button" onclick="location.href='mes_tournois.php'" class="btn btn-primary col-xl-6 mx-auto justify-content-center mb-2">Mes tournois</button>
                <button type="button" onclick="location.href='logout.php'" class="btn btn-danger col-xl-6 mx-auto justify-content-center">Se déconnecter</button>
            </div>
        </div>
    </body>

</html>