let data=[{"u_id":1,"u_name":"susan",
    "u_tele":767261089,
    "u_password":"b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e597" +
        "6ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86",
    "u_email":"susan@gmail.com",
    "u_profile_pic":"uploads\/uploaded-5cc58f247cc6e.jpg"}];
let person=data[0];
$(function () {
    // @ts-ignore
    document.getElementById("name").innerHTML = (person.u_name).toString();
    // @ts-ignore
    document.getElementById("tele").innerHTML = (person.u_tele).toString();
    // @ts-ignore
    document.getElementById("email").innerHTML = (person.u_email).toString();
    // @ts-ignore
    $('#pic').attr('src', person.u_profile_pic);
});
