<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["club_id"])) {
    header('location: login.php');
}


$id = (int) $_GET['tournoi_id'];

$query2 = $db->prepare('SELECT u.user_id, u.pseudo, u.nom, u.prenom FROM users u JOIN detail_tournoi dt ON (u.user_id = dt.user_id) WHERE dt.user_id = :tournoi_id');
$query2->bindParam(':tournoi_id', $id);
$query2->execute();

$u = $query2->fetchAll();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix gagant</title>
</head>
<body>
    <table>
        <tr>
            <td>Pseudo</td>
            <td>Nom</td>
            <td>Prenom</td>
            <td>Choisir ?</td>
        </tr>
        <?php foreach($u as $users) { ?>
        <tr>
            <td> <?= $users['pseudo'] ?> </td>
            <td> <?= $users['nom'] ?> </td>
            <td> <?= $users['prenom'] ?> </td>
            <td> <a href="selection.php?tournoi_id=<?= $id ?>&id=<?php echo $users['user_id']?>">Choisir</a> </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>