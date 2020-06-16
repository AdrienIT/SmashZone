<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../config.php');
session_start();
if (isset($_POST["submit"])) {
    $title = "Résultats de votre recherche";
    $query = "SELECT t.tournoi_id, t.date_debut, t.date_fin, c.nom_club, t.age_min, t.age_max FROM tournois t INNER JOIN clubs c ON (t.club_id = c.club_id) 
                AND t.age_min >= :age_min
                AND t.age_max <= :age_max
                AND (c.postal_code LIKE '&'";
    $all_dep = explode("-", $_POST["dep"]);
    foreach ($all_dep as $dep) {
        $query = $query . " OR c.postal_code LIKE '$dep%'";
    }
    $query = $query . ")
                        ORDER BY t.date_debut ASC";

    $query = $db->prepare($query);
    $query->bindParam(":age_min", $_POST["age_min"]);
    $query->bindParam(":age_max", $_POST["age_max"]);
    $query->execute();
    $liste_tournois = $query->fetchAll();
} else {
    $query = $db->prepare("SELECT t.tournoi_id, t.date_debut, t.date_fin, c.nom_club, t.age_min, t.age_max FROM tournois t INNER JOIN clubs c ON (t.club_id = c.club_id) ORDER BY t.date_debut ASC");
    $query->execute();
    $liste_tournois = $query->fetchAll();
}
$all_notifs = "none";

if (!isset($_SESSION["user_id"])) {
    $connect = "Se connecter/S'inscrire";
} else {
    $connect = "Mon compte";
    $query = $db->prepare("SELECT n.*, u.pseudo FROM notifications n INNER JOIN users u ON (n.id_link = u.user_id) WHERE n.vu = 0 AND n.user_id = :id ORDER BY n.date ASC");
    $query->bindParam(":id", $_SESSION["user_id"]);
    $query->execute();
    $all_notifs = $query->fetchAll();
}

if (!isset($_SESSION["admin_id"])) {
    $connect = "Se connecter/S'inscrire";
} else {
    $connect = "Mon compte";
}

if (!isset($_SESSION["club_id"])) {
    $connect = "Se connecter/S'inscrire";
} else {
    $connect = "Mon compte";
}
?>
<html>

<head>
    <title>Liste des tournois</title>

    <!-- Important ! -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../style/favicon.ico" />
    <meta charset="utf-8">
    <!-- -->

    <!-- Scripts au chargement de la page -->
    <link href="../style/offre.css" rel="stylesheet">
    <script src="../script/checkbox.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../style/jquery-jvectormap-2.0.5.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- <script src="../script/jquery.js"></script> -->
    <script src="../script/jquery-jvectormap-2.0.5.min.js"></script>
    <script src="../script/map_fr.js"></script>
    <script src="../script/dep_fr.js"></script>

    <link href="../style/notification.css" rel="stylesheet">
    <link href="../style/style.css" rel="stylesheet">
    <link href="../style/home.css" rel="stylesheet">
    <link href="../style/tournoi_preview.css" rel="stylesheet">
    <link href="../style/calendar.css" rel="stylesheet">

    <script>
        var notifs = <?php echo json_encode($all_notifs) ?>
    </script>
    <!-- Scripts au chargement de la page -->

</head>

<body onload="loadNotifi(notifs)">

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-xl navbar-dark mb-4" style="background-color: #264653; height: 55px;">
        <a class="navbar-brand main" href="../index.php">
            <img class="main" src="../style/SmashZone2.png" /><img class="ball" src="../style/SmashZoneIcon.png" />
        </a>

        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03" style="background-color: #264653;">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-right text-right">
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../offres/list_offers.php'" type="button">Partenaires</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../liste_joueurs.php'" type="button">Joueurs</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../tournois/liste_tournoi.php'" type="button">Tournois</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../classement.php'" type="button">Classement</button>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-outline-warning" onclick="location.href='../liste_clubs.php'" type="button">Clubs</button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-outline-light" onclick="location.href='../offres/new_offer.php'" type="button">Poster une annonce</button>
                </li>
            </ul>

            <div class="icon" onclick="toggleNotifi()" id="notif"></div>
            <div class="notifi-box" id="box">
            </div>
            <button class="btn btn-outline-info my-2 my-sm-0" onclick="location.href='../login_register/login.php'" type="button"><?= $connect ?></button>
        </div>
    </nav>
    <!-- Fin barre de navigation -->


    <div class="filtres-tournoi"></div>
    <div class="liste-tournoi">
        <h1>Calendrier des tournois</h1>
        <div class="filter">
            <button class="btn btn-primary mb-4" onclick="toggleFilters()">Afficher/cacher filtres</button>
            <div class="filter">
                <form method="post">
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
                    <button name="submit" id="search" class="invisible"></button>
                </form>
                <button class="btn btn-primary mb-4" onclick="getDepData()">Rechercher</button>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <h3 class="card-header" id="monthAndYear"></h3>
                <table class="table table-bordered table-responsive-sm" id="calendar">
                    <thead>
                        <tr>
                            <th>Lundi</th>
                            <th>Mardi</th>
                            <th>Mercredi</th>
                            <th>Jeudi</th>
                            <th>Vendredi</th>
                            <th>Samedi</th>
                            <th>Dimanche</th>
                        </tr>
                    </thead>

                    <tbody id="calendar-body">

                    </tbody>
                </table>

                <div class="form-inline">

                    <button class="btn btn-outline-primary col-sm-6" id="previous" onclick="previous()">Précédent</button>

                    <button class="btn btn-outline-primary col-sm-6" id="next" onclick="next()">Suivant</button>
                </div>
                <br />
                <form class="form-inline">
                    <label class="lead mr-2 ml-2" for="month">Aller à : </label>
                    <select class="form-control col-sm-4" name="month" id="month" onchange="jump()">
                        <option value=0>Janvier</option>
                        <option value=1>Fevrier</option>
                        <option value=2>Mars</option>
                        <option value=3>Avril</option>
                        <option value=4>Mai</option>
                        <option value=5>Juin</option>
                        <option value=6>Juillet</option>
                        <option value=7>Aout</option>
                        <option value=8>Septembre</option>
                        <option value=9>Octobre</option>
                        <option value=10>Novembre</option>
                        <option value=11>Decembre</option>
                    </select>


                    <label for="year"></label><select class="form-control col-sm-4" name="year" id="year" onchange="jump()">
                        <option value=1990>1990</option>
                        <option value=1991>1991</option>
                        <option value=1992>1992</option>
                        <option value=1993>1993</option>
                        <option value=1994>1994</option>
                        <option value=1995>1995</option>
                        <option value=1996>1996</option>
                        <option value=1997>1997</option>
                        <option value=1998>1998</option>
                        <option value=1999>1999</option>
                        <option value=2000>2000</option>
                        <option value=2001>2001</option>
                        <option value=2002>2002</option>
                        <option value=2003>2003</option>
                        <option value=2004>2004</option>
                        <option value=2005>2005</option>
                        <option value=2006>2006</option>
                        <option value=2007>2007</option>
                        <option value=2008>2008</option>
                        <option value=2009>2009</option>
                        <option value=2010>2010</option>
                        <option value=2011>2011</option>
                        <option value=2012>2012</option>
                        <option value=2013>2013</option>
                        <option value=2014>2014</option>
                        <option value=2015>2015</option>
                        <option value=2016>2016</option>
                        <option value=2017>2017</option>
                        <option value=2018>2018</option>
                        <option value=2019>2019</option>
                        <option value=2020>2020</option>
                        <option value=2021>2021</option>
                        <option value=2022>2022</option>
                        <option value=2023>2023</option>
                        <option value=2024>2024</option>
                        <option value=2025>2025</option>
                        <option value=2026>2026</option>
                        <option value=2027>2027</option>
                        <option value=2028>2028</option>
                        <option value=2029>2029</option>
                        <option value=2030>2030</option>
                    </select></form>
            </div>
        </div>
    </div>
    <script src="../script/notification2.js"></script>
    <script src="../script/calendar.js"></script>
    <script>
        var liste_tournois = <?php echo json_encode($liste_tournois) ?>;
        showCalendar(currentMonth, currentYear);
    </script>


</body>

</html>