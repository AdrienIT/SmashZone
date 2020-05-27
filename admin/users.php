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
        <title>Users</title>
    </head>

    <body>
        <ul>
            <?php while ($u = $users->fetch()) { ?>
            <li><?= $u['user_id'] ?> : <?= $u['pseudo'] ?> - <a
                    href="users.php?delete=<?= $u['user_id'] ?>">Supprimer</a> - <a
                    href="update_user.php?id=<?= $u['user_id'] ?>">Editer le compte</a> </li>
            <?php } ?>
        </ul>
        <a href="index.php">Retour à la page d'administration</a>
    </body>

</html>