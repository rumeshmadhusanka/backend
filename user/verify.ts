$(function () {
    $("#verifyBtn").on('click',verify);
});
async function verify(){
    let form =  new FormData();
    form.append("select","VERIFY_EMAIL");
    let res=  await fetch("userAll.php",{
        method: "POST",
        body:form
    });
    let data = await res.text();
    console.log(data);
}
