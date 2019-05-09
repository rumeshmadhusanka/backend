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
            data: new FormData(<HTMLFormElement>this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                //$("#targetLayer").html(data);
                console.log("Profile pic ajax success");
                $.ajax({
                    url: "userGetProfileInfo.php", method: "GET"
                }).then(function (dataEx) {
                    let data = JSON.parse(dataEx);
                    let person = data[0];
                    $('#profilePic').attr('src',  person.u_profile_pic);
                    console.log("Get new pic from database");
                })
            },
            error: function () {
                console.log("Profile pic upload req failed");
            }
        });
    }))


})
;

function loadDataFromServer(): boolean {
    let success: boolean = false;
    $.ajax({
        url: "userGetProfileInfo.php", method: "GET"
    }).then(function (dataEx) {
        let data = JSON.parse(dataEx);
        let person = data[0];
        console.log(person);
        // @ts-ignore
        document.getElementById("userName").value = (person.u_name).toString();
        // @ts-ignore
        document.getElementById("tele").value = (person.u_tele).toString();
        // @ts-ignore
        document.getElementById("email").value = (person.u_email).toString();
        // @ts-ignore
        $('#profilePic').attr('src', person.u_profile_pic);
        success = true;
    });
    return success;

}

function checkUserName(): boolean {
    // @ts-ignore
    let name = document.getElementById("userName").value;
    // @ts-ignore
    document.getElementById("alertBox").setAttribute("style", "visibility: hidden");
    //TODO validate
    return true;
}

function checkTele(): boolean {
    // @ts-ignore
    let name = document.getElementById("tele").value;
    // @ts-ignore
    document.getElementById("alertBox").setAttribute("style", "visibility: hidden");
    //TODO validate
    return true;

}

function checkEmail(): boolean {
    // @ts-ignore
    let name = document.getElementById("email").value;
    // @ts-ignore
    document.getElementById("alertBox").setAttribute("style", "visibility: hidden");
    //TODO validate
    return true;

}

function checkProfilePic(): boolean {
    // @ts-ignore
    let name = document.getElementById("profilePic").value;
    // @ts-ignore
    document.getElementById("alertBox").setAttribute("style", "visibility: hidden");
    //TODO validate
    return true;
}

function checkPasswordEqual(): boolean {
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
    } else {
        // @ts-ignore
        document.getElementById("alertBox").setAttribute("style", "visibility: hidden");
        return true;
    }
}

function uploadData() {
    let userName = (<HTMLInputElement>document.getElementById("userName")).value;
    let password = (<HTMLInputElement>document.getElementById("password1")).value;
    let email = (<HTMLInputElement>document.getElementById("email")).value;
    let tele = (<HTMLInputElement>document.getElementById("tele")).value;
    if (checkUserName() && checkEmail() && checkTele() && checkProfilePic() && checkPasswordEqual()) {
        // @ts-ignore
        if (document.getElementById("password2").value.toString() == "11111122333") {
            password = "";//if the dummy password has not changed, send null
        }
        $.ajax({
            url: "updateUser.php", method: "POST", data: {
                up_username: userName,
                up_password: password,
                up_email: email,
                up_telephone: tele,
            }
        }).then(function (data) {
            console.log("done in ajax");
            if (data == "SUCCESS") {
                alert("Success");
            } else {
                alert("Failed ")
            }
        }, function () {
            console.log("failed in fail filter")
            alert("Failed in fail filter");
        })
    } else {
        alert("Invalid data");
        console.log("invalid data");
    }
//todo replace the alerts with something proper

}

//todo upload profile picture part

