<?php

include_once 'class/client.class.php';
include_once 'class/stylist.class.php';

session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet"href="css/style2.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
         <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    </head>
    <body>
        <div class="main-container">
            <div class="topnav" id="myTopnav">
              <div class="nav-logo">
                <p>Book Beauty</p>
              </div>
                  <div class="search-container">
      <form action="home.php" method="get">
    <input type="text" class="search" required=""placeholder="What are you looking for?" name ="service">
    <button type="submit" name="search"><i class="fa fa-search"></i></button>
  </form>
  <form action="position.php" method="post">
  <input type="text" class="search" required=""placeholder="Where are you looking for?" id="locate">
  <input type="hidden" id="position_lat" name="lat" required="">
  <input type="hidden" id="position_lng" name="lng" required="">
  <input type="submit"/>
</form>
<button  name="search" id="btn" onClick="search(this.id)"><i class="fa fa-search"></i></button>
    </form>
    </div>
              <a href="stylistlogin.php">Sign up for businesses</a>
              <a href="clientlogin.php">Log in</a>
               <div class="dropdown">
               <button class="dropbtn"><?php if(isset($_SESSION['clientemail'])){
                echo $_SESSION['clientemail'];
                ?>
                <span class="sms">
                  <?php
                  $noti = new client();
                  $results = array();
                  $sms = $noti->getNumberOfsms($_SESSION['clientemail']);                  
                  ?>
                </span>
                <i class="fa fa-caret-down"></i>
              </button>
              <div class="dropdown-content">
               <a href="clientappointments.php">Your appointments</a>
               <a href="message.php">Your messages</a>
              <a href="clientlogout.php">Logout</a>
        </div>
        <?php 
               };?>
  </div>

</div>
  <div class="banner-title">
        <p><b></b></p>

</div>
<br>
</div>
<div class="topic">
<h1>- Some of the services you can find -</h1>
</div>
<div class="services">
  <ul>
    <?php
     $get = new client();
     $offers = $get->getServicesOffered();
     foreach($offers as $row){
      ?>
    <li><b><a href="?getSpecific=<?php echo $row['service'];?>"><?php echo $row['service'];?></a></b></li>
    <?php
  }
  ?>
  </ul>
  </div>
      <div class="topic">
        <h1>- Recommendations -</h1>
      </div>
       <div id="recommendations">
       	<?php

        if(isset($_GET['search'])){
           
           $service = $_GET['service'];
           $style = $get->getSalonistByService($service);
           foreach($style as $stylist){
            $image = $stylist['image_name']; 
            ?>
            <div class="image">
              <a href="?stylist=<?php echo $stylist['stylistid'];?>" type="button"><img src ="<?php echo $image;?>" width='200px' height='200px'></a>
                <div class="textbox">
                  <p><?php 
                 $style = new stylist();
                 $salon = $style->getEmail($stylist['stylistid']);
                 foreach ($salon as $row) {
                 echo $row['businessname'];
              }
          ?>
              <?php
           }
           ?>
         </p>
       </div>
     </div>
       <?php
        }
     elseif(isset($_GET['getSpecific'])){
           $specific_service = $_GET['getSpecific'];
           $specificstylist = $get->getSalonistByService($specific_service);
           foreach($specificstylist as $stylist){
            $image ="upload/".$stylist['image_name']; 
            ?>
            <div class="image">
              <a href="?stylist=<?php echo $stylist['stylistid'];?>" type="button"><img src ="<?php echo $image;?>" width='200px' height='200px'></a>
                <div class="textbox">
                  <p><?php 
                 $style = new stylist();
                 $salon = $style->getEmail($stylist['stylistid']);
                 foreach ($salon as $row) {
                 echo $row['businessname'];
              }
          ?>
              <?php
           }
           ?>
         </p>
       </div>
     </div>
     <?php
    
     }
     
        else{
       $result = $get->getImage();
       foreach ($result as $images) {
          $imagesrc ="upload/".$images['name']; 
        ?> 
        <div class="image">      
        <a href="?stylist=<?php echo $images['stylistid'];?>" type="button"><img src ="<?php echo $imagesrc;?>" width='200px' height='200px'></a>
        <div class="textbox">
          <p>Name:<?php 
          $style = new stylist();
          $salon = $style->getEmail($images['stylistid']);
          foreach ($salon as $row) {
            echo $row['businessname'];
        }?>
        Location:<?php
        $location = $style->getLocation($images['stylistid']);
        foreach ($location as $place) {
        
          echo $place['city'];
          echo $place['street'];
        }
        ?>
          
          </p>
        </div>
      </div>
       <?php
     }
       ?>
       <?php
     }

    ?>
  </div>
