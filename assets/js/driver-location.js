setTimeout(() => {
    setInterval(() => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latlng = {
                    lat: parseFloat(position.coords.latitude),
                    lng: parseFloat(position.coords.longitude)
                };
                console.log(latlng.lat+','+latlng.lng);

                var http = new XMLHttpRequest();
                var url = '../requests/update-driver-location.php';
                var params = 
                'lat='+latlng.lat+
                '&lng='+latlng.lng
                ;

                http.open('POST', url, true);
                http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                http.onreadystatechange = function() {
                    if(http.readyState == 4 && http.status == 200) {
                        // console.log(http.responseText);
                    }
                }
                http.send(params);
            });
        }
    }, 60000);
}, 1000);