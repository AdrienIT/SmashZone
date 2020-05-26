<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <link href="../style/style.css" rel="stylesheet">
        <title>Connexion</title>
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
            </div>
            <form class="form-inline my-2 my-lg-0">
                <button class="btn btn-outline-info my-2 my-sm-0" onclick="location.href='login_register/index.php'"
                    type="button">Se
                    connecter/S'inscrire</button>
            </form>
            <form class="form-inline my-2 my-lg-0">
                <button class="btn btn-outline-info my-2 my-sm-0" onclick="location.href='login_register/index.php'"
                    type="button">Se
                    connecter/S'inscrire</button>
            </form>
        </nav>
        <a href="login.php">Connexion</a> <br> <br>
        <a href="register.php">Vous n'êtes pas membre ? Inscrivez-vous</a> <br> <br>
        <a href="forgot.php">Mot de passe oublié</a>

        <main>
            <div class="container-fluid">
                <div class="d-flex justify-content-center">
                    <div class="col-sm-3 login-section-wrapper">
                        <img src="../style/SmahZone1.png" id="logologin" />
                        <div class="login-wrapper my-auto">
                            <h1 class="login-title">Connexion</h1>
                            <form action="#!">
                                <div class="form-group">
                                    <label for="email">Nom d'utilisateur ou E-mail</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <input name="login" id="login" class="btn btn-block login-btn" type="button"
                                    value="Login">
                            </form>
                            <a href="#!" class="forgot-password-link">Mot de passe oublié ?</a>
                            <p class="login-wrapper-footer-text">Pas de compte ? <a href="#!"
                                    class="text-reset">Register here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>

</html>