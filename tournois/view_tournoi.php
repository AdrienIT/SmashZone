<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../config.php');
session_start();
$tournoi_id = $_GET["id"];
$get_infos = $db->prepare("SELECT * FROM tournois t INNER JOIN clubs c ON (t.club_id = c.club_id) WHERE t.tournoi_id = :id");
$get_infos->bindParam(":id", $tournoi_id);
$get_infos->execute();
$tournoi_infos = $get_infos->fetch()
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?= var_dump($tournoi_infos) ?>
</body>

</html>