$(function () {
    getServiceStations();
    $("#serviceStationSelection").on("change", getServices);
    displaySearchResults();
    $("#addServiceBtn").on("click", addServiceByStation);
});

function getServiceStations() {
    $.ajax({
        url: "getAllServiceStations.php",
        method: "GET",
    }).then(function (data) {
        let stations = JSON.parse(data);
        console.log(stations);
        for (let i = 0; i < stations.length; i++) {
            let sId = stations[i].s_id;
            let sName = stations[i].s_name;
            let sCity = stations[i].s_city;
            $("#serviceStationSelection").append(`<option value=${sId}>${sName}:${sCity}</option>`);
        }

    })
}

function getServices() {
    $.ajax({
        url: "getServicesInServiceStations.php",
        method: "GET",
        data: {s_id: (<HTMLInputElement>document.getElementById("serviceStationSelection")).value}
    }).then(function (data) {
        let services = JSON.parse(data);
        let endPoint = $("#availableServices");
        console.log(services);
        endPoint.empty();
        for (let i = 0; i < services.length; i++) {
            let sId = services[i].service_id;
            let sName = services[i].service_name;
            let cost = services[i].cost;
            endPoint.append(`<option value=${sId}>${sName}:LKR ${cost}</option>`);
        }
    })
}

function findServiceStation() {
    let service = (<HTMLInputElement>document.getElementById("search")).value;
    console.log("Keyword: " + service);
    let form = new FormData();
    form.append("keyword", service);
    form.append("table", "service");
    if (service != "") {
        fetch("searchAStation.php",
            {
                method: "POST",
                body: form
            }).then(function (data) {
            //console.log(data);
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

function addServiceByStation() {
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
    //call fetch
    if (serviceId !== "") {
        fetch("addServiceRequest.php", {method: "POST", body: data}).then(function (response) {
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
