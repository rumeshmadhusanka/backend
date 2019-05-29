getGeolocation();
function getGeolocation() {
    let confirmBtn = document.getElementById('submit');
    let latID = 1;
    let lngID = 1;
    let map = document.getElementById('mapLoc');
    let lat1;
    let lng1;

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