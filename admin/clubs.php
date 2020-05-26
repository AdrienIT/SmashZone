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
        <title>Entreprise</title>
    </head>

    <body>
        <ul>
            <?php while ($e = $clubs->fetch()) { ?>
            <li><?= $e['club_id'] ?> : <?= $e['nom_club'] ?><?php if ($e['confirme'] == 0 ) { ?> - <a
                    href="clubs.php?confirme=<?= $e['club_id'] ?>">Confirmer le Compte</a><?php } ?> - <a
                    href="clubs.php?deconfirme=<?= $e['club_id'] ?>">Deconfirmer le Compte</a> - <a
                    href="clubs.php?delete=<?= $e['club_id'] ?>">Supprimer</a> - <a
                    href="update_club.php?id=<?= $e['club_id'] ?>">Editer le compte</a> </li>
            <?php } ?>
        </ul>

        <a href="index.php">Retour à la page d'administration</a>
    </body>

</html>