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
