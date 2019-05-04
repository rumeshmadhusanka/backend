$(function () {
    $.ajax({
        url: "userGetProfileInfo.php", method: "GET"
    }).then(function (dataEx) {
        let data = JSON.parse(dataEx);
        let person = data[0];
        console.log(person);
        // @ts-ignore
        document.getElementById("name").innerHTML = (person.u_name).toString();
        // @ts-ignore
        document.getElementById("tele").innerHTML = (person.u_tele).toString();
        // @ts-ignore
        document.getElementById("email").innerHTML = (person.u_email).toString();
        // @ts-ignore
        $('#pic').attr('src', "../" + person.u_profile_pic);
    });

})
;
