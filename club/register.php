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
        <title>Register</title>
        <link rel="icon" href="../style/favicon.ico" />
    </head>

    <body>
        <div>
            <h1>USERS REGISTRATION</h1>
            <div>
                <div></div>
                <div>
                    <div>
                        <h3>Register</h3>
                        <form method="post">
                            <?php if (isset($err)) : ?>
                            <div><?php echo $err ?></div>
                            <?php endif ?>

                            <?php if (isset($success)) : ?>
                            <div>Successful</div>
                            <?php endif ?>
                            <div>
                                <label>nom_club : </label>
                                <input required type="text" <?php if (isset($nom_club)) : ?>
                                    value="<?php echo $nom_club ?>" <?php endif ?> name="nom_club">
                            </div>
                            <div>
                                <label>Email : </label>
                                <input required type="email" <?php if (isset($email)) : ?> value="<?php echo $email ?>"
                                    <?php endif ?> name="email">
                            </div>
                            <div>
                                <div>
                                    <label>Ville : </label>
                                    <input required type="ville" <?php if (isset($ville)) : ?>
                                        value="<?php echo $ville ?>" <?php endif ?> name="ville">
                                </div>
                                <div>
                                    <label>Code Postal : </label>
                                    <input required type="postal_code" <?php if (isset($postal_code)) : ?>
                                        value="<?php echo $postal_code ?>" <?php endif ?> name="postal_code">
                                </div>
                                <div>
                                    <label>Téléphone : </label>
                                    <input required type="telephone" <?php if (isset($telephone)) : ?>
                                        value="<?php echo $telephone ?>" <?php endif ?> name="telephone">
                                </div>
                                <div>
                                    <label>Password : </label>
                                    <input required type="password" name="password">
                                </div>
                                <div>
                                    <label>Confirmation Password : </label>
                                    <input required type="password_confirm" name="password_confirm">
                                </div>
                            </div>
                            <div>
                                <button name="submit">Register</button>
                            </div>
                            <p>Tu as deja un compte ? <a href="login.php">Connecte toi !</a></p>
                        </form>
                    </div>
                </div>
                <div></div>

            </div>
        </div>
    </body>

</html>