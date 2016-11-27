<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- css reset -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.css" integrity="sha256-7VVaJ5GDwFQiLIc+eNksQLUSSY5JNZtqv9o2BI8UGYg=" crossorigin="anonymous" />
	<!-- jquery & jquery UI-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha256-KM512VNnjElC30ehFwehXjx1YCHPiQkOPmqnrWtpccM=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" integrity="sha256-AAhU14J4Gv8bFupUUcHaPQfvrdNauRHMt+S4UVcaJb0=" crossorigin="anonymous"></script>
	<!-- bootstrap css & JS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript">
</script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<!-- google maps API -->
	<!-- main.css -->
	<link rel="stylesheet" type="text/css" href="../main.css">
	<script async src="../main.js"></script>
	<script>
		var latitude = -27.4524289;
		var longitude = 153.0359216;
		function initMap() {
			var target = {lat: latitude, lng: longitude};
			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 16,
				center: target
			});
			var marker = new google.maps.Marker({
				position: target,
				map: map
			});
		}
        
    $(document).ready(function() {
$(".dropdown dt a").on('click', function() {
  $(".dropdown dd ul").slideToggle('fast');
});

$(".dropdown dd ul li a").on('click', function() {
  $(".dropdown dd ul").hide();
});

function getSelectedValue(id) {
  return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function(e) {
  var $clicked = $(e.target);
  if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
});

$('.mutliSelect input[type="checkbox"]').on('click', function() {

  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
    title = $(this).val() + " ";

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSel').append(html);
    $(".hida").hide();
  } else {
    $('span[title="' + title + '"]').remove();
    var ret = $(".hida");
    $('.dropdown dt a').append(ret);

  }
});
});

  $( function() {
    var handle = $( "#custom-handle" );
    $( "#slider" ).slider({
      min: 0,
      max: 100,
      create: function() {
        handle.text( $( this ).slider( "value" ) );
      },
      slide: function( event, ui ) {
        handle.text( ui.value + "km");
        document.getElementById("radius").value = ui.value;
        
      }
    });
  } );
$( function() {
    var handle = $( "#custom-handle2" );
    $( "#slider2" ).slider({
      min: 0,
      max: 24,
      create: function() {
        handle.text( $( this ).slider( "value" ) );
      },
      slide: function( event, ui ) {
        handle.text( ui.value + "hr/s");
      }
    });
  } );
  
	</script>
    <script>
$(document).ready(function() {
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
    getLocation();
    function showPosition(position) {
        document.getElementById("latitude").value = position.coords.latitude;
        document.getElementById("longitude").value = position.coords.longitude; 
    }});
   
    </script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYT8Hwopd68rBTsvKjJ4Of75aQLQz1inM&callback=initMap"></script>
	<title>Serendipity - Offers</title>
    <style>
    *{
        font-family: arial;
    }
  .dropdown {
      z-index: 2;
/*
    position: absolute;
    top:50%;

    transform: translateY(-50%);
      */
  }

  a {
    color: #fff;
  }

  .dropdown dd,
  .dropdown dt {
    margin: 0px;
    padding: 0px;
  }

  .dropdown ul {
    margin: -1px 0 0 0;
  }

  .dropdown dd {
    position: relative;
  }

  .dropdown a,
  .dropdown a:visited {
    color: #fff;
    text-decoration: none;
    outline: none;
    font-size: 12px;
  }

  .dropdown dt a {
    background-color: #4F6877;
    display: block;
/*    padding: 8px 20px 5px 10px;*/
/*    min-height: 25px;*/
    line-height: 24px;
    overflow: hidden;
    border: 0;
    width: 100%;
  }

  .dropdown dt a span,
  .multiSel span {
    cursor: pointer;
    display: inline-block;
    padding: 0 3px 2px 0;
  }

  .dropdown dd ul {
    background-color: #4F6877;
    border: 0;
    color: #fff;
    display: none;
    left: 0px;
    padding: 2px 15px 2px 5px;
    position: absolute;
    top: 2px;
    width: 100%;
    list-style: none;
    height: 100px;
    overflow: auto;
  }

  .dropdown span.value {
    display: none;
  }

  .dropdown dd ul li a {
    padding: 5px;
    display: block;
  }

  .dropdown dd ul li a:hover {
    background-color: #fff;
  }

  #filter {
    background-color:#0090ca;
    width: 100%;
    border: 0;
    padding: 10px 0;
    margin: 5px 0;
    text-align: center;
    color: #fff;
    font-weight: bold;
  }
 .input_diff {
    background-color: #4F6877;
     border: none;
     min-height: 25px;
    line-height: 24px;
     color: white !important;
     width: 100%;
    }
      #custom-handle {
    width: 3em;
    height: 1.6em;
    top: 50%;
    margin-top: -.8em;
    text-align: center;
    line-height: 1.6em;
  }
#custom-handle2 {
    width: 3em;
    height: 1.6em;
    top: 50%;
    margin-top: -.8em;
    text-align: center;
    line-height: 1.6em;
  }
    #slider_container{
      width: 87%; 
        margin-left: 2%;
        text-align: center;
    }
    .hida{
        width: 100%;
    }
        input[type=checkbox]{
            width: auto;
        }

</style>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				</button>
				<div class="navbar-brand">
					<img style="max-width: 100px; " src="../img/serendipity_logo-PNG.png" alt="serendipity">
				</div>
				<span class="navbar-text visible-xs visible-sm page_title">| OFFERS</span>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Offers</a></li> 
					<li><a href="createEvent.html">Create Offer</a></li> 
                    <li><a href="requestList.html">Request List</a></li> 
					<!-- logout link -->
					<li><a href="../">Logout</a></li> 
				</ul>
			</div>
		</div>
	</nav>
	<div class="container" style="text-align:left;">
