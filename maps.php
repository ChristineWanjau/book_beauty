<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="intial-scale=1.0,width=device-width">
	<script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"
  type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"
  type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<div style="width:640px;height:480px" id="mapContainer"></div>
	<script>
		//intialize the platform object:
		var platform = new H.service.Platform({
			'apikey':'bWQsYs2V2mbIPvt-yszF0VT6qkjQ_QSCMGT73-P6eNo'
		});

        //obtain the default map types from the platform object
        var maptypes = platform.createDefaultLayers();

        //instantiate (and display) a map object:

       var map = new H.Map(
       	document.getElementById('mapContainer'),
       	maptypes.vector.normal.map,
       	{
       		zoom: 10,
       		center:{ lat: 52.53075, lng: 13.3851}
       	});


// Define a variable holding SVG mark-up that defines an icon image:
var svgMarkup = '<svg width="24" height="24" ' +
    'xmlns="http://www.w3.org/2000/svg">' +
    '<rect stroke="white" fill="#1b468d" x="1" y="1" width="22" ' +
    'height="22" /><text x="12" y="18" font-size="12pt" ' +
    'font-family="Arial" font-weight="bold" text-anchor="middle" ' +
    'fill="white">H</text></svg>';

// Create an icon, an object holding the latitude and longitude, and a marker:
var icon = new H.map.Icon(svgMarkup),
    coords = {lat: 52.53075, lng: 13.3851},
    marker = new H.map.Marker(coords, {icon: icon});

// Add the marker to the map and center the map at the location of the marker:
map.addObject(marker);
map.setCenter(coords);
	</script>
	</body>
</html>