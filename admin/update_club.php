<?php
include_once '../config.php';
session_start();

if (!isset($_SESSION["admin_id"])) {
    header('location: index.php');
}

$id = (int) $_SESSION["admin_id"];

$query = $db->prepare("SELECT * FROM clubs WHERE club_id = ? ");
$query->execute([$id]);
$user = $query->fetch();

if (isset($user["club_id"])) {
    if (isset($_POST['new_nom_club']) and !empty($_POST['new_nom_club']) and $_POST['new_nom_club'] != $user['nom_club']) {
        $new_nom = htmlspecialchars($_POST['new_nom_club']);
        $update_nom_club = $db->prepare("UPDATE clubs SET nom_club = :nom_club WHERE club_id = :id");
        $update_nom_club->bindParam(":nom_club",$new_nom);
        $update_nom_club->bindParam(":id",$id);
        $update_nom_club->execute();
        header('Location: update_club.php?id='.$id);
    }
    if (isset($_POST['new_mail']) and !empty($_POST['new_mail']) and $_POST['new_mail'] != $user['email']) {
        $new_email = htmlspecialchars($_POST['new_mail']);
        $update_email = $db->prepare('UPDATE clubs SET email = :email WHERE club_id = :id');
        $update_email->bindParam(":email",$new_email);
        $update_email->bindParam(":id",$id);
        $update_email->execute();
        header('Location: update_club.php?id='.$id);
    }
    if (isset($_POST['new_ville']) and !empty($_POST['new_ville']) and $_POST['new_ville'] != $user['ville']) {
        $ville = htmlspecialchars($_POST['new_ville']);
        $update_ville = $db->prepare('UPDATE clubs SET ville = :ville WHERE club_id = :id');
        $update_ville->bindParam(":ville",$ville);
        $update_ville->bindParam(":id",$id);
        $update_ville->execute();
        header('Location: update_club.php?id='.$id);
    }
    if (isset($_POST['new_postal_code']) and !empty($_POST['new_postal_code']) and $_POST['new_postal_code'] != $user['postal_code']) {
        $new_postal_code = htmlspecialchars($_POST['new_postal_code']);
        $update_postal_code = $db->prepare('UPDATE clubs SET postal_code = :postal_code WHERE club_id = :id');
        $update_postal_code->bindParam(":postal_code",$new_postal_code);
        $update_postal_code->bindParam(":id",$id);
        $update_postal_code->execute();
        header('Location: update_club.php?id='.$id);
    }
    if (isset($_POST['new_telephone']) and !empty($_POST['new_telephone']) and $_POST['new_telephone'] != $user['telephone']) {
        $telephone = htmlspecialchars($_POST['new_telephone']);
        $update_telephone = $db->prepare('UPDATE clubs SET telephone = :telephone WHERE club_id = :id');
        $update_telephone->bindParam(":telephone",$telephone);
        $update_telephone->bindParam(":id",$id);
        $update_telephone->execute();
        header('Location: update_club.php?id='.$id);
    }
    if (isset($_POST['newpasswd1']) and !empty($_POST['newpasswd1']) and isset($_POST['newpasswd2']) and !empty($_POST['newpasswd2'])) {
        $passwd1 = md5($_POST['newpasswd1']);
        $passwd2 = md5($_POST['newpasswd2']);
        if ($passwd1  == $passwd2) {
            $update_password = $db->prepare('UPDATE clubs SET password = :password WHERE club_id = :id');
            $update_password->bindParam(":password",$passwd1);
            $update_password->bindParam(":id",$id);
            $update_password->execute();
            header('Location: update_club.php?id='.$id);
        } else {
            $err_passwd = "Les mdp ne correspondent pas";
            echo $err_passwd;
        }
    }
}


?>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../style/favicon.ico" />
        <title>Edition de profil</title>
    </head>

    <body>
        <h1>Edition de profil</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <label>Nom du club : </label>
            <input type="text" name="new_nom_club" placeholder="Nom" value="<?php echo $user['nom_club']; ?>"> <br> <br>
            <label>E-Mail : </label>
            <input type="text" name="new_mail" placeholder="Mail" value="<?php echo $user['email']; ?>"> <br> <br>
            <label>Ville : </label>
            <input type="text" name="new_ville" placeholder="ville" value="<?php echo $user['ville']; ?>"> <br> <br>
            <label>Code Postal : </label>
            <input type="text" name="new_postal_code" placeholder="postal_code"
                value="<?php echo $user['postal_code']; ?>"> <br> <br>
            <label>Telephone : </label>
            <input type="numbers" max="10" name="new_telephone" placeholder="telephone"
                value="<?php echo $user['telephone']; ?>"> <br> <br>
            <label>Mot de passe : </label>
            <input type="password" name="newpasswd1" placeholder="Password"> <br> <br>
            <label>Confirmation - Mot de passe</label>
            <input type="password" name="newpasswd2" placeholder="Password"> <br> <br>
            <input type="submit" value="Mettre à jour le profil !">
        </form>
        <a href="home.php">Retour au profil</a>

</html>