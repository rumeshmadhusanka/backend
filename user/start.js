"use strict";
$(function () {
    $("#submitLogin").on('click', loginUser);
    $("#signUpBtn").on('click', signUpUser);
});
async function loginUser() {
    let login = document.getElementById("loginForm");
    let form = new FormData(login);
    form.append("select", "LOGIN");
    let response = await fetch('userAll.php', {
        method: "POST",
        body: form
    });
    console.log(response);
    let resText = await response.text();
    if (resText == "SUCCESS") {
        window.location.replace("service page.html");
    }
}
// @ts-ignore
function checkUserName() {
    let term = document.getElementById("userName").value;
    let pattern = /^[a-z A-Z 0-9]+([_ -])?[a-zA-Z0-9]*$/;
    let re = new RegExp(pattern);
    if (re.test(term)) {
        document.getElementById("alertBox").setAttribute("style", "visibility: hidden");
        return true;
    }
    else {
        console.log("Invalid");
        return false;
    }
}
// @ts-ignore
function checkTele() {
    let term = document.getElementById("tele").value;
    let pattern = /^[0-9]{9,10}/;
    let re = new RegExp(pattern);
    if (re.test(term)) {
        document.getElementById("alertBox").setAttribute("style", "visibility: hidden");
        return true;
    }
    else {
        console.log("Invalid");
        return false;
    }
}
// @ts-ignore
function checkEmail() {
    let term = document.getElementById("email").value;
    let pattern = /^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let re = new RegExp(pattern);
    if (re.test(term)) {
        console.log("Email valid");
        document.getElementById("alertBox").setAttribute("style", "visibility: hidden");
        return true;
    }
    else {
        console.log("Invalid");
        return false;
    }
}
async function signUpUser() {
    let form = new FormData(document.getElementById("signUpForm"));
    form.append("select", "SIGN_UP");
    let res = await fetch("userAll.php", {
        method: "POST",
        body: form
    });
    let text = await res.text();
    if (text == "SUCCESS") {
        alert("Sign up successful. Please login to continue");
    }
    else {
        alert("Error. Try again"); //todo replace alerts
    }
}
