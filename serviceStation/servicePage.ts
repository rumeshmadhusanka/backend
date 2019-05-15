class Observer {
    //html page
    private readonly work: any;

    constructor(myFunc: any) {
        this.work = myFunc;
    }

    public receiveMessage(data: any) {
        this.work(data);
    }

}

class Observable {
    //db
    private readonly endPoint: string;
    //private readonly params: object;//like {'a': 25,'b':56}
    private observers: Observer[];


    constructor(endPoint: string) {
        this.endPoint = endPoint;
        this.observers = Array();

    }

    public addObserver(ob: Observer): void {
        this.observers.push(ob);
    }

    private sendMessage(data: any): void {
        for (let i = 0; i < this.observers.length; i++) {
            this.observers[i].receiveMessage(data);
        }
    }

    public work(params: object) {
        let form = new FormData();
        //console.log(params);
        for (const [key, value] of Object.entries(params)) {
            form.append(key, value);
        }
        let response = fetch(this.endPoint, {
            method: "POST",
            body: form
        });
        let promise = response.then(function (data) {
            //console.log(data);
            return data.json();
        });
        promise.then((msg) => {
            console.log(msg);
            let reqId = "";
            let cus = "";
            let serId = "";
            let serName = "";
            let des = "";
            let status = "";
            let reqTime = "";
            let send=Array();
            for (let i = 0; i < msg.length; i++) {
                reqId = msg[i].r_id;
                serId = msg[i].service_id;
                cus = msg[i].u_name;
                serName = msg[i].service_name;
                des = msg[i].r_description;
                status = msg[i].r_status;
                reqTime = msg[i].r_submit_time;
                let template = `<tr>
            <td>${reqId}</td>
            <td>${serId}</td>
            <td>${cus}</td>
            <td>${serName}</td>
            <td>${des}</td>
            <td>${status}</td>
            <td>${reqTime}</td>
            <td>
            <input class="btn btn-blue-grey" type="button" value="Mark as Done" onclick="doneServiceReq(${reqId})">
            <input class="btn btn-outline-danger" type="button" value="Cancel Request" onclick="cancelServiceReq(${reqId})">
            </td>
        </tr>`;
                send.push(template);
            }
            this.sendMessage(send);

        });
    }


}

$(function () {
    main();
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

async function cancelServiceReq(rId: number) {
    //
    let form = new FormData();
    form.append("select", "UPDATE_REQUEST_STATUS");
    form.append("r_id", rId.toString());//-------------
    form.append("status", "CANCELLED");//-------------
    let res = await fetch("ServiceStationAll.php", {
        method: "POST",
        body: form
    });
    let text = await res.text();
    if (text == "SUCCESS"){
        alert(`Request ${rId} marked as cancelled`);//todo replace alert
    }
}

async function doneServiceReq(rId: number) {
    let form = new FormData();
    form.append("select", "UPDATE_REQUEST_STATUS");
    form.append("r_id", rId.toString());//-------------
    form.append("status", "DONE");//-------------
    let res = await fetch("ServiceStationAll.php", {
        method: "POST",
        body: form
    });
    let text = await res.text();
    if (text == "SUCCESS"){
        alert(`Request ${rId} marked as done`);//todo replace alert
    }
}

async function showTotalSalesStatus() {
    let form = new FormData();
    form.append("select", "SHOW_SALES_STATUS");
    form.append("param", "GET_TOTAL");
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
    form.append("param", "GET_TOTAL");
    let res = await fetch("ServiceStationAll.php", {
        method: "POST",
        body: form
    });
    let response = await res.json();
    for (let i = 0; i < response.length; i++) {
        console.log(response[i]);//todo use iterator
    }
}

function main() {

    let pendingObserverFunc = function (data: any) {

        let pendingTable = <HTMLElement>document.getElementById("pendingTable");
        pendingTable.innerHTML=`<tr>
            <td>RequestId</td>
            <td>ServiceId</td>
            <td>Customer name</td>
            <td>Service Name</td>
            <td>Description</td>
            <td>Status</td>
            <td>Requested time</td>
            <td>Action</td>
        </tr>`;
        for (let i = 0; i < data.length; i++) {
            pendingTable.innerHTML+=data[i];
        }

    };
    let a1 = new Observer(pendingObserverFunc);
    let params = {"select": "GET_SERVICE_REQUESTS", "status": "PENDING"};
    let pendingObservable = new Observable("ServiceStationAll.php");
    pendingObservable.addObserver(a1);
    // pendingObservable.work(params);
    pendingObservable.work(params);
    setInterval(() => {
        pendingObservable.work(params)
    }, 1000);

    let doneObserverFunc = function (data: any) {

        let pendingTable = <HTMLElement>document.getElementById("doneTable");
        pendingTable.innerHTML=`<tr>
            <td>RequestId</td>
            <td>ServiceId</td>
            <td>Customer name</td>
            <td>Service Name</td>
            <td>Description</td>
            <td>Status</td>
            <td>Requested time</td>
            <td>Action</td>
        </tr>`;
        for (let i = 0; i < data.length; i++) {
            pendingTable.innerHTML+=data[i];
        }

    };
    let a2=new Observer(doneObserverFunc);
    let params2 = {"select": "GET_SERVICE_REQUESTS", "status": "DONE"};
    let doneObservable =new Observable("ServiceStationAll.php");
    doneObservable.addObserver(a2);
    doneObservable.work(params2);
    setInterval(() => {
        pendingObservable.work(params)
    }, 1000);
}

