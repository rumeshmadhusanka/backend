"use strict";
$(function () {
    getTotalEarnings();
    getTopCustomers();
    setInterval(getTotalEarnings, 2000);
    setInterval(getTopCustomers, 2000);
});
async function getTotalEarnings() {
    let form = new FormData();
    form.append("select", "SHOW_SALES_STATUS");
    form.append("param", "GET_TOTAL");
    let res = await fetch("ServiceStationAll.php", {
        method: "POST",
        body: form
    });
    let text = await res.json();
    let tot = text[0].total;
    document.getElementById("totalEarnings").innerHTML = `Total Earnings:LKR: ${tot}`;
}
async function getTopCustomers() {
    let form = new FormData();
    form.append("select", "SHOW_SALES_STATUS");
    form.append("param", "TOP_CUSTOMERS");
    let res = await fetch("ServiceStationAll.php", {
        method: "POST",
        body: form
    });
    let text = await res.json();
    document.getElementById("topCustomers").innerHTML = `<tr>
            <td>Customer Name</td>
            <td>Mobile Number</td>
            <td>Purchases</td>
        </tr>`;
    for (let i = 0; i < text.length; i++) {
        let template = `<tr>
            <td>${text[i].u_name}</td>
            <td>${text[i].u_tele}</td>
            <td>${text[i].total}</td>
        </tr>`;
        document.getElementById("topCustomers").innerHTML += template;
    }
}
