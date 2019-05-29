"use strict";
$(function () {
    loadDataFromServer();
    $("#userName").on("keyup", checkUserName);
    $("#tele").on("keyup", checkTele);
    $("#email").on("keyup", checkEmail);
    //$("#profilePicUpload").on("change", checkProfilePic);
    $("#password2").on("keyup", checkPasswordEqual);
    $("#upload").on("click", uploadData);
    $("#picForm").on('submit', (function (e) {
        console.log("in event method");
        e.preventDefault();
        $.ajax({
            url: "../common/upload.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log("Profile pic ajax success");
                let form = new FormData();
                form.append("select", "GET_PROFILE_INFO");
                let res = fetch("userAll.php", {
                    method: "POST",
                    body: form
                });
                res.then(function (dataEx) {
                    return dataEx.json();
                }).then(function (data) {
                    let person = data[0];
                    $('#profilePic').attr('src', person.u_profile_pic);
                    console.log("Get new pic from database");
                });
            },
            error: function () {
                console.log("Profile pic upload req failed");
            }
        });
    }));
    $("#deleteProfileBtn").on('click', deleteUserProfile);
});
async function loadDataFromServer() {
    let form = new FormData();
    form.append("select", "GET_PROFILE_INFO");
    let data = await fetch("userAll.php", {
        method: "POST",
        body: form
    });
    let dataEx = await data.json();
    let person = dataEx[0];
    console.log(person);
    // @ts-ignore
    document.getElementById("userName").value = (person.u_name).toString();
    // @ts-ignore
    document.getElementById("tele").value = (person.u_tele).toString();
    // @ts-ignore
    document.getElementById("email").value = (person.u_email).toString();
    // @ts-ignore
    $('#profilePic').attr('src', person.u_profile_pic);
}
function checkUserName() {
    // @ts-ignore
    let name = document.getElementById("userName").value;
    // @ts-ignore
    document.getElementById("alertBox").setAttribute("style", "visibility: hidden");
    //TODO validate
    return true;
}
function checkTele() {
    // @ts-ignore
    let name = document.getElementById("tele").value;
    // @ts-ignore
    document.getElementById("alertBox").setAttribute("style", "visibility: hidden");
    //TODO validate
    return true;
}
function checkEmail() {
    // @ts-ignore
    let name = document.getElementById("email").value;
    // @ts-ignore
    document.getElementById("alertBox").setAttribute("style", "visibility: hidden");
    //TODO validate
    return true;
}
function checkProfilePic() {
    // @ts-ignore
    let name = document.getElementById("profilePic").value;
    // @ts-ignore
    document.getElementById("alertBox").setAttribute("style", "visibility: hidden");
    //TODO validate
    return true;
}
function checkPasswordEqual() {
    console.log("pwchk");
    // @ts-ignore
    document.getElementById("alertBox").setAttribute("style", "visibility: hidden");
    // @ts-ignore
    let p1 = document.getElementById("password1").value;
    // @ts-ignore
    let p2 = document.getElementById("password2").value;
    if (p1 != p2) {
        // @ts-ignore
        document.getElementById("alertBox").setAttribute("style", "visibility: visible");
        // @ts-ignore
        document.getElementById("alertText").innerHTML = ("Passwords does not match");
        console.log("!match");
        return false;
    }
    else {
        // @ts-ignore
        document.getElementById("alertBox").setAttribute("style", "visibility: hidden");
        return true;
    }
}
async function uploadData() {
    let userName = document.getElementById("userName").value;
    let password = document.getElementById("password1").value;
    let email = document.getElementById("email").value;
    let tele = document.getElementById("tele").value;
    if (checkUserName() && checkEmail() && checkTele() && checkProfilePic() && checkPasswordEqual()) {
        // @ts-ignore
        if (document.getElementById("password2").value.toString() == "11111122333") {
            password = ""; //if the dummy password has not changed, send null
        }
        let form = new FormData();
        form.append("select", "UPDATE_PROFILE");
        form.append("up_username", userName);
        form.append("up_password", password);
        form.append("up_email", email);
        form.append("up_telephone", tele);
        let data = await fetch("userAll.php", {
            method: "POST",
            body: form
        });
        let res = await data.text();
        if (res == "SUCCESS") {
            alert("Success");
        }
        else {
            alert("Failed ");
        }
        //todo replace the alerts with something proper
    }
    else {
        alert("Invalid data");
    }
}
function deleteUserProfile() {
    console.log("Trying to delete");
    if (window.confirm("Are you sure you want to delete your profile? ")) { //todo replace confirm
        let email = document.getElementById("deleteEmail").value;
        let password = document.getElementById("deletePassword").value;
        let form = new FormData();
        form.append("email", email);
        form.append("password", password);
        form.append("select", "DELETE_USER");
        let result = fetch("userAll.php", {
            method: "POST",
            body: form
        });
        let text = result.then(function (data) {
            return data.text();
        });
        text.then(function (data) {
            console.log(data);
            alert(data); //todo replace alert
            setTimeout(() => window.location.replace('start.html'), 1000);
        });
    }
}
