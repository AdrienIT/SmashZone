$(document).ready(function() {
    //on masque le select classique
    $("#map-selector").css("display", "none");
    //on ajoute un div #container-map-selector qui contiendra la carte
    $("#map-selector").parent().append("<div id='container-map-selector'></div>");
    //on initie la carte sur cet élément
    var map = new jvm.Map({
        container: $("#container-map-selector"),
        map: 'fr_merc',
        regionsSelectable: true,
        //à chaque clic sur un département
        onRegionSelected: function() {
            //on vide le select
            $("#map-selector").val("");
            //et on sélectionne chaque options correspondant au département sélectionné sur la carte
            $.each(map.getSelectedRegions(), function(index, region) {
                $("#map-selector option[value=" + region + "]").prop("selected", true);
            });
        }
    });
    //au départ si des options du select sont présélectionnés, on les sélectionnes sur la carte
    $("#map-selector option:selected").each(function() {
        map.setSelectedRegions($(this).val());
    });
});


function getDepData() {
    var selected_dep = document.getElementsByTagName("path")
    var val = ""
    for (var i = 0; i < selected_dep.length; i++) {
        element = selected_dep[i].attributes
        if (typeof(element) !== 'undefined' && element["fill"]["value"] == "yellow") {
            val += element["data-code"]["value"].substring(3) + "-"
        }

    }
    val = val.substring(0, val.length - 1)
    dep_form = document.getElementById("dep")
    dep_form.setAttribute('value', val)
    document.getElementById("search").click();
}