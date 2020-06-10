<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["club_id"])) {
    header('location: login.php');
}

$tournoi_id = (int) $_GET['tournoi_id'];

$user_id = (int) $_GET['id'];

$query = $db->prepare('SELECT victoire FROM users WHERE user_id = :user_id');
$query->bindParam('user_id', $user_id);
$query->execute();

$fetch_victoire = $query->fetch();

$victoire = $fetch_victoire['victoire'] + 1;



$query2 = $db->prepare('UPDATE users SET victoire = :victoire WHERE user_id = :user_id');
$query2->bindParam('victoire', $victoire);
$query2->bindParam('user_id', $user_id);
$query2->execute();

$query3 = $db->prepare('UPDATE tournois SET vainqueur = :vainqueur WHERE tournoi_id = :tournoi_id');
$query3->bindParam('tournoi_id', $tournoi_id);
$query3->bindParam('vainqueur', $user_id);
$query3->execute();

header('Location: mes_tournois.php');