<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../config.php');
session_start();
$_SESSION["user_id"] = 1;

if (!isset($_SESSION["user_id"])) {
    header("Location: ../index.php");
}

if (isset($_POST["submit"])) {
    $dispo = "";
    foreach ($_POST as $key => $val) {
        if ($val == "true") {
            $dispo = $dispo . $key . "-";
        }
    }
    if ($dispo == "" || $_POST["description"] == "") {
        $msg = "Vous devez remplir tous les champs !";
    } else {
        $dispo = substr($dispo, 0, -1);
        $insert = $db->prepare("INSERT INTO offres (user_id, description, disponibilite) VALUES (:id, :descr, :dispo)");
        $insert->bindParam(":id", $_SESSION["user_id"]);
        $insert->bindParam(":descr", $_POST["description"]);
        $insert->bindParam(":dispo", $dispo);
        $insert->execute();
        $msg = "Votre offre a été publiée avec succès !";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <link href="../style/style.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Postuler</title>
</head>

<body>
    <h1>Postuler une demande de partenaire</h1>
    <div class="new_offer">
        <form method="post" id="offer">
            <p>Descritpion de votre demande</p>
            <textarea name="description" form="offer" cols="30" rows="5" placeholder="Description"></textarea>
            <p>Cochez vos disponibilités</p>
            <table id="offer">
                <tr>
                    <th>Lundi</th>
                    <th>Mardi</th>
                    <th>Mercredi</th>
                    <th>Jeudi</th>
                    <th>Vendredi</th>
                    <th>Samedi</th>
                    <th>Dimanche</th>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" id="lun_am" name="lun_am" value="true">
                        <label for="lun_am">Matin</label>
                    </td>
                    <td>
                        <input type="checkbox" id="mar_am" name="mar_am" value="true">
                        <label for="mar_am">Matin</label>
                    </td>
                    <td>
                        <input type="checkbox" id="mer_am" name="mer_am" value="true">
                        <label for="mer_am">Matin</label>
                    </td>
                    <td>
                        <input type="checkbox" id="jeu_am" name="jeu_am" value="true">
                        <label for="jeu_am">Matin</label>
                    </td>
                    <td>
                        <input type="checkbox" id="ven_am" name="ven_am" value="true">
                        <label for="ven_am">Matin</label>
                    </td>
                    <td>
                        <input type="checkbox" id="sam_am" name="sam_am" value="true">
                        <label for="sam_am">Matin</label>
                    </td>
                    <td>
                        <input type="checkbox" id="dim_am" name="dim_am" value="true">
                        <label for="dim_am">Matin</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" id="lun_pm" name="lun_pm" value="true">
                        <label for="lun_pm">Après-midi</label>
                    </td>
                    <td>
                        <input type="checkbox" id="mar_pm" name="mar_pm" value="true">
                        <label for="mar_pm">Après-midi</label>
                    </td>
                    <td>
                        <input type="checkbox" id="mer_pm" name="mer_pm" value="true">
                        <label for="mer_pm">Après-midi</label>
                    </td>
                    <td>
                        <input type="checkbox" id="jeu_pm" name="jeu_pm" value="true">
                        <label for="jeu_pm">Après-midi</label>
                    </td>
                    <td>
                        <input type="checkbox" id="ven_pm" name="ven_pm" value="true">
                        <label for="ven_pm">Après-midi</label>
                    </td>
                    <td>
                        <input type="checkbox" id="sam_pm" name="sam_pm" value="true">
                        <label for="sam_pm">Après-midi</label>
                    </td>
                    <td>
                        <input type="checkbox" id="dim_pm" name="dim_pm" value="true">
                        <label for="dim_pm">Après-midi</label>
                    </td>
                </tr>
            </table>
            <button name="submit" id="offer">Poster</button>
        </form>
        <?php
        if (isset($msg)) { ?>
            <p><?= $msg ?></p>
        <?php } ?>
    </div>
</body>

</html>