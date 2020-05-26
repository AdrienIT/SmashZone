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
		$err = "pseudo / Password incorrect";
		echo $err;
	}
}
?>



<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
</head>

<body>
	<div>
		<h1>USERS LOGIN</h1>
		<div>
			<div></div>
			<div>
				<div>
					<h3>Login</h3>
					<form method="post">
						<?php if (isset($err)) : ?>
							<div><?php echo $err ?></div>
						<?php endif ?>
						<div>
							<label>Pseudo</label>
							<input required type="text" name="pseudo">
						</div>
						<div>
							<label>Password</label>
							<input required type="password" name="password">
						</div>

						<div>
							<button name="submit">Login</button>
						</div>
						<p>Pas encore de compte ? <a href="register.php">Inscrit toi !</a></p>
					</form>
				</div>
				<a href="reset-password.php">Mot de passe oublié ?</a>
			</div>
			<div></div>
		</div>
	</div>
</body>

</html>