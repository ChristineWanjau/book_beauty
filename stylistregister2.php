<?php

declare(strict_types= 1);
session_start();
include_once 'class/stylistContr.php';
include_once 'class/validation.class.php';

$_SESSION['businessname'] = $_POST['businessname'];
$_SESSION['stylist_name'] =$_POST['name'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['contact']= $_POST['contact'];



?>

<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style3.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
         <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>

  <style>
    .container{
      margin-left:270px;
      margin-top:10px;
      height:500px;

    }
    .textbox{
    width:400px;
    border-radius:10px;
    font-size:10px;

}




  </style>
  <body id="geocode">
    <div class="logo">
      <p>Enter your location</p>
  </div>
      <div style="margin-top:0px;margin-left:150px; width:500px;height:470px"id="map"></div>
      <input type="text" id="locate" placeholder="search" style="height:30px;width:450px;margin-left:150px;">
      <button style="background: transparent;" type="submit" id="btn" onClick="search(this.id)"><i class="fa fa-search" ></i></button>
      <div id="panel"></div>
      <div class="container">
      <form action="stylistregister3.php" method="POST">
        <div class="textbox">
          <input type="text" required="" id="street"name="street"/>
          <label>Street</label>
          <div class="textbox">
          <input type="text" required="" id="district"name="district"/>
          <label>District</label>
          <div class="textbox">
          <input type="text" required="" id="city" name="city"/>
          <label>City</label>
          <div class="textbox">
          <input type="text" required="" id="postal" name="postal"/>
          <label>Postal Code</label>
        </div>
          <div class="textbox">
          <input type="text" required="" id="country" name="country"/>
          <label>Country</label>
          <input type="hidden" required="" id="position_lat" name="lat"/>
          <input type="hidden" required="" id="position_lng" name="lng"/>
        <button class="btn" type="submit" name="submit">Submit</button>
      </form>
     
</div>
  </body>
  <script type="text/javascript">
    /**
 * Calculates and displays the address details of 200 S Mathilda Ave, Sunnyvale, CA
 * based on a free-form text
 *
 *
 * A full list of available request parameters can be found in the Geocoder API documentation.
 * see: http://developer.here.com/rest-apis/documentation/geocoder/topics/resource-geocode.html
 *
 * @param   {H.service.Platform} platform    A stub class to access HERE services
 */
   function setUpClickListener(map) {
  // Attach an event listener to map display
  // obtain the coordinates and display in an alert box.
  map.addEventListener('tap', function (evt) {
    //converts into geocoordinates
    var position= map.screenToGeo(evt.currentPointer.viewportX,
            evt.currentPointer.viewportY);
    var geocoderService = platform.getGeocodingService();
         parameters = {
           mode:"retrieveAddress",
           maxresults: '1',
           prox:position.lat+','+position.lng,
           gen:'9',
           jsonattributes:1
         };
    
    geocoderService.reverseGeocode(parameters,
    function (result) {
      onSuccess(result);
      var loca = document.getElementById('locate');
      console.log(result);
//       $.ajax(settings).done(function (response) {
//      console.log(response);
// });
      loca.innerHTML = result;
    }, function (error) {
      alert(error);
    });
  
  });
}

/**
 * This function will be called once the Geocoder REST API provides a response
 * @param  {Object} result          A JSONP object representing the  location(s) found.
 *
 * see: http://developer.here.com/rest-apis/documentation/geocoder/topics/resource-type-response-geocode.html
 */
function onSuccess(result) {
  var locations = result.response.view[0].result;
 /*
  * The styling of the geocoding response on the map is entirely under the developer's control.
  * A representitive styling can be found the full JS + HTML code of this example
  * in the functions below:
  */
  addLocationsToMap(locations);
  addLocationsToPanel(locations);
  // ... etc.
}

/**
 * This function will be called if a communication error occurs during the JSON-P request
 * @param  {Object} error  The error message received.
 */
function onError(error) {
  alert('Can\'t reach the remote server');
}

/**
 * Boilerplate map initialization code starts below:
 */

//Step 1: initialize communication with the platform
// In your own code, replace variable window.apikey with your own apikey
var platform = new H.service.Platform({
  'apikey':'bWQsYs2V2mbIPvt-yszF0VT6qkjQ_QSCMGT73-P6eNo'
});
var defaultLayers = platform.createDefaultLayers();

//Step 2: initialize a map - this map is centered over California
var map = new H.Map(document.getElementById('map'),
  defaultLayers.vector.normal.map,{
  center: {lat:37.376, lng:-122.034},
  zoom: 15,
  pixelRatio: window.devicePixelRatio || 1
});
// add a resize listener to make sure that the map occupies the whole container
window.addEventListener('resize', () => map.getViewPort().resize());

var locationsContainer = document.getElementById('panel');

//Step 3: make the map interactive
// MapEvents enables the event system
// Behavior implements default interactions for pan/zoom (also on mobile touch environments)
var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

// Create the default UI components
var ui = H.ui.UI.createDefault(map, defaultLayers);

// Hold a reference to any infobubble opened
var bubble;

/**
 * Opens/Closes a infobubble
 * @param  {H.geo.Point} position     The location on the map.
 * @param  {String} text              The contents of the infobubble.
 */
function openBubble(position, text){
 if(!bubble){
    bubble =  new H.ui.InfoBubble(
      position,
      {content: text});
    ui.addBubble(bubble);
  } else {
    bubble.setPosition(position);
    bubble.setContent(text);
    bubble.open();
  }
}

/**
 * Creates a series of list items for each location found, and adds it to the panel.
 * @param {Object[]} locations An array of locations as received from the
 *                             H.service.GeocodingService
 */
function addLocationsToPanel(locations){
  
  var i;
  var street = document.getElementById('street');
  var district = document.getElementById('district');
  var city = document.getElementById('city');
  var postal = document.getElementById('postal');
  var county = document.getElementById('county');
  var country= document.getElementById('country');
  var position_lat = document.getElementById('position_lat');
  var position_lng = document.getElementById('position_lng');


   for (i = 0;  i < locations.length; i += 1) {
        address = locations[i].location.address,
        content =  '' + address.label  + '';
        position = {
          lat: locations[i].location.displayPosition.latitude,
          lng: locations[i].location.displayPosition.longitude
        };

      
      street.value = address.street;
      district.value = address.district;
      city.value= address.city + '';
      postal.value=address.postalCode;
      address.value=address.county;
      country.value= address.country;
      position_lat.value= Math.abs(position.lat.toFixed(4)); 
      position_lng.value = Math.abs(position.lng.toFixed(4)); 
           

  }

}


/**
 * Creates a series of H.map.Markers for each location found, and adds it to the map.
 * @param {Object[]} locations An array of locations as received from the
 *                             H.service.GeocodingService
 */
function addLocationsToMap(locations){
  var group = new  H.map.Group(),
    position,
    i;

  // Add a marker for each location found
  for (i = 0;  i < locations.length; i += 1) {
    position = {
      lat: locations[i].location.displayPosition.latitude,
      lng: locations[i].location.displayPosition.longitude
    };
    marker = new H.map.Marker(position);
    marker.label = locations[i].location.address.label;
    group.addObject(marker);
  }

  group.addEventListener('tap', function (evt) {
    map.setCenter(evt.target.getGeometry());
    openBubble(
       evt.target.getGeometry(), evt.target.label);
  }, false);

  // Add the locations group to the map
  map.addObject(group);
  map.setCenter(group.getBoundingBox().getCenter());
}

function geocode(map,str) {
  var geocoder = platform.getGeocodingService(),
    parameters = {
      searchtext:str,
      gen: '9',
      jsonattributes:1
    };

geocoder.geocode(parameters,
    function (result) {
      onSuccess(result);
      console.log(result);
    }, function (error) {
      alert(error);
    });
}

function search(map,clicked_id){
var location = document.getElementById('locate').value;
geocode(map,location);
}

function enter_Location(result,clicked_id){
  var actual_location = document.getElementById('actual_loca');
  actual_location.innerHTML = result;
}
// Now use the map as required...
setUpClickListener(map);
                  
  </script>
</html>