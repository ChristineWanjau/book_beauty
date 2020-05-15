<?php

include_once 'class/client.class.php';
include_once 'class/stylist.class.php';
session_start();
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet"href="css/stylistpage.css">
        <meta name="viewport" content="intial-scale=1.0,width=device-width">
  <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"
  type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"
  type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="main-container">
      <?php
       $get = new client();
       $result = $get->getImageperstylist($_SESSION['stylistid']);
       foreach ($result as $images) {
          $imagesrc ="upload/".$images['name']; 
        ?> 
        <div class="image">      
        <a href="?stylist=<?php echo $images['stylistid'];?>" type="button"><img src ="<?php echo $imagesrc;?>" width="700px" height="400px"></a>
      </div>
      
       <?php
     }
     ?>
    <div class="location">
        <div style="width:450px;height:300px"id="mapContainer"></div>
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
       $work = $get->getServices($_SESSION['stylistid']);
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
          
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Book Appointment</h4>
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
                    <input type="text"placeholder=""  value="<?php echo $services['hours'];?>" required="" name="hours" class="form-control">
                    
                </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input type="text"placeholder=""  value="<?php echo $services['price'];?>" required="" name="price" class="form-control">
                    
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
</div>

<!-- 
    <a href="?exit" class="btn">Back</a>

    <?php
    if(isset($_GET['exit'])){
      
    unset($_SESSION['email']);
    echo "
    <script>
    window.location.href='home.php';
    </script>";

    }
    ?> -->
   <script>
// Get the modal
var modal = document.querySelector("#myModal");

// Get the button that opens the modal
var btn = document.querySelectorAll("#myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
function openModal(){
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function closeModal() {
modal.style.display = "none";
}

for (var i = 0 ; i< btn.length;i++){
btn[i].addEventListener('click',openModal);}

span.addEventListener('click',closeModal);
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>


    </body>

  
</html>