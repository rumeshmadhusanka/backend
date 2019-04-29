$(function () {
    $("#search").on('keydown', search)
});

function search() {
    let input = <string>($('#search').val());
    let endpoint = <HTMLElement><unknown>(document.getElementById("b"));
    if(input==""){

        endpoint.innerHTML = "";
    }
    $.ajax({
        url: "search.php",
        type: "GET",
        data: {keyword: input},
        success: function (data) {
            if (data != 'NULL') {
                let ans;
                try {
                    ans = JSON.parse(data);
                }catch (e) {
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
            console.log("Error"+data);
        }
    });
}
