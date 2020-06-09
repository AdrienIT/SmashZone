<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["club_id"])) {
    header('location: login.php');
}


$id = (int) $_SESSION["club_id"];


$query = $db->prepare("SELECT * FROM tournois WHERE club_id = :id ");
$query->bindParam(":id", $id);
$query->execute();

$u = $query->fetchAll();


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes tournois</title>
</head>

<body>
    <table>
        <tr>
            <td>Nom du tournoi</td>
            <td>Gagnant ?</td>
        </tr>
        <?php foreach ($u as $tournois) { ?>
            <tr>

                <td><?= $tournois['nom_tournoi'] ?></td>
                <td><?= $tournois['date_debut'] ?></td>
                <td><?= $tournois['date_fin'] ?></td>
                <td> <a href="choix_gagnant.php?tournoi_id=<?php echo $tournois['tournoi_id'] ?>">Choisir un gagnant</a> </td>

            </tr>
        <?php } ?>
    </table>
</body>

</html>