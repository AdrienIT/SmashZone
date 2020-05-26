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
	<title>Login</title>
</head>
<body>
	<div>
		<h1>Admin page</h1>
		<div>
			<div></div>	
			<div>
				<div>
					<h3>Login</h3>
					<form method="post">
						<?php if (isset($err)): ?>
							<div><?php echo $err ?></div>
						<?php endif ?>
						<div>
							<label>Username</label>
							<input required type="text" name="username">
						</div>
						<div>
							<label>Password</label>
							<input required type="password" name="password">
						</div>
						
						<div>
							<button name="submit">Login</button>
						</div>
					</form>
				</div>	
			</div>
			<div></div>	<br>
			<a href="../index.php">Back</a>
		</div>
	</div>
</body>
</html>