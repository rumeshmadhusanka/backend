$(function () {
    $("#ajaxCall").on("click",getData);

});

function getData() {
    let inp = $("#b");
    console.log("Bjbegan");
    $ .ajax({
        url: "getInfo.php",
        type: "GET",
        data:{name: 'susan'},
        success: function (data) {
            console.log("fbfgn");
            inp.append(data);
        },
        error: function (data) {
            console.log("Error");
        }
    });
}

$(function () {
    console.log("First line");
    let searchBox= $("#search");
        searchBox.on("keyup",search);
    let input=<string>(searchBox.val());
    let resultDisplay=$("#searchResult");
    function search() {
        $.ajax({
            url:'search.php',
            type: 'GET',
            data: {keyword: input},
            beforeSend:function () {
                console.log(input+"vfbv");

            },
            success: function (data) {
                console.log("Executing");
                resultDisplay.empty();
                resultDisplay.append(data);
            },
            error: function (data) {
                console.log("Error");
            }
        })
    }
});


