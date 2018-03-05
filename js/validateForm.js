function NotAllBlank() {

    var tbs = document.getElementsByClassName("textbox");
    for (var i = 0; i < tbs.length; i++) {
        if (tbs[i].value != "")
            return true;
    }
    alert("Please fill at least one field to search! ");
    return false;
}