<?php
include_once '../config.php';
session_start();
if (!isset($_SESSION["user_id"])) {
    header('location: ../index.php');
}
$id = (int) $_SESSION["user_id"];

$query = $db->prepare("SELECT * FROM users WHERE user_id = :id ");
$query->bindParam(":id", $id);
$query->execute();
$user = $query->fetch();

$pseudo = $user["pseudo"];

if (is_dir($pseudo)) {
    array_map('unlink', glob("$pseudo/*.*"));
    rmdir("./" . $pseudo . "/");
    echo "<pre>Photo de profil supprimée avec succès</pre><br>";
    echo "<a href=home.php>Retour</a>";
} else {
    echo "<pre>Il n'y a pas de photo de profil pour le moment</pre><br>"; 
    echo "<a href=home.php>Retour</a>";
}
?>