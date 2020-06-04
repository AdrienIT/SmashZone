$(document).ready(function() {

    $("#map-selector").css("display", "none");

    $("#map-selector").parent().append("<div id='container-map-selector'></div>");

    var map = new jvm.Map({
        container: $("#container-map-selector"),
        map: 'fr_merc',
        regionsSelectable: true,

        onRegionSelected: function() {

            $("#map-selector").val("");

            $.each(map.getSelectedRegions(), function(index, region) {
                $("#map-selector option[value=" + region + "]").prop("selected", true);
            });
        }
    });
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