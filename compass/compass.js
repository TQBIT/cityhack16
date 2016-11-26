document.addEventListener("DOMContentLoaded", function(event) {

    if (window.DeviceOrientationEvent) {
        window.addEventListener('deviceorientation', function(eventData) {
            var tiltLR = eventData.gamma;
            var tiltFB = eventData.beta;
            var dir = eventData.alpha
            deviceOrientationHandler(tiltLR, tiltFB, dir);
        }, false);
    } else {
        document.getElementById("notice").innerHTML = "Err"
    };

    function deviceOrientationHandler(tiltLR, tiltFB, dir) {
        document.getElementById("tiltLR").innerHTML = Math.ceil(tiltLR);
        document.getElementById("tiltFB").innerHTML = Math.ceil(tiltFB);
        document.getElementById("direction").innerHTML = Math.ceil(dir);
        
        // Rotate the disc of the compass.
        var compass = document.getElementById("compassDisk");
        compass.style.webkitTransform = "rotate("+ dir +"deg)";
        compass.style.MozTransform = "rotate("+ dir +"deg)";
        compass.style.transform = "rotate("+ dir +"deg)";

		//for each in the class of svg 'offers'
		var offers = document.getElementsByClassName('offer_radar');
		for(loop=0;loop<offers.length;loop++) {
			heading = offers[loop].getAttribute('heading');
			if((heading + dir) > 360) {
				heading = heading + dir - 360;
			} else {
				heading = heading + dir;
			}
        	offers[loop].style.webkitTransform = "rotate("+ heading +"deg)";
        	offers[loop].style.MozTransform = "rotate("+ heading +"deg)";
        	offers[loop].style.transform = "rotate("+ heading +"deg)";
		}
		getLocation();
    }
});

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
				function(position) { showPosition(position); },
				function(error) { document.getElementById('lat').innerHTML = 'err'; },
				{ 	enableHighAccuracy: true,
					maximumAge: 100000,
					timeout: 5000
				}
			);	
        } else {
            document.getElementById("lat").innerHTML = "Geolocation is not supported by this browser.";
        }
    }


    function showPosition(position) {
        document.getElementById("lat").value = position.coords.latitude;
        document.getElementById("long").value = position.coords.longitude; 
        document.getElementById("acc").innerHTML = "Accuracy: " + position.coords.accuracy; 
        document.getElementById("elevation").innerHTML = "Elevation: " + position.coords.altitude; 
        document.getElementById("heading").innerHTML = "Heading: " + position.coords.heading; 
    }

    function submitASearch() {
        var searchURL = '../webservice/ws.php?action=search2&lat=' + lat.value + '&lang=' + long.value + '&radius=' + radius.value;
        console.log(searchURL);
        $('#search_output').load(searchURL, function(output) {
            populateResults(output);
        });
    }

    function populateResults() {


    }