</div>
<div class="topic"> 
<h1>- Why Book Beauty? -</h1>
</div>
<div class="advertise">
   <img src="images/photo2.jpg.jpg" alt="Notebook">
  <div class="content">
    <h1>For Businesses</h1>
    <p>Advertise your business now<br>Enable your customers to book with you anytime and any day</p>
    <button class="btn"><a href="stylistlogin.php">Join Now</a></button>
  </div>
  </div>
  <div class="topic">
    <h1>- Join our happy customers -</h1>
  </div>
  <div class="reviews">

  <div class="client">
    <img src="images/salon.jpg"  style="width:200px; height: 200px">
    <div class="content">Absolutely love book beauty</div>
    </div>
  <div class="client">
    <img src="images/salon2.jpg"  style="width:200px; height:200px;">
    <div class="content">Absolutely love book beauty</div>
  </div>
  <div class="client">
    <img src="images/photo6.jpg"  style="width:200px; height: 200px">
    <div class="content">Absolutely love book beauty</div>
  </div>
    <div class="client">
    <img src="images/photo6.jpg"  style="width:200px; height: 200px">
    <div class="content">Absolutely love book beauty</div>

  </div>
</div>

<div class="footer">
  <p>Contact us</p>
</div>
  <div style= "width:450px;height:300px;"id="map"></div>
    </body>
    <?php
     if(isset($_GET['stylist'])){
        $stylist = $_GET['stylist'];
        $_SESSION['stylistid'] = $stylist;
        echo "<script>
        window.location.href='stylistpage.php';
        </script>";
      }

    ?>
    
     <script>

  function setMapViewBounds(map){
  var bbox = new H.geo.Rect(42.3736,-71.0751,42.3472,-71.0408);
  map.getViewModel().setLookAtData({
    bounds: bbox
  });
}

/**
 * Boilerplate map initialization code starts below:
 */

//Step 1: initialize communication with the platform
// In your own code, replace variable window.apikey with your own apikey

function search(map,clicked_id){
var location = document.getElementById('locate').value;
geocode(map,location);
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


function onSuccess(result) {
  var locations = result.response.view[0].result;
 /*
  * The styling of the geocoding response on the map is entirely under the developer's control.
  * A representitive styling can be found the full JS + HTML code of this example
  * in the functions below:
  */

  addLocationsToPanel(locations);
  // ... etc.
}

function addLocationsToPanel(locations){
  
  var i;
  var position_lat = document.getElementById('position_lat');
  var position_lng = document.getElementById('position_lng');


   for (i = 0;  i < locations.length; i += 1) {
        address = locations[i].location.address,
        content =  '' + address.label  + '';
        position = {
          lat: locations[i].location.displayPosition.latitude,
          lng: locations[i].location.displayPosition.longitude
        };

      position_lat.value= Math.abs(position.lat.toFixed(4)); 
      position_lng.value = Math.abs(position.lng.toFixed(4)); 
      console.log(position_lng.value);
      console.log(position_lat.value); 

  }

}

function onError(error) {
  alert('Can\'t reach the remote server');
}
/**
 * Boilerplate map initialization code starts below:
 */

 /*checking if browser supports goelocation*/



//Step 1: initialize communication with the platform
// In your own code, replace variable window.apikey with your own apikey
var platform = new H.service.Platform({
  'apikey':'bWQsYs2V2mbIPvt-yszF0VT6qkjQ_QSCMGT73-P6eNo'
});
var defaultLayers = platform.createDefaultLayers();

//Step 2: initialize a map
var map = new H.Map(document.getElementById('map'),
  defaultLayers.vector.normal.map, {
  center: {lat: 52.51477270923461, lng: 13.39846691425174},
  zoom: 13,
  pixelRatio: window.devicePixelRatio || 1
});
// add a resize listener to make sure that the map occupies the whole container
window.addEventListener('resize', () => map.getViewPort().resize());

//Step 3: make the map interactive
// MapEvents enables the event system
// Behavior implements default interactions for pan/zoom (also on mobile touch environments)
var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

var geocoderService = platform.getGeocodingService();
  if(navigator.geolocation){
   navigator.geolocation.getCurrentPosition(position =>{
        map.setCenter({
          lat: position.coords.latitude,
          lng: position.coords.longitude
        });

        geocoderService.reverseGeocode(
          {
           mode:"retrieveAddress",
           maxresults: 1,
           prox:position.coords.latitude+","+ position.coords.longitude
         },
        success => {

          console.log(success.response);

        },

        error =>{

          console.error(error);
        },
        );
   });
 }
// Create the default UI components
var ui = H.ui.UI.createDefault(map, defaultLayers);

var bubble;
/**
 * @param {H.mapevents.Event} e The event object
 */
function onTap(evt) {
  // calculate infobubble position from the cursor screen coordinates
  let position = map.screenToGeo(
    evt.currentPointer.viewportX,
    evt.currentPointer.viewportY
  );
  // read the properties associated with the map feature that triggered the event
  let props = evt.target.getData().properties;

  // Create a bubble, if not created yet
  if (!bubble) {
    bubble = new H.ui.InfoBubble(position, {
      content: content
    });
    ui.addBubble(bubble);
  } else {
    // Reuse existing bubble object
    bubble.setPosition(position);
    bubble.setContent(content);
    bubble.open();
  }
}




// Now use the map as required... 
setMapViewBounds(map);                  

   
</script>
</html>