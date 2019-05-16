function logout() {
    let form = new FormData();
    form.append("select", "LOGOUT");
    let res = fetch("ServiceStationAll.php", {
        method: "POST",
        body: form
    });
    res.then(function (data) {
        window.location.replace("start.html");
    });
    res.catch(function () {
        alert("Could not log out try again");
    })

}