<form style="width:100%;" method= "post" action="offers.php">
 
<input class="input_diff" id="latitude" name="latitude" type="text" placeholder="LAT" value=""><br/><br/>
<input class="input_diff" id="longitude" name="longitude" type="text" placeholder="LONG" value=""><br/><br/>  
    
  <div id="slider_container">
<div id="slider">
  <div id="custom-handle" class="ui-slider-handle"></div>
</div><br/>
      <input type="hidden" id="radius" name="radius" value="">
    <div id="slider2">
  <div id="custom-handle2" class="ui-slider-handle"></div>
</div><br/>
    
</div> 
<dl class="dropdown"> 
  
    <dt>
    <a href="#" style="margin:0px;">
      <span class="hida">SELECT CATEGORY</span>    
      <p class="multiSel"></p>  
    </a>
    </dt>
  
    <dd>
        <div class="mutliSelect">
            <ul>
                <li>
                    <input type="checkbox" value="Food" />Food</li>
                <li>
                    <input type="checkbox" value="Transport" />Transport</li>
                <li>
                    <input type="checkbox" value="Accomodation" />Accomodation</li>
                <li>
                    <input type="checkbox" value="Sports" />Sports</li>
                <li>
                    <input type="checkbox" value="Music" />Music</li>
            </ul>
        </div>
    </dd>
  <button id="filter" name="filter">Filter</button>
</dl>
    

</form>
<?php
    include('../webservice/direction_distance.php');
    function search2($lat, $long, $radius) {

        $conn = new  PDO('mysql:dbname=serendipity;host=127.0.0.1', 'root', '');
        $address = [$lat,$long];

        $distancePerDegree = 111.045; //km. 63 for miles
        $withinDistance = $radius;

        $latRange=[
            $address[0]-$withinDistance/$distancePerDegree,
            $address[0]+$withinDistance/$distancePerDegree
        ];

        $lonRange=[
            $address[1]-$withinDistance/abs(cos(deg2rad($address[0]))*$distancePerDegree),
            $address[1]+$withinDistance/abs(cos(deg2rad($address[0]))*$distancePerDegree)
        ];
        $sql = "SELECT * FROM offer JOIN user ON user.UID=offer.UID WHERE (OfferLat BETWEEN {$latRange[0]} and {$latRange[1]}) AND (OfferLong BETWEEN {$lonRange[0]} and {$lonRange[1]})";

        $stmt = $conn->prepare($sql);
//        var_dump($stmt);
//        die();
        $stmt->execute();
        $points = $stmt->fetchAll();

        if(empty($points)) {
            return json_encode(array(0, 'fail', 'no events found'));
        }

        // get distance from each found location
        foreach($points as $point) {
            $bearing = getRhumbLineBearing($lat, $long, $point['OfferLat'], $point['OfferLong']);
            $distance = DistAB($lat, $long, $point['OfferLat'], $point['OfferLong']);
            $events[] = array('OID'=>$point['OID'], 'UID'=>$point['UID'], 'OfferName'=>$point['OfferName'], 'OfferDesc'=>$point['OfferDesc'],'EndDuration'=>$point['EndDuration'],'OfferLat'=>$point['OfferLat'], 'OfferLong'=>$point['OfferLong'], 'ImageURL'=>$point['ImageURL'], 'OfferLimit'=>$point['OfferLimit'], 'UserName'=>$point['UserName'], 'Bearing'=>$bearing,    'Distance'=>$distance);
            echo
                '<div class="panel-group" id="accordion">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title text-left row">
						<a class="accordion-toggle col-xs-12" data-toggle="collapse" data-parent="#accordion" href="#offer1">
							<div class="panel-item col-xs-9 text-left">
								<span class="glyphicon glyphicon-user offer-avatar"></span>
                                <span class="offer-event">'.$point['UserName'].' </span>
                                <span class="offer-event">'.$point['OfferName'].'</span>
							</div>
							<div class="panel-item col-xs-3 text-right">
								<span class="glyphicon glyphicon-chevron-down"></span>
							</div>
						</a>
					</h4>
				</div>
				<div id="offer1" class="panel-collapse collapse in">
					<div class="panel-body row">
						<h4 class="event-title col-xs-12 text-left offer-title">'.$point['OfferName'].'</h4>
                        <div class="col-xs-12 text-left">
							<span class="date-color">Created by:</span><span class=""> '.$point['UID'].'</span>
                            <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
						</div>
						<div class="col-xs-12 text-left">
							<span class="date-color">Start Date: </span><span class="event-start">'.$point['StartDuration'].'</span>
						</div>
						<div class="col-xs-12 text-left">
							<span class="date-color">End Date: </span><span class="event-end">'.$point['EndDuration'].'</span>
						</div>
						<div class="col-xs-12">
							<img class="offer-image" src="http://placehold.it/300x100/" alt="event-image">
						
						<!-- accept -->
						<div id="map">
						</div>
                        </div>
						<div class="col-xs-12 request-icons">
							<span class="glyphicon glyphicon-ok-sign text-right"></span>
							<!-- dismiss -->
							<span class="glyphicon glyphicon-remove-sign text-right"></span>
						</div>
					</div>
				</div>
			</div>
		</div>';
        }
        return json_encode($events);
    }
if(!empty($_POST['latitude'])||!empty($_POST['longitude'])||!empty($_POST['radius']) ){
   search2($_POST['latitude'], $_POST['longitude'], $_POST['radius']); 
}
     

?>
	</div>
</body>
</html>