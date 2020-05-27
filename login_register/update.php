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
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../style/favicon.ico" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
            integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../style/style.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edition du profil</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-xl navbar-dark"
            style="background-color: #264653; margin-bottom: 20px; height: 55px;">
            <a class="logo" href="../index.php">
                <div><img class="main" src="../style/SmashZone2.png" /><img class="ball"
                        src="../style/SmashZoneIcon.png" />
                </div>
            </a>
            <button class="navbar-toggler ml-auto" type=" button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse rubriques" id="navbarNav">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-inline rubriquecolor">
                        Effectuer une recherche :
                    </li>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='../offres/list_offers.php'" type="button">Partenaires</button>
                    </form>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='../liste_joueurs.php'" type="button">Joueurs</button>
                    </form>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='recherchejouer.php'" type="button">Tournois</button>
                    </form>
                    <form class="form-inline ml-5">
                        <button class="btn btn-outline-light my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='../offres/new_offer.php'" type="button">Poster une annonce</button>
                    </form>
                </ul>
            </div>
        </nav>

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
                                        <input type="text" name="newpseudo" placeholder="Nom d'utilisateur"
                                            class="form-control" value="<?php echo $user['pseudo']; ?>">
                                    </div>
                                    <div class="col">
                                        <label for="nom">Classement</label>
                                        <input type="text" name="classement" placeholder="classement"
                                            class="form-control" value="<?php echo $classement; ?>">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="prenom">Prénom</label>
                                        <input type="text" name="new_prenom" placeholder="Prénom" class="form-control"
                                            value="<?php echo $user['prenom']; ?>">
                                    </div>
                                    <div class="col">
                                        <label for="nom">Nom</label>
                                        <input type="text" name="new_nom" placeholder="Nom" class="form-control"
                                            value="<?php echo $user['nom']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="email">E-mail</label>
                                        <input type="text" name="new_mail" placeholder="E-mail" class="form-control"
                                            value="<?php echo $user['email']; ?>">
                                    </div>
                                    <div class="col">
                                        <label for="telephone">Numéro de téléphone</label>
                                        <input type="numbers" max="10" name="new_telephone"
                                            placeholder="Numéro de téléphone" class="form-control"
                                            value="<?php echo $user['telephone']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="ville">Ville</label>
                                        <input type="text" name="new_ville" placeholder="Ville" class="form-control"
                                            value="<?php echo $user['ville']; ?>">
                                    </div>
                                    <div class="col">
                                        <label for="postal_code">Code postal</label>
                                        <input type="text" name="new_postal_code" placeholder="Code postal"
                                            class="form-control" value="<?php echo $user['postal_code']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" name="newpasswd1" placeholder="Ancien mot de passe"
                                            class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="password_confirm">Confirmer le mot de passe</label>
                                        <input type="password" name="newpasswd2" placeholder="Nouveau mot de passe"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center flex-column mb-2">
                                    <input type="submit" name="submit" class="btn btn-info btn-lg"
                                        value="Mettre à jour le profil"></button>
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