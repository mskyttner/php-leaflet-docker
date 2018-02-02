<!DOCTYPE html>
<html>
<head>
    <title>UTTERMAP</title>
    <meta charset="utf-8" />
	 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
	   integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
	   crossorigin=""/>
	 <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
	   integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
	   crossorigin=""></script>
</head>

<body>

<div id="map" style="width: 600px; height: 400px"></div>


<?php

$servername = "db";
$username = "otter";
$password = "otter";
$dbname = "otter";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT scientificname, latitude, longitude FROM wobjects where latitude < 5";
$data = $conn->query($sql);

while ($row=mysqli_fetch_array($data)){
	$object[]=array($row[0],$row[1],$row[2]);
}

/*
$json_array = json_encode($object);
*/

?>

<script>
var places = <?php echo json_encode($object) ?>;
</script>

<script>   
    var map = L.map('map').setView([59.3058, 13.82082], 4);
    mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';

    L.tileLayer('//tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; ' + mapLink + ' Contributors',
        maxZoom: 18,
    }).addTo(map);

	for (var i = 0; i < places.length; i++) {
		L.marker([places[i][1],places[i][2]]).addTo(map)
			.bindPopup(places[i][0]).openPopup();
		(map);
	}

	var popup = L.popup();

	function onMapClick(e) {
		popup
			.setLatLng(e.latlng)
			.setContent("You clicked the map at " + e.latlng.toString())
			.openOn(mymap);
	}

	mymap.on('click', onMapClick);

</script>

</body>
</html>
