"use strict";
$(function () {
    displayData();
    $("#picSubmitBtn").on('click', uploadPicture);
    $("#deleteProfileBtn").on('click', deleteProfile);
    $("#upload").on('click', updateData);
    $("#cancelBtn").on("click", displayData);
});
async function displayData() {
    let userName = document.getElementById("userName");
    let email = document.getElementById("email");
    let phone = document.getElementById("tele");
    let city = document.getElementById("city");
    let latitude = document.getElementById("latitude");
    let longitude = document.getElementById("longitude");
    let form = new FormData();
    form.append("select", "GET_STATION_DETAILS");
    let response = await fetch("ServiceStationAll.php", {
        method: "POST",
        body: form
    });
    let st = await response.json();
    let station = st[0];
    //console.log(station.s_name);
    userName.value = station.s_name;
    email.value = station.s_email;
    phone.value = station.s_telephone;
    city.value = station.s_city;
    latitude.value = station.s_latitude;
    longitude.value = station.s_longitude;
    $('#profilePic').attr('src', station.s_picture);
}
async function uploadPicture() {
    let form = new FormData(document.getElementById("picForm"));
    form.append("submit", "true");
    form.append("select", "UPLOAD_PIC");
    let res = await fetch("ServiceStationAll.php", {
        method: "POST",
        body: form
    });
    let status = await res.text();
    if (status == "SUCCESS") {
        displayData();
    }
    else {
        alert("Error when changing profile picture");
    }
}
async function deleteProfile() {
    if (window.confirm("Are you sure you want to delete your profile? ")) { //todo replace confirm
        let email = document.getElementById("deleteEmail").value;
        let password = document.getElementById("deletePassword").value;
        let form = new FormData();
        form.append("email", email);
        form.append("password", password);
        form.append("select", "DELETE_STATION");
        let result = await fetch("ServiceStationAll.php", {
            method: "POST",
            body: form
        });
        let text = await result.text();
        alert(text); //todo replace alert
        setTimeout(() => window.location.replace('../index.html'), 1000);
    }
}
async function updateData() {
    let userName = document.getElementById("userName").value;
    let password = document.getElementById("password1").value;
    let email = document.getElementById("email").value;
    let tele = document.getElementById("tele").value;
    let lat = document.getElementById("latitude").value;
    let long = document.getElementById("longitude").value;
    let city = document.getElementById("city").value;
    if (checkUserName() && checkEmail() && checkTele() && checkProfilePic() && checkPasswordEqual()) {
        // @ts-ignore
        if (document.getElementById("password2").value.toString() == "11111122333") {
            password = ""; //if the dummy password has not changed, send null
        }
    }
    else {
        alert("Error");
    }
    let form = new FormData();
    form.append("select", "UPDATE_SERVICE_STATION");
    form.append("up_name", userName);
    form.append("up_password", password);
    form.append("up_city", city);
    form.append("up_email", email);
    form.append("up_telephone", tele);
    form.append("up_latitude", lat);
    form.append("up_longitude", long);
    let res = await fetch("ServiceStationAll.php", {
        method: "POST",
        body: form
    });
    let resText = await res.text();
    if (resText == "SUCCESS") {
        alert("Profile update successful"); // todo replace alert
    }
    else {
        alert(resText);
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
}
