<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["user_id"])) {
    header('location: login.php');
}

$id = (int) $_SESSION["user_id"];

$query = $db->prepare('SELECT prenom,nom FROM users WHERE user_id = :user_id');
$query->bindParam(':user_id', $id);
$query->execute();

$user = $query->fetch();

?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../style/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Homepage</title>
    </head>

    <body>
        <h1> <img src=<?php echo "./" . $user['prenom'] . "/" . $user['prenom'] . ".png" ?>
                style="overflow:hidden; -webkit-border-radius:50px; -moz-border-radius:50px; border-radius:50px; height:90px; width:90px">
            Bonjour <?php echo $user['prenom'] . " " . $user['nom'] ?></h1>
        <a href="update.php">Edition de profil</a> <br> <br>
        <a href="avatar.php">Photo de profil</a> <br> <br>
        <a href="logout.php">Se Déconnecter</a>
    </body>

</html>