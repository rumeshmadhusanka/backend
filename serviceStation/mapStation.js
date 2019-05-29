//
// let lat0;
// let lng0;
// if (navigator.geolocation) {
//     navigator.geolocation.getCurrentPosition(function(position) {
//         lat0=position.coords.latitude;
//         lng0=position.coords.longitude;
//
//     });
//     // document.write(lat0);
//     // document.write(lng0);
// } else {
//     alert("Geolocation is not supported by this browser.");
// }
//



//getGeolocation();

function getGeolocation() {
    let confirmBtn = document.getElementById('submit');
    let latID = 1;
    let lngID = 1;
    let map = document.getElementById('mapLoc');
    let lat1 = lat0;
    let lng1 = lng0;

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            lat1 = position.coords.latitude;
            lng1 = position.coords.longitude;
            //console.log(position.coords);

        });
        //return {lat: lat1, log: lng1};
    } else {
        alert("Geolocation is not supported by this browser.");
    }
    // Initialize LocationPicker plugin
    let lp = new locationPicker(map, {
        setCurrentPosition: true, // You can omit this, defaults to true
        lat: lat1,
        lng: lng1
    }, {
        zoom: 10, // You can set any google map options here, zoom defaults to 15
    });
    google.maps.event.addListener(lp.map, 'idle', function (event) {
        let location = lp.getMarkerPosition();
        latID = location.lat;
        lngID = location.lng;
    });
}
let lati=document.getElementById("latitude").value;
let longi=document.getElementById("longitude").value;
setTimeout(getClickLocation(lat0=lati,lng0=longi),1000);
//getClickLocation(lat0=lati,lng0=longi);
function getGeolocation() {
    var myLatLng = {lat: -25.363, lng: 131.044};

    var map = new google.maps.Map(document.getElementById('mapLoc'), {
        zoom: 4,
        center: myLatLng
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Hello World!',
        draggable:false
    });
}
function getClickLocation(lat0,lng0) {
    let confirmBtn = document.getElementById('submit');
    let latID = 1;
    let lngID = 1;
    let map = document.getElementById('mapLoc');
    let lat1 = lat0;
    let lng1 = lng0;

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            lat1 = position.coords.latitude;
            lng1 = position.coords.longitude;
            console.log(position.coords);
        });
    } else {
        alert("Geolocation is not supported by this browser.");
    }
    // Initialize LocationPicker plugin
    let lp = new locationPicker(map, {
        setCurrentPosition: true, // You can omit this, defaults to true
        lat: lat1,
        lng: lng1,
    }, {
        zoom: 10, // You can set any google map options here, zoom defaults to 15
    });


    google.maps.event.addListener(lp.map, 'idle', function (event) {
        let location = lp.getMarkerPosition();
        latID = location.lat;
        lngID = location.lng;
        console.log(latID + "," + lngID);
        //todo change with element id
        document.getElementById("latitude").value = latID;
        document.getElementById("longitude").value = lngID;
    });
}
