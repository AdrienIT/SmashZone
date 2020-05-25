function checkAll(bx, id) {
    var cbs = document.getElementsByTagName('input');
    for (var i = 0; i < cbs.length; i++) {
        if (cbs[i].type == 'checkbox' && cbs[i].id.includes(id)) {
            cbs[i].checked = bx.checked;
        }
    }
}