<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';
session_start();
$all_notifs = "none";
if (!isset($_SESSION["user_id"])) {
    $connect = "Se connecter/S'inscrire";
} else {
    $connect = "Mon compte";
    $query = $db->prepare("SELECT n.*, u.pseudo FROM notifications n INNER JOIN users u ON (n.id_link = u.user_id) WHERE n.vu = 0 ORDER BY n.date ASC");
    $query->execute();
    $all_notifs = $query->fetchAll();
} 

$query_classement = $db->prepare('SELECT pseudo, classement, victoire FROM users ORDER BY victoire DESC');
$query_classement->execute();


$fetch_liste = $query_classement->fetchAll()

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classement</title>
</head>
<body>
    <table>
        <tr>
            <td>Pseudo</td>
            <td>Classement</td>
            <td>Victoire</td>
        </tr>
        <?php foreach($fetch_liste as $u) { ?>
        <tr>
            <td><?=$u['pseudo']?></td>
            <td><?=$u['classement']?></td>
            <td><?=$u['victoire']?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>