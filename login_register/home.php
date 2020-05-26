<?php
session_start();
if (!isset($_SESSION["user_id"])) {
	header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <a href="logout.php">Se Déconnecter</a> <br>
    <a href="update.php">Edition de profil</a>
</body>
</html>