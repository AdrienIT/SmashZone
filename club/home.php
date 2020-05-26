<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["club_id"])) {
    header('location: login.php');
}

$id = (int) $_SESSION["club_id"];

$query = $db->prepare('SELECT nom_club FROM clubs WHERE club_id = :club_id');
$query->bindParam(':club_id', $id);
$query->execute();

$user = $query->fetch();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <h1> Bonjour <?php echo $user['nom_club'] ?></h1>
    <a href="update.php">Edition de profil</a> <br> <br>
    <a href="avatar.php">Photo de profil</a> <br> <br>
    <a href="logout.php">Se Déconnecter</a>
</body>
</html>