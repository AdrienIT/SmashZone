<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once '../config.php';
session_start();
if (isset($_SESSION["user_id"])) {
    header('location: ./home.php');
}

$err = '';


$today = date("Y-m-d");


if (isset($_POST["submit"])) {

    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $email = htmlspecialchars($_POST["email"]);
    $ville = htmlspecialchars($_POST['ville']);
    $date_naissance = htmlspecialchars($_POST['date_naissance']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $postal_code = htmlspecialchars($_POST['postal_code']);
    $password = $_POST["password"];
    $password_confirm = $_POST["password_confirm"];
    $prenom = htmlspecialchars($_POST["prenom"]);
    $nom = htmlspecialchars($_POST["nom"]);
    $classement = htmlspecialchars($_POST["classement"]);


    $query1 = $db->prepare("SELECT pseudo FROM users WHERE pseudo = ? ");
    $query1->execute([$pseudo]);
    var_dump($query1->fetchAll());
    if ($query1->rowCount() > 0) {
        $err = "Utilisateur deja enregistré";
    } else {
        if ($password != $password_confirm) {
            $err = "les mots de passes ne correspondent pas";
        } else {
            if (strlen($password) < 5) {
                $err = "Le mot de passe doit faire plus de 5 caractères";
            } else {
                if ((strlen($postal_code) > 5)) {
                    $err = "Votre code postal n'a pas été prit en compte";
                } else {
                    $password = md5($password);
                    $query = "INSERT INTO users(pseudo,email,ville,telephone,postal_code,password,date_naissance,prenom,nom,classement) VALUES(:pseudo,:email,:ville,:telephone,:postal_code,:password,:date_naissance,:prenom,:nom,:classement)";
                    $query = $db->prepare($query);
                    $query->bindParam(':pseudo', $pseudo);
                    $query->bindParam(':email', $email);
                    $query->bindParam(':ville', $ville);
                    $query->bindParam(':prenom', $prenom);
                    $query->bindParam(':nom', $nom);
                    $query->bindParam(':telephone', $telephone);
                    $query->bindParam(':postal_code', $postal_code);
                    $query->bindParam(':password', $password);
                    $query->bindParam(':date_naissance', $date_naissance);
                    $query->bindParam(':classement', $classement);
                    if ($query->execute()) {

                        $id = (int) $_SESSION["user_id"];

                        $query = $db->prepare("SELECT * FROM users WHERE user_id = :id ");
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
    <title>Connexion</title>

    <!-- Important ! -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../style/favicon.ico" />
    <meta charset="utf-8">
    <!-- -->

    <!-- Scripts au chargement de la page -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="../style/style.css" rel="stylesheet">
    <link href="../style/home.css" rel="stylesheet">
    <link href="../style/notification.css" rel="stylesheet">
    <script>
        var notifs = <?php echo json_encode($all_notifs) ?>
    </script>
    <!-- Scripts au chargement de la page -->

</head>

<body>

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-sm navbar-dark mb-4" style="background-color: #264653; height: 55px;">
        <a class="navbar-brand main" href="../index.php">
            <i class="material-icons" style="font-size: 40px; color: white;">home</i>
        </a>

        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03" style="background-color: #264653;">

            <button class="btn btn-outline-light my-2 my-sm-0 mr-2 ml-auto" onclick="location.href='../login_register/login.php'" type="button">Se connecter</button>
            <button class="btn btn-outline-success my-2 my-sm-0 mr-2" onclick="location.href='../club/login.php'" type="button">Connexion
                club</button>
            <button class="btn btn-outline-danger my-2 my-sm-0" onclick="location.href='../admin/index.php'" type="button">Administration</button>
        </div>
    </nav>
    <!-- Fin barre de navigation -->

    <main>
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-sm">
                    <div class="logo2 d-flex justify-content-center">
                        <img class="main2" src="../style/SmashZone1.png" />
                        <img class="ball2" src="../style/SmashZoneIcon.png" />
                    </div>
                    <div class="login-wrapper my-auto">
                        <h1 class="login-title">Inscription</h1>
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
                                    <input required type="text" <?php if (isset($pseudo)) : ?> value="<?php echo $pseudo ?>" <?php endif ?> name="pseudo" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="classement">Classement</label>
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
                                    <input required type="text" <?php if (isset($prenom)) : ?> value="<?php echo $prenom ?>" <?php endif ?> name="prenom" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="nom">Nom</label>
                                    <input required type="text" <?php if (isset($nom)) : ?> value="<?php echo $nom ?>" <?php endif ?> name="nom" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="email">E-mail</label>
                                    <input required type="email" <?php if (isset($email)) : ?> value="<?php echo $email ?>" <?php endif ?> name="email" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="birthdate">Date de naissance</label>
                                    <input type="date" id="start" name="date_naissance" value="2000-01-01" min="1920-01-01" max="<?= $today ?>" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="ville">Ville</label>
                                    <input required type="ville" <?php if (isset($ville)) : ?> value="<?php echo $ville ?>" <?php endif ?> name="ville" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="postal_code">Code postal</label>
                                    <input required type="postal_code" <?php if (isset($postal_code)) : ?> value="<?php echo $postal_code ?>" <?php endif ?> name="postal_code" class="form-control">
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
                            <div class="form-group">
                                <label for="telephone">Numéro de téléphone</label>
                                <input type="telephone" <?php if (isset($telephone)) : ?> value="<?php echo $telephone ?>" <?php endif ?> name="telephone" class="form-control">
                            </div>
                            <div class="d-flex justify-content-center flex-column mb-2">
                                <button name="submit" class="btn btn-info btn-lg">S'inscrire</button>
                            </div>
                        </form>
                        <p>Tu as déjà un compte ? <a href="login.php">Connecte-toi !</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>