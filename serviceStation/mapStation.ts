let lat0:any;
let lng0:any;
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
        lat0=position.coords.latitude;
        lng0=position.coords.longitude;

    });
    // document.write(lat0);
    // document.write(lng0);
} else {
    alert("Geolocation is not supported by this browser.");
}

getGeolocation();
getClickLocation();
function getGeolocation() {
    let confirmBtn = document.getElementById('submit');
    let latID = 1;
    let lngID = 1;
    let map = document.getElementById('map');
    let lat1 = lat0;
    let lng1 = lng0;

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            lat1 = position.coords.latitude;
            lng1 = position.coords.longitude;
            console.log(position.coords);
        });
        return {lat: lat1, log: lng1};
    } else {
        alert("Geolocation is not supported by this browser.");
    }
    // Initialize LocationPicker plugin
    // @ts-ignore
    let lp = new locationPicker(map, {
        setCurrentPosition: true, // You can omit this, defaults to true
        lat: lat1,
        lng: lng1
    }, {
        zoom: 10, // You can set any google map options here, zoom defaults to 15
    });


    google.maps.event.addListener(lp.map, 'idle', function (event:any) {
        let location = lp.getMarkerPosition();
        latID = location.lat;
        lngID = location.lng;
    });
}
function getClickLocation() {
    let confirmBtn = document.getElementById('submit');
    let latID = 1;
    let lngID = 1;
    let map = document.getElementById('map');
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
    // @ts-ignore
    let lp = new locationPicker(map, {
        setCurrentPosition: true, // You can omit this, defaults to true
        lat: lat1,
        lng: lng1
    }, {
        zoom: 10, // You can set any google map options here, zoom defaults to 15
    });
    google.maps.event.addListener(lp.map, 'click', function (event:any) {
        let location = lp.getMarkerPosition();
        latID = event.latLng.lat();
        lngID = event.latLng.lng();
        console.log(latID + "," + lngID);
    });
}
