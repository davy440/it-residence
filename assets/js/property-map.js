//Handling the Property Map using the Google Maps JS API
var script = document.createElement('script');
script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyComHwJLpxWl91z0jqIvCOMuXYtaiv3UPI&callback=initMap';
script.async = true;

// Attach your callback function to the `window` object
window.initMap = function() {
    const mapContainer  =   document.getElementById('property-map');

    let mapProp = {
        center: new google.maps.LatLng(  itre.lat[0], itre.long[0] ),
        minZoom: 4,
        zoom: parseInt(itre.zoom[0]),
        maxZoom: 16,
        disableDefaultUI: !itre.controls[0]
    }

    if ( itre.labels[0] !== "") {
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
        position: new google.maps.LatLng(  itre.lat[0], itre.long[0] ),
        map: map
    }

    let marker = new google.maps.Marker(markerProps)

};

// Append the 'script' element to 'head'
document.head.appendChild(script);
//30.766061911318726, 76.74533284372761
