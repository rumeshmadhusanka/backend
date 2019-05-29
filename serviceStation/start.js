"use strict";
$(function () {
    $("#submitLogin").on('click', login);
    $("#signUpBtn").on('click', signUp);
});
async function login() {
    let login = document.getElementById("loginForm");
    let form = new FormData(login);
    form.append("select", "LOGIN");
    let response = await fetch('ServiceStationAll.php', {
        method: "POST",
        body: form
    });
    console.log(response);
    let resText = await response.text();
    if (resText == "SUCCESS") {
        window.location.replace("servicePage.html");
    }
    else {
        alert("Email or password is incorrect");
    }
}
async function signUp() {
    let sign = document.getElementById("signUpForm");
    let form = new FormData(sign);
    form.append("latitude", document.getElementById("latitude").value);
    form.append("longitude", document.getElementById("longitude").value);
    form.append("select", "ADD_STATION");
    let response = await fetch('ServiceStationAll.php', {
        method: "POST",
        body: form
    });
    console.log(response);
    let resText = await response.text();
    if (resText == "SUCCESS") {
        alert("Sign up successful.please login to continue");
        window.location.replace("start.html");
    }
}