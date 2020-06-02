<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../config.php');
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login_register/login.php");
}
if (!isset($_SESSION["user_id"])) {
    $connect = "Se connecter/S'inscrire";
} else {
    $connect = "Mon compte";
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
        <link rel="icon" href="../style/favicon.ico" />
        <meta charset="UTF-8">

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

        <title>Postuler</title>
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
            <div class="collapse navbar-collapse rubriques" id="navbarNav">
                <ul class=" navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item rubriquecolor">
                        Recherchez :
                    </li>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='list_offers.php'" type="button">Partenaires</button>
                    </form>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='../liste_joueurs.php'" type="button">Joueurs</button>
                    </form>
                    <form class="form-inline">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='recherchejouer.php'" type="button">Tournois</button>
                    </form>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <button class="btn btn-outline-info my-2 my-sm-0"
                        onclick="location.href='../login_register/login.php'" type="button"><?= $connect ?></button>
                </form>
            </div>
        </nav>

        <h1>Postuler une demande de partenaire</h1>
        <div class="container">
            <form method="post" id="offer">
                <p>Description de votre demande</p>
                <textarea class="form-control mb-4" name="description" form="offer" rows="5"
                    placeholder="Description"></textarea>
                <p>Cochez vos disponibilités</p>
                <table class="tableoffer mb-3">
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
                <button name="submit" id="offer" type="submit" class="btn btn-primary">Poster</button>
            </form>
            <?php
        if (isset($msg)) { ?>
            <p><?= $msg ?></p>
            <?php } ?>
        </div>

        <!-- <footer class="footer font-small pt-2" style="background-color: #264653; color: #2a9d8f">
            <div class="container" style="background-color: #264653;">
                <div class="row justify-content-around">
                    <a href="http://endless.horse/">
                        <img class="imgfooter" src=../style/contact.png />
                    </a>
                    <a href="http://corndog.io/">
                        <img class="imgfooter" src=../style/github.png />
                    </a>
                    <a href="https://ynov-bordeaux.com/">
                        <img class="imgfooter" src=../style/ynov.png />
                    </a>
                    <a href="https://twitter.com/FantHaxV1">
                        <img class="imgfooter" src=../style/twitter.png />
                    </a>
                </div>
            </div>
            <div class="footer-copyright text-center py-3" style="background-color: #264653; color: white;">© 2020
                Copyright
                <a href="https://thatsthefinger.com/"> SmashZone</a>
            </div>

        </footer> -->
    </body>

</html>