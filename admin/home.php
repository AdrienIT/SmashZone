<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header('location: index.php');
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
    <h1>Bienvenue Admin</h1>
    <a href="users.php">Utilisateurs</a> <br> <br>
    <a href="clubs.php">clubs</a> <br> <br>
    <a href="logout.php">Logout</a>
</body>

</html>