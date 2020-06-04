<?php
include_once '../config.php';
session_start();
if (isset($_SESSION["club_id"])) {
    header('location: ./home.php');
}

$err = '';

$today = date("Y-m-d");


if (isset($_POST["submit"])) {

    $nom_club = htmlspecialchars($_POST["nom_club"]);
    $email = htmlspecialchars($_POST["email"]);
    $ville = htmlspecialchars($_POST['ville']);
    $telephone = (int) htmlspecialchars($_POST['telephone']);
    $postal_code = (int) htmlspecialchars($_POST['postal_code']);
    $password = $_POST["password"];
    $password_confirm = $_POST["password_confirm"];
    $confirme = 0;


    $query1 = $db->prepare("SELECT nom_club FROM clubs WHERE nom_club = ? ");
    $query1->execute([$nom_club]);
    if ($query1->rowCount() > 0) {
        $err = "Utilisateur deja enregistré";
        echo $err;
    } else {
        if ($password != $password_confirm) {
            $err = "les mots de passes ne correspondent pas";
            echo $err;
        } else {
            if (strlen($password) < 6) {
                $err = "Le mot de pass devrait faire plus de 5 caractère";
                echo $err;
            } else {
                if ((strlen($postal_code) > 6)) {
                    $err = "Votre code postal n'a pas été prit en compte";
                    echo $err;
                } else {
                    $password = md5($password);
                    $query = "INSERT INTO clubs(nom_club,email,ville,telephone,postal_code,password,confirme) VALUES(:nom_club,:email,:ville,:telephone,:postal_code,:password,:confirme)";
                    $query = $db->prepare($query);
                    $query->bindParam(':nom_club', $nom_club);
                    $query->bindParam(':email', $email);
                    $query->bindParam(':ville', $ville);
                    $query->bindParam(':telephone', $telephone);
                    $query->bindParam(':postal_code', $postal_code);
                    $query->bindParam(':password', $password);
                    $query->bindParam(':confirme', $confirme);
                    if ($query->execute()) {

                        $id = (int) $_SESSION["club_id"];

                        $query = $db->prepare("SELECT * FROM clubs WHERE club_id = :id ");
                        $query->bindParam(":id", $id);
                        $query->execute();
                        $user = $query->fetch();

                        $err = 'Compte enregistré avec succes';


                        header('location: ./login.php');
                    }
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Inscription</title>
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
    </head>

    <body>
        <nav class="navbar navbar-expand-xl navbar-dark"
            style="background-color: #264653; margin-bottom: 20px; height: 55px;">
            <a class="logo" href="../index.php">
                <i class="material-icons" style="font-size: 40px; color: white;">home</i>
            </a>

            <button class="navbar-toggler ml-auto" type=" button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse rubriques" id="navbarNav">
                <form class="form-inline ml-auto p-2">
                    <button class="btn btn-outline-light my-2 my-sm-0"
                        onclick="location.href='../login_register/login.php'" type="button">Connexion
                        utilisateur</button>
                </form>
                <form class="form-inline">
                    <button class="btn btn-outline-danger my-2 my-sm-0" onclick="location.href='../admin/index.php'"
                        type="button">Administration</button>
                </form>
            </div>
        </nav>

        <main>
            <div class="container">
                <div class="d-flex justify-content-center">
                    <div class="col-sm">
                        <div class="login-wrapper my-auto">
                            <h1 class="login-title">Création d'une page club</h1>
                            <form method="post">
                                <?php if (isset($err)) : ?>
                                <div><?php echo $err ?></div>
                                <?php endif ?>

                                <?php if (isset($success)) : ?>
                                <div>Successful</div>
                                <?php endif ?>

                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="pseudo">Nom du club</label>
                                        <input required type="text" <?php if (isset($nom_club)) : ?>
                                            value="<?php echo $nom_club ?>" <?php endif ?> name="nom_club"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="email">E-mail</label>
                                        <input required type="email" <?php if (isset($email)) : ?>
                                            value="<?php echo $email ?>" <?php endif ?> name="email"
                                            class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="ville">Ville</label>
                                        <input required type="ville" <?php if (isset($ville)) : ?>
                                            value="<?php echo $ville ?>" <?php endif ?> name="ville"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="postal_code">Code postal</label>
                                        <input required type="postal_code" <?php if (isset($postal_code)) : ?>
                                            value="<?php echo $postal_code ?>" <?php endif ?> name="postal_code"
                                            class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="telephone">Numéro de téléphone</label>
                                        <input required type="telephone" <?php if (isset($telephone)) : ?>
                                            value="<?php echo $telephone ?>" <?php endif ?> name="telephone"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="password">Mot de passe</label>
                                        <input required type="password" name="password" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="password_confirm">Confirmer le mot de passe</label>
                                        <input required type="password" name="password_confirm" class="form-control">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center flex-column mb-2">
                                    <button name="submit" class="btn btn-info btn-lg">Créer la page club</button>
                                </div>
                            </form>
                            <p>Tu as déjà un club ? <a href="login.php">Connecte-toi !</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </body>

</html>