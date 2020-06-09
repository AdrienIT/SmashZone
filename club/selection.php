<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["club_id"])) {
    header('location: login.php');
}

$tournoi_id = (int) $_GET['tournoi_id'];

$user_id = (int) $_GET['id'];

$query2 = $db->prepare('UPDATE tournois SET vainqueur = :vainqueur WHERE tournoi_id = :tournoi_id');
$query2->bindParam('tournoi_id', $tournoi_id);
$query2->bindParam('vainqueur', $user_id);
$query2->execute();

header('Location: mes_tournois.php');