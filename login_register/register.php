<?php
include_once '../config.php';
/* session_start();
if (isset($_SESSION["user_id"])) {
	header('location: ./home.php');
} */

$err = '';

$today = date("Y-m-d");


if (isset($_POST["submit"])) {

	$pseudo = htmlspecialchars($_POST["pseudo"]);
	$email = htmlspecialchars($_POST["email"]);
	$ville = htmlspecialchars($_POST['ville']);
	$age = htmlspecialchars($POST['age']);
	$telephone = (int) htmlspecialchars($_POST['telephone']);
	$postal_code = (int) htmlspecialchars($_POST['postal_code']);
	$password = $_POST["password"];
	$password_confirm = $_POST["password_confirm"];
	

	$query1 = $db->prepare("SELECT pseudo FROM users WHERE pseudo = ? ");
	$query1->execute([$pseudo]);
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
				if ((strlen($postal_code) > 6) or (01000 < $postal_code) or ($postal_code > 95880)) {
					$err = "Votre code postal n'a pas été prit en compte";
					echo $err;
				} else {
					$password = md5($password);
					$query = "INSERT INTO users(pseudo,email,ville,telephone,postal_code,password,age) VALUES(:pseudo,:email,:ville,:telephone,:postal_code,:password,:age)";
					$query = $db->prepare($query);
					$query->bindParam(':pseudo', $pseudo);
					$query->bindParam(':email', $email);
					$query->bindParam(':ville', $ville);
					$query->bindParam(':telephone', $telephone);
					$query->bindParam(':postal_code', $postal_code);
					$query->bindParam(':password', $password);
					$query->bindParam(':age', $age);
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
	<title>Register</title>
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
							<label>Pseudo : </label>
							<input required type="text" <?php if (isset($pseudo)) : ?> value="<?php echo $pseudo ?>" <?php endif ?> name="pseudo">
						</div>
						<div>
							<label>Email : </label>
							<input required type="email" <?php if (isset($email)) : ?> value="<?php echo $email ?>" <?php endif ?> name="email">
						</div>
						<div>
							<div>
								<label>Ville : </label>
								<input required type="ville" <?php if (isset($ville)) : ?> value="<?php echo $ville ?>" <?php endif ?> name="ville">
							</div>
							<div>
								<label>Code Postal : </label>
								<input required type="postal_code" <?php if (isset($postal_code)) : ?> value="<?php echo $postal_code ?>" <?php endif ?> name="postal_code">
							</div>
							<div>
								<label>Téléphone : </label>
								<input required type="telephone" <?php if (isset($telephone)) : ?> value="<?php echo $telephone ?>" <?php endif ?> name="telephone">
							</div>
							<div>
								<label>Date de naissance : </label>
								<input type="date" id="start" name="trip-start" value="2000-01-01" min="1920-01-01" max="<?= $today ?>">
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