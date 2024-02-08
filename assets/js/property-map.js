//Handling the Property Map using the Google Maps JS API
(function() {

const mapContainer  =   document.getElementById('property-map');
if (mapContainer === null) {
    return;
}

const { lat, long, zoom, controls, labels } = itre;

if (!lat[0] || !long[0]) {
    return;
}

var script = document.createElement('script');
script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyComHwJLpxWl91z0jqIvCOMuXYtaiv3UPI&callback=initMap';
script.async = true;

// Attach your callback function to the `window` object
window.initMap = function() {

    let mapProp = {
        center: new google.maps.LatLng(  parseFloat(lat[0]), parseFloat(long[0]) ),
        minZoom: 4,
        zoom: parseInt(zoom[0]),
        maxZoom: 16,
        disableDefaultUI: !controls[0]
    }

    if ( labels[0] !== "") {
        mapProp.styles = [
            {
                "featureType": "poi",
                "stylers": [
                {
                    "visibility": "off"
                }
                ]
            }
        ]
    }

    let map = new google.maps.Map(mapContainer, mapProp);

    let markerProps = {
        position: new google.maps.LatLng( parseFloat(lat[0]), parseFloat(long[0]) ),
        map: map
    }

    let marker = new google.maps.Marker(markerProps)

};

// Append the 'script' element to 'head'
document.head.appendChild(script);

})();