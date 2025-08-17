n,<!-- <!DOCTYPE html>
<html>
<body>

<h1>My First Google Map</h1>

<div id="googleMap" style="width:100%;height:400px;"></div>

<script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(12.971599,77.594566),
  zoom:5,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmssLDIr2k4I89ZsR3CjZDe0rQouWxFIs&callback=myMap"></script>

</body>
</html> -->





<html>
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyAmssLDIr2k4I89ZsR3CjZDe0rQouWxFIs"></script>
	<script type="text/javascript">
		function myIP(){
			$("#btn").click(function(){
				var geocoder =  new google.maps.Geocoder();
				geocoder.geocode( { 'address': $('#city').val()}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						$('.push-down').text("location : " + results[0].geometry.location.lat() + " " +results[0].geometry.location.lng()); 
					} else {
						$('.push-down').text("Something got wrong " + status);
					}
				});
			});
		}
	</script>
	<style>
	    .push-down {margin-top: 25px;}
	</style>
</head>
<body onload="myIP()">
<input type="text" id= "city">
<input id="btn" type="button" value="get Lat&Long" />
  <div class="push-down"></div>
</body>
</html>