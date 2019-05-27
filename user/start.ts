$(function () {
    $("#submitLogin").on('click', loginUser);
    $("#signUpBtn").on('click',signUpUser);
});

async function loginUser() {
    let login = <HTMLFormElement>document.getElementById("loginForm");
    let form = new FormData(login);
    form.append("select", "LOGIN");
    let response = await fetch('userAll.php', {
        method: "POST",
        body: form
    });
    console.log(response);
    let resText = await response.text();
    if (resText=="SUCCESS"){
        window.location.replace("service page.html");
    }
}

// @ts-ignore
function checkUserName(): boolean {
    // @ts-ignore
    let name = document.getElementById("userName").value;
    // @ts-ignore
    document.getElementById("alertBox").setAttribute("style", "visibility: hidden");
    //TODO validate
    return true;
}


// @ts-ignore
function checkTele(): boolean {
    let term = (<HTMLInputElement>document.getElementById("tele")).value;
    let pattern = /^[0-9]{9,10}/;
    let re = new RegExp(pattern);
    if (re.test(term)) {
    (<HTMLInputElement>document.getElementById("alertBox")).setAttribute("style", "visibility: hidden");
    return true;
    }else{
        console.log("Invalid");
        return false;
    }

}


// @ts-ignore
function checkEmail(): boolean {
    let term = (<HTMLInputElement>document.getElementById("email")).value;
    let pattern =/^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let re = new RegExp(pattern);
    if (re.test(term)) {
        console.log("Email valid");
        (<HTMLElement>document.getElementById("alertBox")).setAttribute("style", "visibility: hidden");
        return true;
    } else {
        console.log("Invalid");
        return false;
    }


}


// @ts-ignore
function checkProfilePic(): boolean {
    // @ts-ignore
    let name = document.getElementById("profilePic").value;
    // @ts-ignore
    document.getElementById("alertBox").setAttribute("style", "visibility: hidden");
    //TODO validate
    return true;
}


// @ts-ignore
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

async function signUpUser() {
    let form = new FormData(<HTMLFormElement>document.getElementById("signUpForm"));
    form.append("select","SIGN_UP");
    let res = await fetch("userAll.php",{
        method:"POST",
        body:form
    });
    let text = await res.text();
    if (text=="SUCCESS"){
        alert("Sign up successful. Please login to continue");
    } else {
        alert("Error. Try again");//todo replace alerts
    }
}
