$(function () {
    $("#search").on('keyup', search)
    console.log("start");
});

function search() {
    let input = <string>($('#search').val());
    let endpoint = <HTMLElement><unknown>(document.getElementById("b"));
    console.log("inside search");
    if (input == "") {
        console.log("empty query");
        endpoint.innerHTML = "";
    }
    $.ajax({
        url: "search.php",
        type: "GET",
        data: {
            keyword: input,
            table: "service"
        },
        success: function (data) {
            console.log("Ajax sucess");
            if (data != 'NULL') {
                let ans;
                try {
                    ans = JSON.parse(data);
                } catch (e) {
                    console.log("json parse error");
                    return;
                }
                endpoint.innerHTML = "";
                for (let i = 0; i < ans.length; i++) {
                    endpoint.innerHTML += (ans[i].service_name);
                }

            } else {
                endpoint.innerHTML = "";
                console.log("NULL");
            }
        },
        error: function (data) {
            console.log("Error" + data);
        }
    });
}
