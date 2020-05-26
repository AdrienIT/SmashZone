<?php
include_once '../config.php';
session_start();
if (isset($_SESSION["user_id"])) {
    header('location: home.php');
}

if (isset($_POST["submit"])) {
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $password = md5($_POST["password"]);

    $query1 = $db->prepare("SELECT * FROM users WHERE pseudo = ? AND password = ? ");
    $query1->execute([$pseudo, $password]);
    $user = $query1->fetch();


    if (count($user) > 0) {
        $_SESSION['user_id'] = $user['user_id'];
        header('Location: http://localhost/smashzone/login_register/home.php');
    } else {
        $err = "Le nom d'utilisateur ou le mot de passe est incorrect";
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <link rel="icon" href="../style/favicon.ico" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../style/style.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-xl navbar-dark" style="background-color: #264653; margin-bottom: 20px; height: 55px;">
        <a class="logo" href="../index.php">
            <i class="material-icons" style="font-size: 40px; color: white;">home</i>
        </a>

        <button class="navbar-toggler ml-auto" type=" button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse rubriques" id="navbarNav">
            <form class="form-inline ml-auto p-2">
                <button class="btn btn-outline-success my-2 my-sm-0" onclick="location.href='login_register/login.php'" type="button">Connexion clubs</button>
            </form>
            <form class="form-inline">
                <button class="btn btn-outline-danger my-2 my-sm-0" onclick="location.href='../admin/index.php'" type="button">Administration</button>
            </form>
        </div>
    </nav>

    <main>
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="col-sm-3 login-section-wrapper">


                    <!-- LAAAA FAUT TAPER DEDANS -->
                    <div class="logo2">
                        <img class="main2" src="../style/SmashZone1.png" />
                        <img class="ball2" src="../style/SmashZoneIcon.png" />
                    </div>


                    <!---- FIN --->
                    <div class="login-wrapper my-auto">
                        <h1 class="login-title">Connexion</h1>
                        <form method="post">
                            <?php if (isset($user)) : ?>
                                <div><?php echo $err ?></div>
                            <?php endif ?>
                            <div class="form-group">
                                <label for="email">Nom d'utilisateur / Email</label>
                                <input required type="text" name="pseudo" class="form-control">
                            </div>
                            <div class="form-group mb-4">
                                <label for="password">Mot de passe</label>
                                <input required type="password" name="password" class="form-control">
                            </div>
                            <div class="d-flex justify-content-center flex-column">
                                <button name="submit" class="btn btn-primary btn-lg">Se
                                    connecter</button>
                        </form>
                        <a href="reset-password.php" class="forgot-password-link">Mot de passe oublié ?</a>
                        <p class="login-wrapper-footer-text">Pas encore de compte ? <a href="register.php" class="text-reset">S'inscrire</a></p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
</body>

</html>