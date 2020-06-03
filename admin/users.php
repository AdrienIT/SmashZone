<?php
include_once '../config.php';

$users = $db->query('SELECT * FROM users');

$fetch = $users->fetch();


if (isset($_GET['delete']) and !empty($_GET['delete'])) {
    $delete = (int) $_GET['delete'];
    $req = $db->prepare('DELETE FROM users WHERE user_id = ?');
    $req->execute(array($delete));
}


?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../style/favicon.ico" />
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
        <link href="../style/style.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Utilisateurs</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-xl navbar-dark"
            style="background-color: #264653; margin-bottom: 20px; height: 55px;">
            <a class="logo" href="../index.php">
                <div><img class="main" src="../style/SmashZone2.png" /><img class="ball"
                        src="../style/SmashZoneIcon.png" />
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
                            onclick="location.href='../offres/list_offers.php'" type="button">Partenaires</button>
                    </form>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='../liste_joueurs.php'" type="button">Joueurs</button>
                    </form>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='recherchejouer.php'" type="button">Tournois</button>
                    </form>
                    <form class="form-inline">
                        <button class="btn btn-outline-light my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='../offres/new_offer.php'" type="button">Poster une annonce</button>
                    </form>
                </ul>
            </div>
        </nav>

        <div class="container">
            <h1 class="mb-4 font-weight-bold">Liste des joueurs inscrits</h1>
            <table class="table">
                <thead class="thead-dark text-center">
                    <tr class="joueurborder">
                        <th>ID Utilisateur</td>
                        <th>Pseudo</td>
                        <th>Supprimer</td>
                        <th>Editer</td>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($u = $users->fetch()) { ?>
                    <tr>
                        <td> <?= $u['user_id'] ?> </td>
                        <td> <?= $u['pseudo'] ?> </td>
                        <td class="text-center"> <a class="btn btn-danger"
                                href="users.php?delete=<?= $u['user_id'] ?>">Supprimer</a> </td>
                        <td class="text-center"> <a class="btn btn-primary"
                                href="update_user.php?id=<?= $u['user_id'] ?>">Editer le
                                compte</a> </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="index.php">Retour à la page d'administration</a>
        </div>
    </body>

</html>