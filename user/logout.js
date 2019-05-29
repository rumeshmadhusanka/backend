"use strict";
function logoutUser() {
    let form = new FormData();
    form.append("select", "LOGOUT");
    let res = fetch("userAll.php", {
        method: "POST",
        body: form
    });
    res.then(function (data) {
        window.location.replace("start.html");
    });
    res.catch(function () {
        window.location.replace("start.html");
    });
}
