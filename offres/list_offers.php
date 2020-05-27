<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../config.php');
/* session_start();
$_SESSION["user_id"] = 1; */

$all_date = "lun_am-mar_am-mer_am-jeu_am-ven_am-sam_am-dim_am-lun_pm-mar_pm-mer_pm-jeu_pm-ven_pm-sam_pm-dim_pm";

if (isset($_POST["submit"])) {
    $title = "Résultats de votre recherche";
    $query = "SELECT u.*, o.* FROM offres o INNER JOIN users u ON (o.user_id = u.user_id) 
                WHERE u.classement <= :class_min 
                AND u.classement >= :class_max
                AND u.date_naissance <= :date_min
                AND u.date_naissance >= :date_max
                AND o.date_publication >= :seniority
                AND (o.disponibilite LIKE '&'";
    foreach ($_POST as $key => $val) {
        if (strpos($all_date, $key)) {
            $query = $query . " OR o.disponibilite LIKE '%$key%'";
        }
    }
    $query = $query . ")
                        AND (u.postal_code LIKE '&'";
    $all_dep = explode("-", $_POST["dep"]);
    foreach ($all_dep as $dep) {
        $query = $query . " OR u.postal_code LIKE '$dep%'";
    }
    $query = $query . ")
                        ORDER BY " . $_POST["order"] . " " . $_POST["type_order"];

    $date_min = new Datetime(date("Y-m-d H:i:s"));
    $date_min->sub(new DateInterval("P" . $_POST["age_min"] . "Y"));
    $date_min = $date_min->format("Y-m-d H:i:s");

    $date_max = new Datetime(date("Y-m-d H:i:s"));
    $date_max->sub(new DateInterval("P" . $_POST["age_max"] . "Y"));
    $date_max = $date_max->format("Y-m-d H:i:s");

    $seniority = new Datetime(date("Y-m-d H:i:s"));
    $seniority->sub(new DateInterval("P" . $_POST["seniority"]));
    $seniority = $seniority->format("Y-m-d H:i:s");

    $get_offers = $db->prepare($query);
    $get_offers->bindParam(":class_min", $_POST["class_min"]);
    $get_offers->bindParam(":class_max", $_POST["class_max"]);
    $get_offers->bindParam(":date_min", $date_min);
    $get_offers->bindParam(":date_max", $date_max);
    $get_offers->bindParam(":seniority", $seniority);
    $get_offers->execute();
    $list_offers = $get_offers->fetchAll();
} else {
    $title = "Dernières offres";
    $get_offers = $db->prepare("SELECT u.*, o.* FROM offres o INNER JOIN users u ON (o.user_id = u.user_id) ORDER BY o.date_publication DESC");
    $get_offers->execute();
    $list_offers = $get_offers->fetchAll();
}
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../style/favicon.ico" />
        <link href="../style/style.css" rel="stylesheet">
        <link href="../style/offre.css" rel="stylesheet">
        <script src="../script/checkbox.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../style/jquery-jvectormap-2.0.5.css">
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
        <script src="../script/jquery.js"></script>
        <script src="../script/jquery-jvectormap-2.0.5.min.js"></script>
        <script src="../script/map_fr.js"></script>
        <script src="../script/dep_fr.js"></script>
        <title>Liste des offres</title>
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
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-inline rubriquecolor">
                        Effectuer une recherche :
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
                    <form class="form-inline ml-5">
                        <button class="btn btn-outline-light my-2 my-sm-0 rubriquesearch"
                            onclick="location.href='new_offer.php'" type="button">Poster une annonce</button>
                    </form>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <button class="btn btn-outline-info my-2 my-sm-0"
                        onclick="location.href='../login_register/login.php'" type="button">Se
                        connecter/S'inscrire</button>
                </form>
            </div>
        </nav>

        <div class="container">
            <h1>Recherche des offres de partenaires</h1>
            <h2 class="mb-4">Filtrez votre recherche</h2>
            <div class="col-xl text-center">
                <form method="post">
                    <label for="class_min">Classement minimum :</label>
                    <select name="class_min" id="class_min">
                        <option value="40.1">--Aucun--</option>
                        <option value="30.51">30/5</option>
                        <option value="30.41">30/4</option>
                        <option value="30.31">30/3</option>
                        <option value="30.21">30/2</option>
                        <option value="30.11">30/1</option>
                        <option value="30.1">30</option>
                        <option value="15.51">15/5</option>
                        <option value="15.41">15/4</option>
                        <option value="15.31">15/3</option>
                        <option value="15.21">15/2</option>
                        <option value="15.11">15/1</option>
                        <option value="15.1">15</option>
                        <option value="5.61">5/6</option>
                        <option value="4.61">4/6</option>
                        <option value="3.61">3/6</option>
                        <option value="2.61">2/6</option>
                        <option value="1.61">1/6</option>
                        <option value="0.1">0</option>
                    </select>
                    <label for="class_max">Classement maximum :</label>
                    <select name="class_max" id="class_max">
                        <option value="-1">--Aucun--</option>
                        <option value="30.49">30/5</option>
                        <option value="30.39">30/4</option>
                        <option value="30.29">30/3</option>
                        <option value="30.19">30/2</option>
                        <option value="30.09">30/1</option>
                        <option value="29.99">30</option>
                        <option value="15.49">15/5</option>
                        <option value="15.39">15/4</option>
                        <option value="15.29">15/3</option>
                        <option value="15.19">15/2</option>
                        <option value="15.09">15/1</option>
                        <option value="14.99">15</option>
                        <option value="5.59">5/6</option>
                        <option value="4.59">4/6</option>
                        <option value="3.59">3/6</option>
                        <option value="2.59">2/6</option>
                        <option value="1.59">1/6</option>
                        <option value="-1">0</option>
                    </select>
                    <br>
                    <br>
                    <label for="age_min">Âge minimum :</label>
                    <input type="number" id="age_min" name="age_min" min="3" max="100" value="3">
                    <label for="age_max">Âge maximum :</label>
                    <input type="number" id="age_max" name="age_max" min="3" max="100" value="100">
                    <br>
                    <br>
                    <label for="departement">Selectionnez votre zone de recherche :</label>
                    <div class="map_display">
                        <input name="dep" type="text" class="invisible" id="dep">
                        <select id="map-selector" name="departement">
                            <option value="01">(01) Ain </option>
                            <option value="02">(02) Aisne </option>
                            <option value="03">(03) Allier </option>
                            <option value="04">(04) Alpes de Haute Provence </option>
                            <option value="05">(05) Hautes Alpes </option>
                            <option value="06">(06) Alpes Maritimes </option>
                            <option value="07">(07) Ardèche </option>
                            <option value="08">(08) Ardennes </option>
                            <option value="09">(09) Ariège </option>
                            <option value="10">(10) Aube </option>
                            <option value="11">(11) Aude </option>
                            <option value="12">(12) Aveyron </option>
                            <option value="13">(13) Bouches du Rhône </option>
                            <option value="14">(14) Calvados </option>
                            <option value="15">(15) Cantal </option>
                            <option value="16">(16) Charente </option>
                            <option value="17">(17) Charente Maritime </option>
                            <option value="18">(18) Cher </option>
                            <option value="19">(19) Corrèze </option>
                            <option value="20">(2A) Corse du Sud </option>
                            <option value="20">(2B) Haute-Corse </option>
                            <option value="21">(21) Côte d'Or </option>
                            <option value="22">(22) Côtes d'Armor </option>
                            <option value="23">(23) Creuse </option>
                            <option value="24">(24) Dordogne </option>
                            <option value="25">(25) Doubs </option>
                            <option value="26">(26) Drôme </option>
                            <option value="27">(27) Eure </option>
                            <option value="28">(28) Eure et Loir </option>
                            <option value="29">(29) Finistère </option>
                            <option value="30">(30) Gard </option>
                            <option value="31">(31) Haute Garonne </option>
                            <option value="32">(32) Gers </option>
                            <option value="33">(33) Gironde </option>
                            <option value="34">(34) Hérault </option>
                            <option value="35">(35) Ille et Vilaine </option>
                            <option value="36">(36) Indre </option>
                            <option value="37">(37) Indre et Loire </option>
                            <option value="38">(38) Isère </option>
                            <option value="39">(39) Jura </option>
                            <option value="40">(40) Landes </option>
                            <option value="41">(41) Loir et Cher </option>
                            <option value="42">(42) Loire </option>
                            <option value="43">(43) Haute Loire </option>
                            <option value="44">(44) Loire Atlantique </option>
                            <option value="45">(45) Loiret </option>
                            <option value="46">(46) Lot </option>
                            <option value="47">(47) Lot et Garonne </option>
                            <option value="48">(48) Lozère </option>
                            <option value="49">(49) Maine et Loire </option>
                            <option value="50">(50) Manche </option>
                            <option value="51">(51) Marne </option>
                            <option value="52">(52) Haute Marne </option>
                            <option value="53">(53) Mayenne </option>
                            <option value="54">(54) Meurthe et Moselle </option>
                            <option value="55">(55) Meuse </option>
                            <option value="56">(56) Morbihan </option>
                            <option value="57">(57) Moselle </option>
                            <option value="58">(58) Nièvre </option>
                            <option value="59">(59) Nord </option>
                            <option value="60">(60) Oise </option>
                            <option value="61">(61) Orne </option>
                            <option value="62">(62) Pas de Calais </option>
                            <option value="63">(63) Puy de Dôme </option>
                            <option value="64">(64) Pyrénées Atlantiques </option>
                            <option value="65">(65) Hautes Pyrénées </option>
                            <option value="66">(66) Pyrénées Orientales </option>
                            <option value="67">(67) Bas Rhin </option>
                            <option value="68">(68) Haut Rhin </option>
                            <option value="69">(69) Rhône </option>
                            <option value="70">(70) Haute Saône </option>
                            <option value="71">(71) Saône et Loire </option>
                            <option value="72">(72) Sarthe </option>
                            <option value="73">(73) Savoie </option>
                            <option value="74">(74) Haute Savoie </option>
                            <option value="75">(75) Paris </option>
                            <option value="76">(76) Seine Maritime </option>
                            <option value="77">(77) Seine et Marne </option>
                            <option value="78">(78) Yvelines </option>
                            <option value="79">(79) Deux Sèvres </option>
                            <option value="80">(80) Somme </option>
                            <option value="81">(81) Tarn </option>
                            <option value="82">(82) Tarn et Garonne </option>
                            <option value="83">(83) Var </option>
                            <option value="84">(84) Vaucluse </option>
                            <option value="85">(85) Vendée </option>
                            <option value="86">(86) Vienne </option>
                            <option value="87">(87) Haute Vienne </option>
                            <option value="88">(88) Vosges </option>
                            <option value="89">(89) Yonne </option>
                            <option value="90">(90) Territoire de Belfort </option>
                            <option value="91">(91) Essonne </option>
                            <option value="92">(92) Hauts de Seine </option>
                            <option value="93">(93) Seine Saint Denis </option>
                            <option value="94">(94) Val de Marne </option>
                            <option value="95">(95) Val d'Oise </option>
                            <option value="971">(971) Guadeloupe </option>
                            <option value="972">(972) Martinique </option>
                            <option value="973">(973) Guyane </option>
                            <option value="974">(974) Réunion </option>
                            <option value="975">(975) Saint Pierre et Miquelon </option>
                            <option value="976">(976) Mayotte </option>
                        </select>
                    </div>
                    <label for="seniority">Ancienneté maximum de l'offre : </label>
                    <select name="seniority" id="seniority">
                        <option value="20Y">--Aucun--</option>
                        <option value="7D">1 semaine</option>
                        <option value="1M">1 mois</option>
                        <option value="6M">6 mois</option>
                        <option value="1Y">1 an</option>
                    </select>
                    <br>
                    <br>
                    <label for="order">Trier par :</label>
                    <select name="order" id="order">
                        <option value="o.date_publication">Date</option>
                        <option value="u.classement">Classement</option>
                        <option value="u.date_naissance">Âge</option>
                    </select>
                    <select name="type_order" id="order">
                        <option value="DESC">Plus grand au plus petit</option>
                        <option value="ASC">Plus petit au plus grand</option>
                    </select>
                    <br>
                    <br>
                    <p>Cochez vos disponibilités</p>
                    <table class="tableoffer">
                        <tr>
                            <th><input type="checkbox" id="allcb" name="allcb" onclick="checkAll(this, 'lun')">Lundi
                            </th>
                            <th><input type="checkbox" id="allcb" name="allcb" onclick="checkAll(this, 'mar')">Mardi
                            </th>
                            <th><input type="checkbox" id="allcb" name="allcb" onclick="checkAll(this, 'mer')">Mercredi
                            </th>
                            <th><input type="checkbox" id="allcb" name="allcb" onclick="checkAll(this, 'jeu')">Jeudi
                            </th>
                            <th><input type="checkbox" id="allcb" name="allcb" onclick="checkAll(this, 'ven')">Vendredi
                            </th>
                            <th><input type="checkbox" id="allcb" name="allcb" onclick="checkAll(this, 'sam')">Samedi
                            </th>
                            <th><input type="checkbox" id="allcb" name="allcb" onclick="checkAll(this, 'dim')">Dimanche
                            </th>
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
                    <button name="submit" id="search" class="invisible"></button>
                </form>
                <button onclick="getDepData()" type="button" class="btn btn-primary text-center">Rechercher</button>
            </div>

            <div class="list_offer">
                <h2><?= $title ?></h2>
                <?php foreach ($list_offers as $offre) {
            $nom = $offre["nom"];
            $prenom = $offre["prenom"];
            if (strpos(strval($offre["classement"]), ".")) {
                $classement = explode(".", strval($offre["classement"]));
                $classement = $classement[0] . "/" . $classement[1];
            } else {
                $classement = strval($offre["classement"]);
            }
            $birth_date = new DateTime($offre["date_naissance"]);
            $today = new DateTime(date("Y-m-d H:i:s"));
            $age =  $today->diff($birth_date)->format("%Y");
            $description = $offre["description"];
            $publi = new DateTime(strval($offre["date_publication"]));
            $date_publi = $publi->format("d/m/Y H:i:s"); ?>
                <div class="offre">
                    <h3><?= $nom . " " . $prenom ?></h3>
                    <p><?= $age . " ans - " . $classement ?></p>
                    <i><?= $date_publi ?></i>
                    <p><?= $description ?></p>

                </div>
            </div>
            <?php } ?>

        </div>
    </body>

</html>