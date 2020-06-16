<?php
include_once '../config.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header('location: index.php');
}

$id = (int) $_SESSION["user_id"];

$query = $db->prepare("SELECT * FROM users WHERE user_id = ? ");
$query->execute([$id]);
$user = $query->fetch();

$classement = $user['classement'];

if ($classement == 'NULL') {
    $classement = 40;
} else {
    $classement = $user['classement'];;
}

if (isset($user["user_id"])) {
    if (isset($_POST['newpseudo']) and !empty($_POST['newpseudo']) and $_POST['newpseudo'] != $user['pseudo']) {
        $newpseudo = htmlspecialchars($_POST['newpseudo']);
        $update_pseudo = $db->prepare("UPDATE users SET pseudo = :pseudo WHERE user_id = :id");
        $update_pseudo->bindParam(":pseudo", $newpseudo);
        $update_pseudo->bindParam(":id", $id);
        $update_pseudo->execute();
        header('Location: update.php?id=' . $id);
    }
    if (isset($_POST['newmail']) and !empty($_POST['newmail']) and $_POST['newmail'] != $user['email']) {
        $new_email = htmlspecialchars($_POST['newmail']);
        $update_email = $db->prepare('UPDATE users SET email = :email WHERE user_id = :id');
        $update_email->bindParam(":email", $new_email);
        $update_email->bindParam(":id", $id);
        $update_email->execute();
        header('Location: update.php?id=' . $id);
    }
    if (isset($_POST['new_prenom']) and !empty($_POST['new_prenom']) and $_POST['new_prenom'] != $user['prenom']) {
        $new_prenom = htmlspecialchars($_POST['new_prenom']);
        $update_prenom = $db->prepare('UPDATE users SET prenom = :prenom WHERE user_id = :id');
        $update_prenom->bindParam(":prenom", $new_prenom);
        $update_prenom->bindParam(":id", $id);
        $update_prenom->execute();
        header('Location: update.php?id=' . $id);
    }
    if (isset($_POST['new_nom']) and !empty($_POST['new_nom']) and $_POST['new_nom'] != $user['nom']) {
        $nom = htmlspecialchars($_POST['new_nom']);
        $update_nom = $db->prepare('UPDATE users SET nom = :nom WHERE user_id = :id');
        $update_nom->bindParam(":nom", $nom);
        $update_nom->bindParam(":id", $id);
        $update_nom->execute();
        header('Location: update.php?id=' . $id);
    }
    if (isset($_POST['new_ville']) and !empty($_POST['new_ville']) and $_POST['new_ville'] != $user['ville']) {
        $ville = htmlspecialchars($_POST['new_ville']);
        $update_ville = $db->prepare('UPDATE users SET ville = :ville WHERE user_id = :id');
        $update_ville->bindParam(":ville", $ville);
        $update_ville->bindParam(":id", $id);
        $update_ville->execute();
        header('Location: update.php?id=' . $id);
    }
    if (isset($_POST['new_postal_code']) and !empty($_POST['new_postal_code']) and $_POST['new_postal_code'] != $user['postal_code']) {
        $ville = htmlspecialchars($_POST['new_postal_code']);
        $update_postal_code = $db->prepare('UPDATE users SET postal_code = :postal_code WHERE user_id = :id');
        $update_postal_code->bindParam(":postal_code", $postal_code);
        $update_postal_code->bindParam(":id", $id);
        $update_postal_code->execute();
        header('Location: update.php?id=' . $id);
    }
    if (isset($_POST['new_telephone']) and !empty($_POST['new_telephone']) and $_POST['new_telephone'] != $user['telephone']) {
        $telephone = htmlspecialchars($_POST['new_telephone']);
        $update_telephone = $db->prepare('UPDATE users SET telephone = :telephone WHERE user_id = :id');
        $update_telephone->bindParam(":telephone", $telephone);
        $update_telephone->bindParam(":id", $id);
        $update_telephone->execute();
        header('Location: update.php?id=' . $id);
    }
    if (isset($_POST['classement']) and !empty($_POST['classement']) and $_POST['classement'] != $user['classement']) {
        $new_classement = htmlspecialchars($_POST['classement']);
        $update_classement = $db->prepare('UPDATE users SET classement = :classement WHERE user_id = :id');
        $update_classement->bindParam(":classement", $new_classement);
        $update_classement->bindParam(":id", $id);
        $update_classement->execute();
        header('Location: update.php?id=' . $id);
    }
    if (isset($_POST['newpasswd1']) and !empty($_POST['newpasswd1']) and isset($_POST['newpasswd2']) and !empty($_POST['newpasswd2'])) {
        $passwd1 = md5($_POST['newpasswd1']);
        $passwd2 = md5($_POST['newpasswd2']);
        if ($passwd1  == $passwd2) {
            $update_password = $db->prepare('UPDATE users SET password = :password WHERE user_id = :id');
            $update_password->bindParam(":password", $passwd1);
            $update_password->bindParam(":id", $id);
            $update_password->execute();
            header('Location: update.php?id=' . $id);
        } else {
            $err_passwd = "<script>alert('Les mdp ne correspondent pas');</script>";
            echo $err_passwd;
        }
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Edition de profil</title>

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

    <main>
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-sm">
                    <div class="login-wrapper my-auto">
                        <h1 class="login-title">Edition du profil</h1>
                        <form method="post">
                            <?php if (isset($err)) : ?>
                                <div><?php echo $err ?></div>
                            <?php endif ?>

                            <?php if (isset($success)) : ?>
                                <div>Successful</div>
                            <?php endif ?>

                            <div class="row mb-4">
                                <div class="col">
                                    <label for="pseudo">Nom d'utilisateur</label>
                                    <input type="text" name="newpseudo" placeholder="Nom d'utilisateur" class="form-control" value="<?php echo $user['pseudo']; ?>">
                                </div>
                                <div class="col">
                                    <label for="nom">Classement</label>
                                    <br>
                                    <select name="classement" id="classement">
                                        <option value="40" <?php if (isset($classement) && $classement == "40") {
                                                                echo "selected";
                                                            } ?>>--Aucun--</option>
                                        <option value="30.5" <?php if (isset($classement) && $classement == "30.5") {
                                                                    echo "selected";
                                                                } ?>>30/5</option>
                                        <option value="30.4" <?php if (isset($classement) && $classement == "30.4") {
                                                                    echo "selected";
                                                                } ?>>30/4</option>
                                        <option value="30.3" <?php if (isset($classement) && $classement == "30.3") {
                                                                    echo "selected";
                                                                } ?>>30/3</option>
                                        <option value="30.2" <?php if (isset($classement) && $classement == "30.2") {
                                                                    echo "selected";
                                                                } ?>>30/2</option>
                                        <option value="30.1" <?php if (isset($classement) && $classement == "30.1") {
                                                                    echo "selected";
                                                                } ?>>30/1</option>
                                        <option value="30" <?php if (isset($classement) && $classement == "30") {
                                                                echo "selected";
                                                            } ?>>30</option>
                                        <option value="15.5" <?php if (isset($classement) && $classement == "15.5") {
                                                                    echo "selected";
                                                                } ?>>15/5</option>
                                        <option value="15.4" <?php if (isset($classement) && $classement == "15.4") {
                                                                    echo "selected";
                                                                } ?>>15/4</option>
                                        <option value="15.3" <?php if (isset($classement) && $classement == "15.3") {
                                                                    echo "selected";
                                                                } ?>>15/3</option>
                                        <option value="15.2" <?php if (isset($classement) && $classement == "15.2") {
                                                                    echo "selected";
                                                                } ?>>15/2</option>
                                        <option value="15.1" <?php if (isset($classement) && $classement == "15.1") {
                                                                    echo "selected";
                                                                } ?>>15/1</option>
                                        <option value="15" <?php if (isset($classement) && $classement == "15") {
                                                                echo "selected";
                                                            } ?>>15</option>
                                        <option value="5.6" <?php if (isset($classement) && $classement == "5.6") {
                                                                echo "selected";
                                                            } ?>>5/6</option>
                                        <option value="4.6" <?php if (isset($classement) && $classement == "4.6") {
                                                                echo "selected";
                                                            } ?>>4/6</option>
                                        <option value="3.6" <?php if (isset($classement) && $classement == "3.6") {
                                                                echo "selected";
                                                            } ?>>3/6</option>
                                        <option value="2.6" <?php if (isset($classement) && $classement == "2.6") {
                                                                echo "selected";
                                                            } ?>>2/6</option>
                                        <option value="1.6" <?php if (isset($classement) && $classement == "1.6") {
                                                                echo "selected";
                                                            } ?>>1/6</option>
                                        <option value="0" <?php if (isset($classement) && $classement == "0") {
                                                                echo "selected";
                                                            } ?>>0</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" name="new_prenom" placeholder="Prénom" class="form-control" value="<?php echo $user['prenom']; ?>">
                                </div>
                                <div class="col">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="new_nom" placeholder="Nom" class="form-control" value="<?php echo $user['nom']; ?>">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="email">E-mail</label>
                                    <input type="text" name="new_mail" placeholder="E-mail" class="form-control" value="<?php echo $user['email']; ?>">
                                </div>
                                <div class="col">
                                    <label for="telephone">Numéro de téléphone</label>
                                    <input type="numbers" max="10" name="new_telephone" placeholder="Numéro de téléphone" class="form-control" value="<?php echo $user['telephone']; ?>">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="ville">Ville</label>
                                    <input type="text" name="new_ville" placeholder="Ville" class="form-control" value="<?php echo $user['ville']; ?>">
                                </div>
                                <div class="col">
                                    <label for="postal_code">Code postal</label>
                                    <input type="text" name="new_postal_code" placeholder="Code postal" class="form-control" value="<?php echo $user['postal_code']; ?>">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" name="newpasswd1" placeholder="Ancien mot de passe" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="password_confirm">Confirmer le mot de passe</label>
                                    <input type="password" name="newpasswd2" placeholder="Nouveau mot de passe" class="form-control">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center flex-column mb-2">
                                <input type="submit" name="submit" class="btn btn-info btn-lg" value="Mettre à jour le profil"></button>
                            </div>
                        </form>
                        <a href="home.php">Annuler</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

</body>

</html>