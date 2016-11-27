$(document).ready(function() {

	// offers chevron toggle event
	$('.collapse').on('shown.bs.collapse', function(){
		$(this).parent().find(".glyphicon-chevron-down").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
	}).on('hidden.bs.collapse', function(){
		$(this).parent().find(".glyphicon-chevron-up").removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
	});

});
var OfferLat, OfferLong;

// address/lat & long acquision
function storeResult(result, OfferAddress, OfferName, OfferDesc, StartDuration, EndDuration, CatID, OfferLimit, ImageURL) {
	var OfferLat = result[0];
	var OfferLong = result[1];
	$.get( "../webservice/ws.php?action=createOffer&name=" + OfferName + "&desc=" + OfferDesc + "&startDate=" + StartDuration + "&endDate=" + EndDuration + "&catID=" + CatID + "&address=" + OfferAddress + "&lat=" + OfferLat + "&long=" + OfferLong + "&limit=" + OfferLimit + "&url=" + ImageURL, function( data ) {
		alert(data);
		data = JSON.parse(data);
		if(data[0] == 1) {
			console.log('Offer successfully created');
		} else {
			console.log(data[2]);
		}
	});
	sessionStorage.setItem('lat', result[0]);
	sessionStorage.setItem('long', result[1]);
}

function getLatLong(OfferAddress, OfferName, OfferDesc, StartDuration, EndDuration, CatID, OfferLimit, ImageURL) {
	var geocoder = new google.maps.Geocoder();
	var result = [];

	if (geocoder) {
		geocoder.geocode( { 'address': OfferAddress, 'region': 'uk' }, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				result[0] = results[0].geometry.location.lat();
				result[1] = results[0].geometry.location.lng();
			} else {
				result = "Unable to find address: " + status;
			}
			storeResult(result, OfferAddress, OfferName, OfferDesc, StartDuration, EndDuration, CatID, OfferLimit, ImageURL);
		});
	}
}

function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(
			function(position) { showPosition(position); },
			function(error) { console.log(error) },
			{ 	enableHighAccuracy: true,
				maximumAge: 100000,
				timeout: 5000
			}
			);	
	} else {
		console.log("Geolocation is not supported by this browser.");
	}
}

function showPosition(position) {
	lookforAddr(position.coords.latitude, position.coords.longitude);
}
function lookforAddr(lat, lng) {
	var geocoder = new google.maps.Geocoder();
	var latlng = {lat: parseFloat(lat), lng: parseFloat(lng)};
	geocoder.geocode({'location': latlng}, function(results, status) {
		if (status === 'OK') {
			console.log(results[0].formatted_address);
			document.getElementsByName("OfferAddress")[0].value = results[0].formatted_address;
		} else {
			alert('Geocode was not successful for the following reason: ' + status);
		}
	});
}

function createOffer() {
	var OfferName = document.getElementsByName('OfferName')[0].value;
	var OfferDesc = document.getElementsByName('OfferDesc')[0].value;
	var StartDuration = document.getElementsByName('StartDuration')[0].value;
	var EndDuration = document.getElementsByName('EndDuration')[0].value;
	var CatID = document.getElementsByName('CatID')[0].value;
	var OfferAddress = document.getElementsByName('OfferAddress')[0].value;
	var OfferLimit = document.getElementsByName('OfferLimit')[0].value;
	var ImageURL = '';
	getLatLong(OfferAddress, OfferName, OfferDesc, StartDuration, EndDuration, CatID, OfferLimit, ImageURL);
}

function login() {
	var email = document.getElementsByName('email')[0].value;
	var password = document.getElementsByName('password')[0].value;
	
	$.get( "webservice/ws.php?action=login&email=" + email + "&password=" + password, function( data ) {
		data = JSON.parse(data);
		if(data[0] == 1) {
			window.location.replace('html/offers.html');
		} else {
			if(document.getElementById('error')) {	
				document.getElementById('error').innerHTML = data[2];
			} else {
				var error = document.createElement('div');
				error.setAttribute('class', 'notification');
				error.setAttribute('id', 'error');
				var errorText = document.createTextNode(data[2]);
				error.appendChild(errorText);
				document.getElementById('hook').appendChild(error);
			}
		}
	});
}


function register() {
	var username = document.getElementsByName('username')[0].value;
	var email = document.getElementsByName('email')[0].value;
	var password = document.getElementsByName('password')[0].value;
	var confirmPassword = document.getElementsByName('confirmPassword')[0].value;

	$.get( "../webservice/ws.php?action=register&email=" + email + "&password=" + password + "&username=" + username + "&confirmPassword=" + confirmPassword, function( data ) {
		data = JSON.parse(data);
		if(data[0] == 1) {
			window.location.replace('../index.html');
		} else {
			if(document.getElementById('error')) {	
				document.getElementById('error').innerHTML = data[2];
			} else {
				var error = document.createElement('div');
				error.setAttribute('class', 'notification');
				error.setAttribute('id', 'error');
				var errorText = document.createTextNode(data[2]);
				error.appendChild(errorText);
				document.getElementById('hook').appendChild(error);
			}
		}
	});
}