

let rad = function(x) {
    return x * Math.PI / 180;
};

let getDistance = function(p1, p2) {
    let R = 6378137; // Earth’s mean radius in meter
    let dLat = rad(p2[1] - p1[1]);
    let dLong = rad(p2[2] - p1[2]);
    let a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(rad(p1[1])) * Math.cos(rad(p2[1])) *
        Math.sin(dLong / 2) * Math.sin(dLong / 2);
    let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    let d = R * c;
    return d; // returns the distance in meter
};
// let locationList = [
//     ['Manly Beach', 	6.927079, 79.861244],
//     ['Maroubra Beach', -33.950198, 151.259302],
//     ['Coogee Beach', -33.923036, 151.259052],
//     ['Cronulla Beach', -34.028249, 151.157507]
// ];
setTimeout(init,2000);
async function init() {
    let form = new FormData();
    form.append("select", "GET_SERVICE_STATIONS");
    let res = await fetch("userAll.php", {
        method: "POST",
        body: form
    });
    let stations = await res.json();
    //console.log(stations);
    let locationList=[];
    for (let i = 0; i < stations.length; i++) {
        let sName = stations[i].s_name;
        let lat = stations[i].s_latitude;
        let long = stations[i].s_longitude;
        locationList.push([sName,lat,long]);
    }
    console.log(locationList);

    initMap(locationList);
}

function initMap(locationList) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                let mid = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                //console.log(mid);
                let map = new google.maps.Map(document.getElementById("map"), {
                    center: mid,
                    zoom: 10
                });

                map.setCenter(mid);
                let marker = new google.maps.Marker({
                    position: {lat: mid.lat, lng: mid.lng},
                    map: map,
                    //icon: "img/map/myposition.png",
                    draggable: true
                });

                //var geolocation=['Bondi Beach', -33.890542, 151.274856, 4];
                let geolocation=['moratuwa',mid.lat,mid.lng,4];
                setMarkers(map,geolocation,locationList);
            }
        );

        function setMarkers(map,geolocation,locationList) {
// Adds markers to the map.
            let marker1 = new google.maps.Marker({
                position: {lat: geolocation[1], lng: geolocation[2]},
                map: map,
                //icon: "img/map/myposition.png",
                shape: shape,
                title: geolocation[0],
                zoom: 5
//zIndex: beach[3]
            });
            var shape = {
                coords: [1, 1, 1, 20, 18, 20, 18, 1],
                type: 'poly'
            };
            let min=100000000;
            let shorstest;
            for (var i = 0; i < locationList.length; i++) {
                var location = locationList[i];
                if (getDistance(geolocation, location) < min) {
                    min = getDistance(geolocation, location);
                    shorstest = location;
                    console.log(location[0]);
                }
            }
            let marker = new google.maps.Marker({
                position: {lat: shorstest[1], lng: shorstest[2]},
                map: map,
                //icon: "img/map/myposition.png",
                shape: shape,
                title: shorstest[0],
                zoom:5
//zIndex: beach[3]
            });

        }
    } else {
        alert("Geolocation is not supported by this browser.");
    }

}

