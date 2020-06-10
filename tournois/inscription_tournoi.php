<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../config.php');
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
}

$tournoi_id = $_GET['id'];

$id = (int) $_SESSION["user_id"];

$query = $db->prepare('SELECT * FROM detail_tournoi WHERE user_id = :user_id AND tournoi_id = :tournoi_id');
$query->bindParam(':user_id', $id);
$query->bindParam(':tournoi_id', $tournoi_id);
$query->execute();

$sql_verif = $query->fetch();

if (!empty($sql_verif)) {
    header('Location: liste_tournoi.php');
} else {
    $query2 = $db->prepare('INSERT INTO detail_tournoi(tournoi_id, user_id) VALUES (:tournoi_id, :user_id)');
    $query2->bindParam(':tournoi_id', $tournoi_id);
    $query2->bindParam(':user_id', $id);
    $query2->execute();
    header('Location: liste_tournoi.php');
}



