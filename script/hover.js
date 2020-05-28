$(".line").mouseover(function() {
    $(this).children(".preview").show();
}).mouseout(function() {
    $(this).children(".preview").hide();
});