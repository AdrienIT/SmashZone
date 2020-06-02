<?php
include_once 'config.php';

$users = $db->query('SELECT * FROM users');

session_start();
if (!isset($_SESSION["user_id"])) {
    $connect = "Se connecter/S'inscrire";
} else {
    $connect = "Mon compte";
    $id = (int) $_SESSION["user_id"];
}

$query = $db->prepare('SELECT prenom,nom,pseudo FROM users WHERE user_id = :user_id');
$query->bindParam(':user_id', $id);
$query->execute();

$user = $query->fetch();


if (isset($_GET['contact'])) {
    $ami = $_GET['contact'];
    $username = $user['pseudo'];
    $checkIfAlreadyWaiting = $db->prepare('SELECT sender_id,receiver_name,status FROM relationships WHERE receiver_name = :receiver_name AND status = "En attente"');
    $checkIfAlreadyFriend = $db->prepare('SELECT sender_id,receiver_name,status FROM relationships WHERE receiver_name = :receiver_name AND status = "Ami"');
    $checkIfYourself = $db->prepare('SELECT sender_id,receiver_name,status FROM relationships WHERE receiver_name = :receiver_name');

    $checkIfAlreadyWaiting->bindParam(':receiver_name', $ami);
    $checkIfAlreadyFriend->bindParam(':receiver_name', $ami);
    $checkIfYourself->bindParam(':receiver_name', $username);

    $checkIfAlreadyWaiting->execute();
    $checkIfAlreadyFriend->execute();
    $checkIfYourself->execute();

    if ($checkIfAlreadyWaiting->fetch() > 0) {
        echo "Vous avez déjà envoyé une demande d'ami à cette utilisateur";
    } elseif ($checkIfAlreadyFriend->fetch() > 0) {
        echo "Vous êtes déjà ami avec cet utilisateur";
    } elseif ($checkIfYourself->fetch() > 0) {
        echo "Mais vazi t'es teubé, tu t'es demandé toi-même en ami, trouve un travail";
    } else {
        $addfriend = $db->prepare('INSERT INTO relationships (sender_id,receiver_name,status) VALUES (:sender_id,:receiver_name,"En attente")');
        $addfriend->bindParam(':sender_id', $id);
        $addfriend->bindParam(':receiver_name', $ami);
        $addfriend->execute();
        echo "Demande d'ami envoyée";
        header("location: liste_joueurs.php");
    }
}


?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liste des joueurs</title>
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
    </head>

    <body>
        <nav class="navbar navbar-expand-xl navbar-dark mb-4"
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

        <div class="container">
            <h1 class="mb-4 font-weight-bold">Liste des joueurs inscrits</h1>
            <table class="table">
                <thead class="thead-dark text-center">
                    <tr class="joueurborder">
                        <th>Pseudo</td>
                        <th>Nom</td>
                        <th>Prénom</td>
                        <th>Classement</td>
                        <th>Télephone</td>
                            <?php
                        if (!isset($_SESSION["user_id"])) {;
                        } else {
                        ?>
                        <th>Social</td>
                            <?php } ?>
                    </tr>
                <tbody>
                    <?php while ($u = $users->fetch()) { ?>
                    <tr>
                        <td><?= $u['pseudo'] ?></td>
                        <td><?= $u['nom'] ?></td>
                        <td><?= $u['prenom'] ?></td>
                        <td><?= $u['classement'] ?></td>
                        <td><?= $u['telephone'] ?></td>
                        <?php
                        if (!isset($_SESSION["user_id"])) {;
                        } else {
                        ?>
                        <td class="text-center">
                            <a type='submit' name='contact' href='liste_joueurs.php?contact=<?php echo $u['pseudo'] ?>'
                                class=' btn btn-primary'>Envoyer une
                                demande d'ami</a> </td> <?php } ?>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>

</html>