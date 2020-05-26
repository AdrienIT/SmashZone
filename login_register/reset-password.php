<?php
include_once '../config.php';


if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $query = $db->prepare('SELECT email FROM users WHERE email = :email');
    $query->bindParam(':email', $email);
    $query->execute();
    if ($query->rowCount() > 0) {

        #Section token + lien
        $token = bin2hex(openssl_random_pseudo_bytes(16));

        $url = "http://localhost/smashzone/login_register/change_password.php?token=$token";

        #Section mail

        $mail_smashzone = "smashzone.ynov@gmail.com";

        $to_email = $email;
        $sujet = "Recupération du mot de passe";
        $body = "Pour changer votre mot de passe, merci de cliquer sur ce lien :" . $url;
        $headers = "From: $mail_smashzone";
        if (mail($to_email, $sujet, $body, $headers)) {
            echo "<pre>Un email a été envoyé avec un lien de récupération de mot de passe à cette adresse : $to_email</pre>";
            $query2 = $db->prepare('INSERT INTO reset_password(email,token) VALUES (:email,:token)');
            $query2->bindParam(':email', $email);
            $query2->bindParam(':token', $token);
            $query2->execute();
        } else {
            echo "<pre>L'envoie de mail a échoué</pre>";
        }
    } else {
        echo "<pre>email non disponible</pre>";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Mot de passe oublié</title>
</head>

<body>
    <h1>Réinitialise ton mot de passe</h1>
    <p>Un e-mail vous sera envoyé avec votre nouveau mot de passe !</p>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Mail</label>
        <input required type="text" name="email" placeholder="test@test.com">
        <button name="submit">Recevoir mon mot de passe !</button>
    </form>
</body>

</html>