$(function () {
    $("#search").on('keydown', search)
});

function search() {
    let inp = $('#b');
    let input = <string>($('#search').val());
    console.log("Bjbegan");
    $.ajax({
        url: "search.php",
        type: "GET",
        data: {keyword: input},
        success: function (data) {
            //console.log(data);

            if (data != 'NULL') {
                let ans = JSON.parse(data);
                let endpoint = <HTMLElement><unknown>(document.getElementById("b"));
                endpoint.innerHTML = "";
                for (let i = 0; i < ans.length; i++) {
                    endpoint.innerHTML += (ans[i].service_name);
                }

            } else {
                console.log("NULL");
            }
        },
        error: function (data) {
            console.log("Error");
        }
    });
}
