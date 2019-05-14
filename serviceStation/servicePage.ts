let row = `<tr>
            <td>RequestId</td>
            <td>ServiceId</td>
            <td>Description</td>
            <td>Location</td>
            <td>Status</td>
            <td>Requested time</td>
            <td>Action</td>
        </tr>`;

// class Iterator1 {
//     private readonly collection: [];
//     private index: number;
//
//     public constructor(collection: []) {
//         this.collection = collection;
//         this.index = 0;
//     }
//
//     public next() {
//         let current = this.collection[this.index];
//         this.index += 1;
//         return current;
//     }
// }


$(function () {
    loadDoneReq();
    loadPendingReq();
    loadMyServices();

});

async function loadDoneReq() {
    let doneTable = <HTMLElement>document.getElementById("doneTable");
    let form = new FormData();
    form.append("select", "GET_SERVICE_REQUESTS");
    form.append("status", "DONE");
    let res = await fetch("ServiceStationAll.php", {
        method: "POST",
        body: form
    });
    let requests = await res.json();
    for (let i = 0; i < requests.length; i++) {
        console.log(requests[i]);//todo use iterator
    }

}

async function loadPendingReq() {
    let pendingTable = <HTMLElement>document.getElementById("pendingTable");
    let form = new FormData();
    form.append("select", "GET_SERVICE_REQUESTS");
    form.append("status", "PENDING");
    let res = await fetch("ServiceStationAll.php", {
        method: "POST",
        body: form
    });
    let requests = await res.json();
    for (let i = 0; i < requests.length; i++) {
        console.log(requests[i]);//todo use iterator
    }
}

async function addService() {

}

async function removeService() {

}

async function loadMyServices() {
    let serviceTable = <HTMLElement>document.getElementById("myServiceTable");
    let form = new FormData();
    form.append("select", "GET_MY_SERVICES");
    let res = await fetch("ServiceStationAll.php", {
        method: "POST",
        body: form
    });
    let requests = await res.json();
    for (let i = 0; i < requests.length; i++) {
        console.log(requests[i]);//todo use iterator
    }
}

async function changeServiceStatus() {
    //
    let form = new FormData();
    form.append("select", "UPDATE_REQUEST_STATUS");
    form.append("r_id",this.);
    form.append("status",);
    let res = await fetch("ServiceStationAll.php", {
        method: "POST",
        body: form
    });
    let requests = await res.text();

}

async  function showTotalSalesStatus() {
    let form = new FormData();
    form.append("select", "SHOW_SALES_STATUS");
    form.append("param","GET_TOTAL");
    let res = await fetch("ServiceStationAll.php", {
        method: "POST",
        body: form
    });
    let response = await res.json();
    response[0].total;//todo display answer

}
async function showTopCustomers() {
    let form = new FormData();
    form.append("select", "TOP_CUSTOMERS");
    form.append("param","GET_TOTAL");
    let res = await fetch("ServiceStationAll.php", {
        method: "POST",
        body: form
    });
    let response = await res.json();
    for (let i = 0; i < response.length; i++) {
        console.log(response[i]);//todo use iterator
    }
}
