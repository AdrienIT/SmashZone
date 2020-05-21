<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="../style/style.css" rel="stylesheet">
    <title>Liste des offres</title>
</head>

<body>
    <div class="filter">
        <h1>Recherche des offres de partenaires</h1>
        <h2>Filtrez votre recherche</h2>
        <form method="post">
            <label for="class_min">Classement minimum :</label>
            <select name="class_min" id="class_min">
                <option value="40">--Aucun--</option>
                <option value="30.5">30/5</option>
                <option value="30.4">30/4</option>
                <option value="30.3">30/3</option>
                <option value="30.2">30/2</option>
                <option value="30.1">30/1</option>
                <option value="30">30</option>
                <option value="15.5">15/5</option>
                <option value="15.4">15/4</option>
                <option value="15.3">15/3</option>
                <option value="15.2">15/2</option>
                <option value="15.1">15/1</option>
                <option value="15">15</option>
                <option value="5.6">5/6</option>
                <option value="4.6">4/6</option>
                <option value="3.6">3/6</option>
                <option value="2.6">2/6</option>
                <option value="1.6">1/6</option>
                <option value="0">0</option>
            </select>
            <label for="class_max">Classement maximum :</label>
            <select name="class_max" id="class_max">
                <option value="0">--Aucun--</option>
                <option value="30.5">30/5</option>
                <option value="30.4">30/4</option>
                <option value="30.3">30/3</option>
                <option value="30.2">30/2</option>
                <option value="30.1">30/1</option>
                <option value="30">30</option>
                <option value="15.5">15/5</option>
                <option value="15.4">15/4</option>
                <option value="15.3">15/3</option>
                <option value="15.2">15/2</option>
                <option value="15.1">15/1</option>
                <option value="15">15</option>
                <option value="5.6">5/6</option>
                <option value="4.6">4/6</option>
                <option value="3.6">3/6</option>
                <option value="2.6">2/6</option>
                <option value="1.6">1/6</option>
                <option value="0">0</option>
            </select>
            <br>
            <br>
            <label for="age_min">Âge minimum :</label>
            <input type="number" id="age_min" name="age_min" min="3" max="100" value="3">
            <label for="age_max">Âge maximum :</label>
            <input type="number" id="age_max" name="age_max" min="3" max="100" value="100">
            <br>
            <br>
            <label for="seniority">Ancienneté maximum de l'offre</label>
            <select name="seniority" id="seniority">
                <option value="">--Aucun--</option>
                <option value="7">1 semaine</option>
                <option value="31">1 mois</option>
                <option value="186">6 mois</option>
                <option value="365">1 an</option>
            </select>
            <br>
            <br>
            <label for="order">Trier par :</label>
            <select name="order" id="order">
                <option value="date">Date</option>
                <option value="classement">Classement</option>
                <option value="age">Âge</option>
            </select>
            <select name="type_order" id="order">
                <option value="DESC">Descendant</option>
                <option value="ASC">Ascendant</option>
            </select>
            <br>
            <br>
            <p>Cochez vos disponibilités</p>
            <table id="disponbilite">
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
            <button name="submit" id="search">Rechercher</button>
        </form>
        <?= var_dump($_POST) ?>
    </div>
    <div class="list_offer">
        <h2>Dernières offres</h2>
    </div>
</body>

</html>