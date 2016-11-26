<!--CREATE OFFER-->
<script>
		function createEvent() {
			var OfferName = document.getElementsByName('OfferName')[0].value;
			var UID = document.getElementsByName('UID')[0].value;
			var OfferDesc = document.getElementsByName('OfferDesc')[0].value;
			var StartDuration = document.getElementsByName('StartDuration')[0].value;
            var EndDuration = document.getElementsByName('EndDuration')[0].value;
            var CatID = document.getElementsByName('CatID')[0].value;
            var OfferAddress = document.getElementsByName('OfferAddress')[0].value;
            var OfferLat = document.getElementsByName('OfferLat')[0].value;
            var OfferLong = document.getElementsByName('OfferLong')[0].value;
            var Status = document.getElementsByName('Status')[0].value;
            var OfferLimit = document.getElementsByName('OfferLimit')[0].value;
            var ImageURL = document.getElementsByName('ImageURL')[0].value;
			
			$.get( "../webservice/ws.php?action=createEvent&OfferName=" + OfferName + "&UID=" + UID + "&OfferDesc=" + OfferDesc + "&StartDuration=" + StartDuration + "&EndDuration=" + EndDuration + "&CatID=" + CatID + "&OfferAddress=" + OfferAddress + "&OfferLat=" + OfferLat + "&OfferLong=" + OfferLong + "&Status=" + Status + "&OfferLimit=" + OfferLimit + "&ImageURL=" +ImageURL, function( data ) {
			 data = JSON.parse(data);
			  if(data[0] == 1) {
				console.log('Offer successfully created');
			 } else {
				console.log(data[2]);
			 }
			});
		}
		</script>

<!--Requests-->

<script>
 function requestOffer() {
			var OID = document.getElementsByName('OID')[0].value;
			var UID = document.getElementsByName('UID')[0].value;
			var Status = document.getElementsByName('Status')[0].value;
			
			
			$.get( "../webservice/ws.php?action=requestOffer&OID=" + OID + "&UID=" + UID + "&Status=" + Status, function( data ) {
			 data = JSON.parse(data);
			  if(data[0] == 1) {
				console.log('Request successfully sent');
			 } else {
				console.log(data[2]);
			 }
			});
		}   
</script>
<script>
function acceptRequest() {
			var RID = document.getElementsByName('RID')[0].value;
			
			
			$.get( "../webservice/ws.php?action=rejectRequest&RID=" + RID, function( data ) {
			 data = JSON.parse(data);
			  if(data[0] == 1) {
				console.log('Request accepted');
			 } else {
				console.log(data[2]);
			 }
			});
		}   
</script>
<script>
function rejectRequest() {
			var RID = document.getElementsByName('RID')[0].value;		
			
			$.get( "../webservice/ws.php?action=rejectRequest&RID=" + RID, function( data ) {
			 data = JSON.parse(data);
			  if(data[0] == 1) {
				console.log('Request rejected');
			 } else {
				console.log(data[2]);
			 }
			});
		}   
</script>