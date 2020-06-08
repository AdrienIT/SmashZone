<?php
include_once "config.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    $connect = "Se connecter/S'inscrire";
} else {
    $connect = "Mon compte";
    $id = (int) $_SESSION["user_id"];
}

$idcontact = $_GET['contact'];

$query = $db->prepare('SELECT prenom,nom,pseudo,email,ville,postal_code,date_creation,telephone,date_naissance,classement FROM users WHERE user_id = :user_id');
$query->bindParam(':user_id', $idcontact);
$query->execute();

$user = $query->fetch();


$checkIfAlreadyFriend = $db->prepare('SELECT sender_id,receiver_id,status FROM relationships WHERE (receiver_id = :receiver_id OR sender_id = :sender_id) AND status = "Ami"');
$checkIfAlreadyFriend->bindParam(':receiver_id', $idcontact);
$checkIfAlreadyFriend->bindParam(':sender_id', $id);
$checkIfAlreadyFriend->execute();

$checkIfAlreadyWaiting = $db->prepare('SELECT sender_id,receiver_id,status FROM relationships WHERE (receiver_id = :receiver_id AND sender_id = :sender_id) AND status = "En attente"');
$checkIfAlreadyWaiting->bindParam(':receiver_id', $idcontact);
$checkIfAlreadyWaiting->bindParam(':sender_id', $id);
$checkIfAlreadyWaiting->execute();

if (isset($_POST['demande_ami'])) {
    $addfriend = $db->prepare('INSERT INTO relationships (sender_id,receiver_id,status,receiver_name) VALUES (:sender_id,:receiver_id,"En attente",:receiver_name)');
    $addfriend->bindParam(':sender_id', $id);
    $addfriend->bindParam(':receiver_id', $idcontact);
    $addfriend->bindParam(':receiver_name', $user['pseudo']);
    $addfriend->execute();
    header("Refresh:0");
}

if (isset($_POST['supprimer_ami'])) {
    $querydelete = $db->prepare('DELETE FROM relationships WHERE receiver_id = :receiver_id AND sender_id = :sender_id');
    $querydelete->bindParam(':receiver_id', $idcontact);
    $querydelete->bindParam(':sender_id', $id);
    $querydelete->execute();
    header("Refresh:0");
}

?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="style/favicon.ico" />
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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="style/style.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profil de <?php echo $user['prenom'] . " " . $user['nom'] ?></title>
    </head>

    <body>
        <nav class="navbar navbar-expand-xl navbar-dark"
            style="background-color: #264653; margin-bottom: 20px; height: 55px;">
            <a class="logo" href="index.php">
                <div><img class="main" src="style/SmashZone2.png" /><img class="ball" src="style/SmashZoneIcon.png" />
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
                            onclick="location.href='offres/list_offers.php'" type="button">Partenaires</button>
                    </form>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='liste_joueurs.php'" type="button">Joueurs</button>
                    </form>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='recherchejouer.php'" type="button">Tournois</button>
                    </form>
                    <form class="form-inline">
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

        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-2">
                    <img src=<?php echo "login_register" . "/" . $user['pseudo'] . "/" . $user['pseudo'] . ".png" ?>
                        style="overflow:hidden; -webkit-border-radius:50px; -moz-border-radius:50px; border-radius:50px; height:90px; width:90px">
                    <a href="avatar.php">
                    </a>
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
                        <p class="ml-auto"><?php echo $user['date_naissance'] ?></p>
                    </div>
                    <div class="d-flex">
                        <i class="material-icons md-dark mr-2">sports_tennis</i>
                        <p>Classement</p>
                        <p class="ml-auto"><?php echo $user['classement'] ?></p>
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
                        <p class="ml-auto"><?php echo $user['date_creation'] ?></p>
                    </div>
                    <?php if (!isset($_SESSION["user_id"])) {;
                } elseif ($checkIfAlreadyFriend->fetch() > 0) {  ?>
                    <form method="post">
                        <input type='submit' name='supprimer_ami'
                            class="btn btn-danger btn-block justify-content-center" value="Supprimer des amis" />
                    </form>
                    <?php } elseif ($checkIfAlreadyWaiting->fetch() > 0) { ?>
                    <form method="post">
                        <input type='submit' name='supprimer_ami'
                            class="btn btn-danger btn-block justify-content-center" value="Annuler la demande d'ami" />
                    </form>
                    <?php
                } elseif ($id == $idcontact) {;
                } else { ?> <form method="post">
                        <input type='submit' name='demande_ami' class="btn btn-primary btn-block justify-content-center"
                            value="Demander en ami" /> </form>
                    <?php } ?>
                </div>
            </div>
    </body>

</html>