<?php  
	include_once '../config.php';
	session_start();
	if (isset($_SESSION["admin_id"])) {
		header('location: ./home.php');
	}

	if (isset($_POST["submit"])) {
		$username = htmlspecialchars($_POST["username"]);
		$password = md5($_POST["password"]);

		$query1 = $db->prepare("SELECT * FROM admin WHERE username = ? AND password = ? ");
		$query1->execute([$username, $password]);
		$user = $query1->fetch();


		if (count($user) > 0) {
			$_SESSION['admin_id'] = $user['admin_id'];
			header('Location: http://localhost/SmashZone/admin/home.php');
		} else { 
			$err = "Username / Password incorrect";
			echo $err;
		}
	}
?>



<!DOCTYPE html>
<html>

    <head>
        <title>Connexion</title>
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
                    <button class="btn btn-outline-success my-2 my-sm-0" onclick="location.href='../club/login.php'"
                        type="button">Connexion clubs</button>
                </form>
                <form class="form-inline">
                    <button class="btn btn-outline-light my-2 my-sm-0"
                        onclick="location.href='../login_register/login.php'" type="button">Connexion
                        utilisateur</button>
                </form>
            </div>
        </nav>

        <div class="container text-center">
            <h1>Page d'administration</h1>
            <div>
                <div></div>
                <div>
                    <div>
                        <h3 class="mb-4">Connexion</h3>
                        <form method="post">
                            <?php if (isset($err)): ?>
                            <div><?php echo $err ?></div>
                            <?php endif ?>
                            <div class="form-group col-sm-6 mx-auto">
                                <label>Nom d'utilisateur</label>
                                <input class="form-control" required type="text" name="username">
                            </div>
                            <div class="form-group col-sm-6 mx-auto">
                                <label>Mot de passe</label>
                                <input class="form-control" required type="password" name="password">
                            </div>

                            <button name="submit" type="submit" class="btn btn-danger btn-lg mb-2">Se
                                connecter</button>
                        </form>
                    </div>
                </div>
            </div>
    </body>

</html>