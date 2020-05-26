<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["club_id"])) {
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avatar</title>
</head>

<body>
    <form action='avatar_upload.php' method='POST' enctype='multipart/form-data'>
        <p>Choisis ton image de profil (que du png)</p>
        <input type='file' name='file' id='file'>
        <input type='submit' name='submit' value='Upload'>
    </form>
    <br>
    <a href="delete_avatar.php">Supprime ton Image de profil</a>
    <br>
    <br>
    <a href="home.php">Retour</a>
</body>

</html>