<?php
include_once '../config.php';
session_start();
if (!isset($_SESSION["club_id"])) {
    header('location: ../index.php');
}
$id = (int) $_SESSION["club_id"];

$query = $db->prepare("SELECT * FROM users WHERE club_id = :id ");
$query->bindParam(":id", $id);
$query->execute();
$user = $query->fetch();

$nom_club = $user["nom_club"];

if (is_dir($nom_club)) {
    array_map('unlink', glob("$nom_club/*.*"));
    rmdir("./" . $nom_club . "/");
    echo "<pre>Photo de profil supprimée avec succès</pre><br>";
    echo "<a href=home.php>Retour</a>";
} else {
    echo "<pre>Il n'y a pas de photo de profil pour le moment</pre><br>"; 
    echo "<a href=home.php>Retour</a>";
}
?>