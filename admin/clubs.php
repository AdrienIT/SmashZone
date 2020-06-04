<?php
include_once '../config.php';

if (isset($_GET['confirme']) and !empty($_GET['confirme'])) {
    $confirme = (int) $_GET['confirme'];
    $req = $db->prepare('UPDATE clubs SET confirme = 1 WHERE club_id = ?');
    $req->execute(array($confirme));
    header('Location: clubs.php');
}

if (isset($_GET['deconfirme']) and !empty($_GET['deconfirme'])) {
    $deconfirme = (int) $_GET['deconfirme'];
    $req = $db->prepare('UPDATE clubs SET confirme = 0 WHERE club_id = ?');
    $req->execute(array($deconfirme));
    header('Location: clubs.php');
}

if (isset($_GET['delete']) and !empty($_GET['delete'])) {
    $delete = (int) $_GET['delete'];
    $req = $db->prepare('DELETE FROM clubs WHERE club_id = ?');
    $req->execute(array($delete));
    header('Location: clubs.php');
}

$clubs = $db->query('SELECT * FROM clubs');

?>

<!DOCTYPE html>
<html lang="en">

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
        <title>Clubs</title>
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
                        <th>ID Club</td>
                        <th>Nom</td>
                        <th>Statut</td>
                        <th>Déconfirmer/Supprimer</td>
                        <th>Actions</td>
                        <th>
                            </td>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($e = $clubs->fetch()) { ?>
                    <tr>
                        <td><?= $e['club_id'] ?> </td>
                        <td> <?= $e['nom_club'] ?><?php if ($e['confirme'] == 0) { ?></td>
                        <td> <a class="btn btn-success" href="clubs.php?confirme=<?= $e['club_id'] ?>">Confirmer le
                                Compte</a><?php } ?> </td>
                        <td> <a class="btn btn-danger" href="clubs.php?deconfirme=<?= $e['club_id'] ?>">Deconfirmer le
                                Compte</a> </td>
                        <td> <a class="btn btn-danger" href="clubs.php?delete=<?= $e['club_id'] ?>">Supprimer</a></td>
                        <td> <a class="btn btn-primary" href="update_club.php?id=<?= $e['club_id'] ?>">Editer le
                                compte</a> </td>
                    </tr>
                    <?php } ?>

                    <a class="btn btn-light mb-2" href="index.php">
                        < Retour à la page d'administration</a>
    </body>

</html>