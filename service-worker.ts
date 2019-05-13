self.addEventListener('install',function (event) {
    //do stuff during installation
    alert("installing service worker");
});
self.addEventListener('activate',function (event) {
    //do stuff during installation
    console.log("activating service worker");
    alert("activating service worker");
});
