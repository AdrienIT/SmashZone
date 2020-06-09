<?php
include_once '../config.php';

$token = $_GET['token'];

$query = $db->prepare('SELECT email FROM reset_password WHERE token = :token');
$query->bindParam(':token', $token);
$query->execute();
$fetch = $query->fetch();

$email = $fetch['email'];

if (isset($_POST['submit_pass'])) {
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    if ($password1 != $password2) {
        echo "<pre>Les mot de passes ne correspondent pas</pre>";
    } else {
        $password_hash = md5($password1);
        if ($query2 = $db->prepare('UPDATE users SET password = :password WHERE email = :email')) {


            $query2->bindParam('password', $password_hash);
            $query2->bindParam('email', $email);
            $query2->execute();

            echo "<pre>Mot de passe modifié avec succés</pre>";

            $query3 = $db->prepare('DELETE FROM reset_password WHERE email = :email');
            $query3->bindParam(':email', $email);
            $query3->execute();

            header('Location: login.php');
        }
    }
}


/* } */

?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../style/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Change pwd</title>
    </head>

    <body>
        <form action="" method="post">
            <label name="title">Nouveau password</label>
            <input type="password" name="password1" placeholder="Nouveau mot de passe">
            <input type="password" name="password2" placeholder="Nouveau mot de passe">
            <button name="submit_pass">Reset mon mot de passe</button>
        </form>
    </body>

</html>