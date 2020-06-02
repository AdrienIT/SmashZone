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


$token = bin2hex(openssl_random_pseudo_bytes(16));

if (isset($_GET['contact'])) {
    $ami = $_GET['contact'];
    $addfriend = $db->prepare('INSERT INTO relationships (request_id,sender_id,receiver_name,status) VALUES (:request_id,:sender_id,:receiver_name,"En attente")');
    $addfriend->bindParam(':request_id', $token);
    $addfriend->bindParam(':sender_id', $id);
    $addfriend->bindParam(':receiver_name', $ami);
    $addfriend->execute();
    header("location: liste_joueurs.php");
    var_dump($addfriend);
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
                <ul class=" navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-inline rubriquecolor">
                        Effectuer une recherche :
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
                            onclick="location.href='tournois/liste_tournoi.php'" type="button">Tournois</button>
                    </form>
                    <form class="form-inline ml-5">
                        <button class="btn btn-outline-light my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='offres/new_offer.php'" type="button">Poster une annonce</button>
                    </form>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <button class="btn btn-outline-info my-2 my-sm-0" onclick="location.href='login_register/login.php'"
                        type="button"><?= $connect ?></button>
                </form>
            </div>
        </nav>

        <div class="container-fluid">
            <h1 class="mb-4">Liste des joueurs inscrits</h1>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th style="border: 1px solid black;">Pseudo</td>
                        <th style="border: 1px solid black;">Nom</td>
                        <th style="border: 1px solid black;">Prénom</td>
                        <th style="border: 1px solid black;">Classement</td>
                        <th style="border: 1px solid black;">Télephone</td>
                            <?php
                        if (!isset($_SESSION["user_id"])) {;
                        } else {
                        ?>
                        <th style="border: 1px solid black;">Amis ?</td>
                            <?php } ?>
                    </tr>
                <tbody>
                    <?php while ($u = $users->fetch()) { ?>
                    <tr>
                        <td style="border: 1px solid black;"><?= $u['pseudo'] ?></td>
                        <td style="border: 1px solid black;"><?= $u['nom'] ?></td>
                        <td style="border: 1px solid black;"><?= $u['prenom'] ?></td>
                        <td style="border: 1px solid black;"><?= $u['classement'] ?></td>
                        <td style="border: 1px solid black;"><?= $u['telephone'] ?></td>
                        <?php
                        if (!isset($_SESSION["user_id"])) {;
                        } else {
                        ?>
                        <td style='border: 1px solid black;'>
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