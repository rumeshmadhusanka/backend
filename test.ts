$(document).ready(function () {
    $("#ajaxCall").click(getData);
    var inp = $("#b");
    function getData() {
        console.log("Bjbegan");
        $.ajax({
            url: "getInfo.php",
            type: "GET",
            crossDomain: true,
            success: function (data) {
                console.log("fbfgn");
                inp.append(data);
            },
            error: function (data) {
                console.log("Error");
            }
        });
    }
});
