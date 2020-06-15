<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["user_id"])) {
    header('location: login.php');
}

$id = (int) $_SESSION["user_id"];

$query = $db->prepare('SELECT prenom,nom,pseudo,email,ville,postal_code,date_creation,telephone,date_naissance,classement FROM users WHERE user_id = :user_id');
$query->bindParam(':user_id', $id);
$query->execute();

$user = $query->fetch();

$query = $db->prepare("SELECT n.*, u.pseudo FROM notifications n INNER JOIN users u ON (n.id_link = u.user_id) WHERE n.vu = 0 ORDER BY n.date ASC");
$query->execute();
$all_notifs = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../style/favicon.ico" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../style/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="../style/notification.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de <?php echo $user['prenom'] . " " . $user['nom'] ?></title>
</head>
<script>
    var notifs = <?php echo json_encode($all_notifs) ?>
</script>

<body onload="loadNotifi(notifs)">
    <nav class="navbar navbar-expand-xl navbar-dark" style="background-color: #264653; margin-bottom: 20px; height: 55px;">
        <a class="logo" href="../index.php">
            <div><img class="main" src="../style/SmashZone2.png" /><img class="ball" src="../style/SmashZoneIcon.png" />
            </div>
        </a>
        <button class="navbar-toggler ml-auto" type=" button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse rubriques" id="navbarNav">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item rubriquecolor">
                    Recherchez :
                </li>
                <form class="form-inline">
                    <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch" onclick="location.href='../offres/list_offers.php'" type="button">Partenaires</button>
                </form>
                <form class="form-inline">
                    <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch" onclick="location.href='../liste_joueurs.php'" type="button">Joueurs</button>
                </form>
                <form class="form-inline">
                    <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch" onclick="location.href='../tournois/liste_tournoi.php'" type="button">Tournois</button>
                </form>
                <form class="form-inline">
                    <button class="btn btn-outline-light my-2 my-sm-0 rubriquesearch" onclick="location.href='../offres/new_offer.php'" type="button">Poster une annonce</button>
                </form>
            </ul>
            <div class="icon" onclick="toggleNotifi()" id="notif">

            </div>
            <div class="notifi-box" id="box">

            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <img src=<?php echo $user['pseudo'] . "/" . $user['pseudo'] . ".png" ?> class="image" style="overflow:hidden; -webkit-border-radius:50px; -moz-border-radius:50px; border-radius:50px; height:90px; width:90px">
                <div class="middle">
                    <a href="avatar.php">
                        <div class="text"><i class="material-icons md-dark mr-2">edit</i></div>
                    </a>
                </div>
            </div>
            <div class="col-sm-6">
                <h1 class="text-left"> <?php echo $user['prenom'] . " " . $user['nom'] ?></h1>
                <h3 class="text-left"><?php echo $user['pseudo'] ?></h3>
                <hr>
                <div class="d-flex">
                    <i class="material-icons md-dark mr-2">mail</i>
                    <p>Adresse E-mail</p>
                    <p class="ml-auto"><?php echo $user['email'] ?></p>
                </div>
                <div class="d-flex">
                    <i class="material-icons md-dark mr-2">cake</i>
                    <p>Date de naissance</p>
                    <p class="ml-auto"><?php $date = new DateTime($user['date_naissance']);
                                        echo $date->format('d/m/Y') ?></p>
                </div>
                <div class="d-flex">
                    <i class="material-icons md-dark mr-2">sports_tennis</i>
                    <p>Classement</p>
                    <p class="ml-auto"><?php echo str_replace(".", "/", (string) $user['classement']) ?></p>
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
                <button type="button" onclick="location.href='../relations/index.php'" class="btn btn-light btn-block justify-content-center">Amis</button>
            </div>
            <div class="col-sm-4">
                <button type="button" onclick="location.href='update.php'" class="btn btn-light col-xl-6 mx-auto justify-content-center mb-2">Editer le profil</button>
                <button type="button" onclick="location.href='logout.php'" class="btn btn-danger col-xl-6 mx-auto justify-content-center">Se déconnecter</button>
            </div>
        </div>
        <script src="../script/notification2.js"></script>
</body>

</html>