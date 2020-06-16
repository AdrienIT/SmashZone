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
    <title>Profil de <?php echo $user['pseudo'] ?></title>

    <!-- Important ! -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../style/favicon.ico" />
    <meta charset="utf-8">
    <!-- -->

    <!-- Scripts au chargement de la page -->
    <script src="../script/checkbox.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <link href="../style/style.css" rel="stylesheet">
    <link href="../style/home.css" rel="stylesheet">
    <link href="../style/notification.css" rel="stylesheet">
    <script>
        var notifs = <?php echo json_encode($all_notifs) ?>
    </script>
    <!-- Scripts au chargement de la page -->

</head>

<body onload="loadNotifi(notifs)">

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-xl navbar-dark mb-4" style="background-color: #264653; height: 55px;">
        <a class="navbar-brand main" href="../index.php">
            <img class="main" src="../style/SmashZone2.png" /><img class="ball" src="../style/SmashZoneIcon.png" />
        </a>

        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03" style="background-color: #264653;">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-right text-right">
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../offres/list_offers.php'"
                        type="button">Partenaires</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../liste_joueurs.php'"
                        type="button">Joueurs</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../tournois/liste_tournoi.php'"
                        type="button">Tournois</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../classement.php'"
                        type="button">Classement</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../liste_clubs.php'"
                        type="button">Clubs</button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-outline-light" onclick="location.href='../offres/new_offer.php'"
                        type="button">Poster une annonce</button>
                </li>
            </ul>

            <div class="icon" onclick="toggleNotifi()" id="notif"></div>
            <div class="notifi-box" id="box">
            </div>

        </div>
    </nav>
    <!-- Fin barre de navigation -->
    
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