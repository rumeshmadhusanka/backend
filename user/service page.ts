$(function () {
    getServiceStations();
    showAllServiceStations();
    $("#serviceStationSelection").on("change", getServices);
    displaySearchResults();
    $("#addServiceBtn").on("click", addServiceByStation);
    showUserRegServices();
    setInterval(showUserRegServices, 2000);
});

async function getServiceStations() {
    let form = new FormData();
    form.append("select", "GET_SERVICE_STATIONS");
    let res = await fetch("userAll.php", {
        method: "POST",
        body: form
    });
    let stations = await res.json();
    //console.log(stations);
    for (let i = 0; i < stations.length; i++) {
        let sId = stations[i].s_id;
        let sName = stations[i].s_name;
        let sCity = stations[i].s_city;
        $("#serviceStationSelection").append(`<option value=${sId}>${sName}:${sCity}</option>`);
    }
}

async function getServices() {
    let form = new FormData();
    form.append("select", "GET_SERVICES_IN_STATION");
    form.append("s_id", (<HTMLInputElement>document.getElementById("serviceStationSelection")).value)
    let res = await fetch("userAll.php", {
        method: "POST",
        body: form
    });
    let services = await res.json();
    let endPoint = $("#availableServices");
    console.log(services);
    endPoint.empty();
    for (let i = 0; i < services.length; i++) {
        let sId = services[i].service_id;
        let sName = services[i].service_name;
        let cost = services[i].cost;
        endPoint.append(`<option value=${sId}>${sName}:LKR ${cost}</option>`);
    }
}

async function findServiceStation() {
    let service = (<HTMLInputElement>document.getElementById("search")).value;
    console.log("Keyword: " + service);
    let form = new FormData();
    form.append("keyword", service);
    form.append("table", "service");
    form.append("select", "SEARCH_STATION");
    if (service != "") {
        fetch("userAll.php",
            {
                method: "POST",
                body: form
            }).then(function (data) {

            return data.text();
        }).then(function (data) {
            //console.log(data);
            let stations = JSON.parse(data);
            console.log(stations);
            let endpoint = $("#serviceStationSelection2");
            endpoint.empty();
            for (let i = 0; i < stations.length; i++) {
                let sId = stations[i].s_id;
                let sName = stations[i].s_name;
                let sCity = stations[i].s_city;
                endpoint.append(`<option value=${sId}>${sName}:${sCity}</option>`);
            }
        })
    }
}

function displaySearchResults() {
    let search = $("#search");
    search.on("input", findServiceStation);
    search.on("keypress", findServiceStation);
    search.on("focusout", findServiceStation);
}

async function addServiceByStation() {
    //todo add the location data from the map
    let serviceId = (<HTMLInputElement>document.getElementById("availableServices")).value;
    let description = (<HTMLInputElement>document.getElementById("description1")).value;
    let latitude = "50.3564";//todo map data
    let longitude = "-5.6788";//todo map data
    //create a form to include data
    let data = new FormData();
    data.append("service_id", serviceId);
    data.append("r_description", description);
    data.append("r_latitude", latitude);
    data.append("r_longitude", longitude);
    data.append("select", "ADD_SERVICE_REQUEST");
    //call fetch
    if (serviceId !== "") {
        fetch("userAll.php", {method: "POST", body: data}).then(function (response) {
            alert("Service added ");//todo replace alert
            console.log(response.status);
            return response.text();
        }).then(function (data) {
            console.log(data);
        }).catch(function (data) {
            console.error(data);
        })
    } else {
        alert("Please select a service ");//todo replace alert
    }
}

function showUserRegServices() {
    if (!window.navigator.onLine) {
        return;
    }
    let head = `<tr>
            <td>Service Station</td>
            <td>Service Name</td>
            <td>Cost</td>
            <td>Description</td>
            <td>Time</td>
            <td>Contact Number</td>
            <td>Action</td>
        </tr>`;
    let pending = $("#pendingServices");
    let done = $("#doneServices");
    let station = "";
    let service = "";
    let cost = "";
    let description = "";
    let status = "";
    let time = "";
    let tele = "";
    let r_id="";
    let form = new FormData();
    form.append("select", "GET_REQUEST_DETAILS");
    fetch("userAll.php", {
        method: "POST",
        body: form
    })
        .then(function (data) {
            return data.text();
        }).catch(function (data) {
        console.log(data);
    }).then(function (textData) {
        let details = JSON.parse(<string>textData);
        pending.empty();
        done.empty();
        pending.append(head);
        done.append(head);
        //for loop
        for (let i = 0; i < details.length; i++) {
            let templateP = `<tr>
            <td>${station}</td>
            <td>${service}</td>
            <td>${cost}</td>
            <td>${description}</td>
            <td>${time}</td>
            <td><a href="tel:${tele}">${tele}</a></td>
            <td><input type="button" value="Cancel Request" onclick="cancelRegRequest(${r_id})"></td>
        </tr>`;

            let templateC = `<tr>
            <td>${station}</td>
            <td>${service}</td>
            <td>${cost}</td>
            <td>${description}</td>
            <td>${time}</td>
            <td><a href="tel:${tele}">${tele}</a></td>
            </tr>`;
            station = details[i].s_name + " :" + details[i].s_city;
            service = details[i].service_name;
            cost = details[i].cost;
            description = details[i].r_description;
            time = details[i].r_submit_time;
            status = details[i].r_status;
            tele = details[i].s_telephone;
            r_id =details[i].r_id;
            if (status === "PENDING") {
                pending.append(templateP);
            } else if (status === "DONE") {
                done.append(templateC);
            }

        }

    })

}

async function cancelRegRequest(reqId:string) {
    let form = new FormData();
    form.append("select","CANCEL_REQUEST");
    form.append("r_id",reqId);
    let res = await fetch("userAll.php",{
        method:'POST',
        body:form
    });

    let text = res.json();

}

async function showAllServiceStations() {
    let form = new FormData();
    form.append("select", "GET_ALL_SERVICE_STATIONS");
    let res = await fetch("userAll.php", {
        method: "POST",
        body: form
    });
    let stations = await res.json();
    let endPoint = $("#serviceStationBoxes");
    endPoint.empty();
    console.log(stations);
    for (let i = 0; i < stations.length; i++) {
        let sName = stations[i].s_name;
        let address = stations[i].s_address;
        let description = stations[i].s_decription;
        let telephone = stations[i].s_telephone;
        let img = stations[i].s_picture;
        let template = `<div class="myBox">
            <img src="${img}" class="modal-avatar img-circle" alt="Logo">
            <table>
                <tr>
                    <td>Name</td>
                    <td>${sName}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>${address}</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>${description}</td>
                </tr>
                <tr>
                    <td>Telephone</td>
                    <td>${telephone}</td>
                </tr>
            </table>
        </div>`;

        endPoint.append(template);
    }

}
