<?php
include_once 'config.php';

$users = $db->query('SELECT * FROM users');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table style="border: 1px solid black;">
        <tbody style="border: 1px solid black;" >
        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;">Pseudo</td>
            <td style="border: 1px solid black;">Nom</td>
            <td style="border: 1px solid black;">Prenom</td>
            <td style="border: 1px solid black;">Classement</td>
            <td style="border: 1px solid black;">telephone</td>
            <td style="border: 1px solid black;">amis ?</td>
        </tr>
            <?php while ($u = $users->fetch()) { ?>
                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;"><?= $u['pseudo'] ?></td>
                    <td style="border: 1px solid black;"><?= $u['nom'] ?></td>
                    <td style="border: 1px solid black;"><?= $u['prenom'] ?></td>
                    <td style="border: 1px solid black;"><?= $u['classement'] ?></td>
                    <td style="border: 1px solid black;"><?= $u['telephone'] ?></td>
                    <td style="border: 1px solid black;"><a href="add_friend.php">Add friend</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>