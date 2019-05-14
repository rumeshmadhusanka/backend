// $(function () {
//     $("#ajaxCall").on("click",getData);
//
// });
//
// function getData() {
//     let inp = $("#b");
//     console.log("Bjbegan");
//     $ .ajax({
//         url: "getInfo.php",
//         type: "GET",
//         data:{name: 'susan'},
//         success: function (data) {
//             console.log("fbfgn");
//             inp.append(data);
//         },
//         error: function (data) {
//             console.log("Error");
//         }
//     });
// }
//
// $(function () {
//     console.log("First line");
//     let searchBox= $("#search");
//         searchBox.on("keyup",search);
//     let input=<string>(searchBox.val());
//     let resultDisplay=$("#searchResult");
//     function search() {
//         $.ajax({
//             url:'search.php',
//             type: 'GET',
//             data: {keyword: input},
//             beforeSend:function () {
//                 console.log(input+"vfbv");
//
//             },
//             success: function (data) {
//                 console.log("Executing");
//                 resultDisplay.empty();
//                 resultDisplay.append(data);
//             },
//             error: function (data) {
//                 console.log("Error");
//             }
//         })
//     }
// });
// let i="";
// $.ajax(
//     {url:"getPendingServiceRequests.php?sId=1",type:"GET"}
//     ).then((data)=>{i=JSON.parse(data)});

$(function () {
    first();
});
async function first() {
    console.log("BEGIN");
    let x= await f1();
    f2();
    console.log("END");
}
async function f1() {
    console.log("in f1 begin");
    setTimeout(()=>{console.log("in f1 timeout")},5000);
    console.log("in f1 end");
}
async  function f2() {
    console.log("in f2 begin");
    setTimeout(()=>{console.log("in f2 timeout")},2000);
    console.log("in f2 end");
}
