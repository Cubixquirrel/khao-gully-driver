<!DOCTYPE html>
<html>
<head>
    <title>Direction</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWh--A2qe-yWC2AOuC3J6ZiuxtXFUCh24&callback=calculateAndDisplayRoute&libraries=&v=weekly"
    defer
    ></script>
    <style type="text/css">
    #map {
        height: 100%;
    }
    
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    </style>
    <script>
    function calculateAndDisplayRoute() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const directionsService = new google.maps.DirectionsService();
                const directionsRenderer = new google.maps.DirectionsRenderer();
                const map = new google.maps.Map(document.getElementById("map"));
                const geocoder = new google.maps.Geocoder();
                const urlParams = new URLSearchParams(window.location.search);
                const destinationLatlng = urlParams.get('destination');

                var latlng = {
                    lat: parseFloat(position.coords.latitude),
                    lng: parseFloat(position.coords.longitude)
                };
                geocoder.geocode({
                    location: latlng
                },
                (results, status) => {
                    if (status === "OK") {
                        const originLatlng = latlng.lat+','+latlng.lng;

                        directionsRenderer.setMap(map);
                        directionsService.route({
                            origin: {
                                query: originLatlng,
                            },
                            destination: {
                                query: destinationLatlng,
                            },
                            travelMode: google.maps.TravelMode.DRIVING,
                        },
                        (response, status) => {
                            if (status === "OK") {
                                directionsRenderer.setDirections(response);
                            } else {
                            window.alert("Directions request failed due to " + status);
                            }
                        });
                    } else {
                        window.alert("Geocoder failed due to: " + status);
                    }
                });
            });
        }
    }
    </script>
</head>
<body>
    <div id="map"></div>
</body>
</html>