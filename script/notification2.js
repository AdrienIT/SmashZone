var box = document.getElementById("box");
var notif_icon = document.getElementById("notif");
var down = false;

function destroy_notifs() {
    box.innerHTML = '';
    var h3 = document.createElement("h3");
    h3.innerText = "Aucune nouvelle notification 😢";
    box.appendChild(h3);

}

function ImageExist(url) {
    var img = new Image();
    img.src = url;
    return img.height != 0;
}

function toggleNotifi() {
    if (down) {
        box.style.height = '0px';
        box.style.opacity = 0;
        down = false;
        notif_icon.addEventListener("click", destroy_notifs)
    } else {
        box.style.height = '510px';
        box.style.opacity = 1;
        down = true;
        notif_icon.innerHTML = '';
        var i = document.createElement("i");
        i.classList.add("material-icons");
        i.innerText = "notifications_none";
        notif_icon.appendChild(i)
        $.ajax({
            type: "POST",
            url: '../unsee_query.php',
            dataType: 'json',
            data: { functionname: 'unsee_query' },

            success: function(obj, textstatus) {
                if (!('error' in obj)) {
                    result = obj.result;
                } else {
                    console.log(obj.error);
                }
            }
        });

    }
}

function loadNotifi(notifs) {

    if (notifs != "none") {

        if (notifs.length == 0) {

            var icon = document.getElementById("notif");
            var i = document.createElement("i");
            i.classList.add("material-icons");
            i.innerText = "notifications_none";
            icon.appendChild(i)
            box.innerHTML = '';
            var h3 = document.createElement("h3");
            h3.innerText = "Aucune nouvelle notification 😢";
            box.appendChild(h3);
        } else {

            var icon = document.getElementById("notif");
            var i = document.createElement("i");
            i.classList.add("material-icons");
            i.innerText = "notifications_none";
            var span1 = document.createElement("span");
            span1.innerText = notifs.length;
            icon.appendChild(i)
            icon.appendChild(span1);

            var title = document.createElement("h2");
            title.innerText = "Notifications ";
            var span2 = document.createElement("span");
            span2.innerText = notifs.length;
            title.appendChild(span2);
            box.appendChild(title);

            for (var i = 0; i < notifs.length; i++) {

                var link = document.createElement("a")
                link.href = "../relations/index.php"
                var item = document.createElement("div");
                item.classList.add("notifi-item");
                var img = document.createElement("img");
                if (ImageExist("../login_register/" + notifs[i]["pseudo"] + "/" + notifs[i]["pseudo"] + ".png")) {
                    img.src = "../login_register/" + notifs[i]["pseudo"] + "/" + notifs[i]["pseudo"] + ".png";
                } else {
                    img.src = "../login_register/default-user.png"
                }
                var text = document.createElement("div");
                text.classList.add("contains_text");
                var notif_title = document.createElement("h4");
                notif_title.innerText = notifs[i]["type"];
                var desc = document.createElement("p");
                desc.innerText = notifs[i]["description"];
                text.appendChild(notif_title);
                text.appendChild(desc);
                item.appendChild(img);
                item.appendChild(text)
                link.appendChild(item)
                box.appendChild(link)
            }
        }
    }
}