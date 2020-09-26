<?php

include_once 'class/client.class.php';
include_once 'class/stylist.class.php';
include_once 'class/service.class.php';
include_once 'class/review.class.php';
session_start();
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet"href="css/stylistpage.css">
        <link rel="stylesheet"href="modal/css/modals.min.css">
        <meta name="viewport" content="intial-scale=1.0,width=device-width">
  <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"
  type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"
  type="text/javascript" charset="utf-8"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="modal/js/modals.min.js" type="text/javascript"></script>
  
     <style>

    * {box-sizing:border-box}

/* Slideshow container */
.slideshow-maincontainer {
  max-width: 700px;
  position: absolute;
  margin:40px;

}

/* Hide the images by default */
.myCarouselSlides {
  display: none;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}



/* The dots/bullets/indicators */


/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}
   </style>
    </head>
    <body>
        <div class="main-container">
          <div class="slideshow-maincontainer">
      <?php
       $get = new client();
       $result = $get->getImageperstylist($_SESSION['stylistid']);
       foreach ($result as $images) {
          $imagesrc ="upload/".$images['name']; 
        ?> 
        <div class="myCarouselSlides">      
        <a href="?stylist=<?php echo $images['stylistid'];?>" type="button"><img src ="<?php echo $imagesrc;?>" width="700px" height="300px"></a>
      </div>
      
       <?php
     }
     ?>
  <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
  <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
</div>
    <div class="location">
      <a href="index.php" class="btn">Return to home</a>
      <?php
      $location = $get->getCoords($_SESSION['stylistid']);
      foreach ($location as $lat) {
      ?>
        <div style="width:450px;height:300px; margin-top:0px;"id="mapContainer">
        </div>
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
          center:{lat:<?php echo $lat['latitude'];?>, lng: <?php echo $lat['longitude'];?>},
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
    coords = {lat:<?php echo $lat['latitude'];?>, lng: <?php echo $lat['longitude'];?>},
    marker = new H.map.Marker(coords);

// Add the marker to the map and center the map at the location of the marker:
map.addObject(marker);
map.setCenter(coords);
<?php
}
?>
  </script>
    </div>

     <div class="services">
     <h1>Services</h1>
        <table>
        <thead>
            <th>Service</th>
            <th>Hours</th>
            <th>Price</th>
          </thead>
          <tbody>
       <?php
       $ser = new service();
       $work = $ser->getServices($_SESSION['stylistid']);
       foreach($work as $services){
        ?>
        <tr>
            <td><?php echo $services['services'];?></td>
            <td><?php echo $services['hours'];?></td>
            <td><?php echo $services['price'];?></td>
            <td><a href="<?php echo $services['services']?>" type="button" class="btn btn-success " data-toggle="modal" data-target="#updatemodal<?php echo $services['services'];?>">Book Now</a>
              </td></tr>
        

     <div id="updatemodal<?php echo $services['services']?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
          
               Modal content
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Book Appointment</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
              <form action="appointment.php" method="post">
            <div class="form-group">
              <label>Appointment Name</label>
                <input type="text" placeholder="" required=""name="appointmentname" class="form-control">
                    
            </div>
                <div class="form-group">
                  <label>Your Email</label>
                    <input type="text" placeholder=""  required="" name="email" class="form-control">
                    
                </div>
                <div class="form-group">
                  <label>Service</label>
                    <input type="text"placeholder=""  value="<?php echo $services['services'];?>" required="" name="service" class="form-control">
                    
                </div>
                <div class="form-group">
                  <label>Time Taken</label>
                    <input type="text" placeholder=""  value="<?php echo $services['hours'];?>" required="" name="hours" class="form-control">
                    
                </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input type="text" placeholder=""  value="<?php echo $services['price'];?>" required="" name="price" class="form-control">
                    
                </div>
                <div class="form-group">
                  <label>Preferred Date</label>
                    <input type="date" placeholder="" required="" name="date" class="form-control">
                    
                </div>
                 <div class="form-group">
                  <label>Preferred Time</label>
                    <input type="time" placeholder="" required="" name="time" class="form-control">
                    
                </div>
                <input class="btn" type="submit" name="booknow" value="Book Now"> 
            </form>
                </div>    
            </div>
          </div>
        </div>
  

</div>

            <?php
    }


 ?>
</tbody>
</table>
</div>

    <div class="info">
      <h1> -About us- </h1>
      <hr>
         <?php
            $names = new stylist();
            $name = $names->getEmail($_SESSION['stylistid']);
             foreach($name as $salon){
            ?>
            <p><b>Business Owner:</b><br><?php echo $salon['stylist_name'];?></p><br>
            <p><b>Business Name:</b><br><?php  echo $salon['businessname'];?></p><br>
            <p><b>Business Contact:</b><br><?php  echo $salon['contact'];?></p><br>
            <p><b>Business Email:</b><br><?php  echo $salon['stylistid'];?></p>
           <?php
        }
        ?>
      <br>
          <h1>Opening Hours</h1>
          <?php
       $about = $names->getAbout($_SESSION['stylistid']);
       foreach($about as $profile){
        ?>
        <b>Open all weekdays and weekends</b>
        <p><b>Opening hours:</b><?php echo $profile['openingtime']; ?></p>
        <p><b>Closing Hours:</b><?php echo $profile['closingtime']; ?></p>
        <?php
       }
      ?>
    </div>

    <div class="review" style="width:700px;">
      <h1> -Reviews- </h1>
      <hr>
         <?php
            $review = new review();
            $name = $review->getReviewsByStylist($_SESSION['stylistid']);
            if(sizeof($name)>0){
             foreach($name as $salon){
  
            ?>
            <p><?php echo $salon['clientemail'];?></p>
            <p><?php  echo $salon['datetime'];?></p>
            <p><?php  echo $salon['review'];?></p>
           <?php
        }
      }else{

        echo "<p>No reviews yet</p>";
      }
        ?>
      
    </div>
</div>

   <script>
// Get the modal

var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("myCarouselSlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
</script>


    </body>

  
</html>