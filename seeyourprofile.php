<?php

include_once 'class/stylist.class.php';

session_start();
if(isset($_SESSION['stylistid']))
{
?>

<!DOCTYPE html>
<html>
<head>
	<title>home</title>
	<link rel="stylesheet"href="css/home.css">
   <script src="https://kit.fontawesome.com/a076d05399.js"></script>
     <link rel="stylesheet"href="modal/css/modals.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="modal/js/modals.min.js" type="text/javascript"></script>

   <style>

   	* {box-sizing:border-box}

/* Slideshow container */
.slideshow-maincontainer {
  max-width: 1000px;
  position: relative;
  margin: auto;
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

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

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
	<input type="checkbox"id="check">
	<label for="check">
		<i class="fas fa-bars" id="btn"></i>
		<i class="fas fa-times" id="cancel"></i>
	</label>
	<div class="sidebar">
		<header><i class="fas fa-user-circle"></i>Stylist</header>
		<ul>

            <li><a href="stylisthome.php"><i class="fas fa-qrcode"></i>My Profile</a><li>
			<li><a href="service.php"><i class="fas fa-link"></i>Services</a></li>
			<li><a href="calendar2.php"><i class="far fa-calendar"></i>Calendar</a></li>
			<li><a href="stylistappointments.php"><i class="fas fa-calendar"></i>Appointments</a></li>
		    <li><a href="clientreviews.php"><i class="fas fa-calendar-week"></i>Reviews</a></li>
		    <li><a href="logout.php"><i class="fas fa-arrow-left"></i>Log out</a></li>
		</ul>
	</div>
	<section>
		<div class="logo">
			<h1>MY PROFILE</h1>
		</div>
		<hr>

       <div class="slideshow-maincontainer">

        <?php
        $profile = new stylist();
        $pic = $profile->getImage($_SESSION['stylistid']);
      if(sizeof($pic)>0){
        foreach ($pic as $images) {
        	$imagesrc ="upload/".$images['name']; 
        ?>
  <div class="myCarouselSlides">
  <img src ="<?php echo $imagesrc;?>" style="width:1000px; height:300px;">
<div id="addImage" class="modal fade" role="dialog">
            <div class="modal-dialog">
          
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  
                  <h4 class="modal-title">Add Image</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
              <form action="seeyourprofile.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label>Image:</label>
              <input type="file" name="files[]" mutliple="multiple" class="form-control">
            </div>
		
			<button type="submit" name="addImage"class="btn btn-success">Add</button>

          </form>
                </div>

          
            </div>
          </div>
      </div>
      <a href="#" type="button" class="btn btn-success" data-toggle="modal" data-target="#addImage">Add Image</a>
  <a href="?deleteimage=<?php echo $images['name'];?>"onclick = "return confirm('Are you sure you want to delete this image?')"class="btn">delete</a>
  </div>

	<?php
}
}else{
?>
  <p>Add your first image</p>
  <a href="#" type="button" class="btn btn-success" data-toggle="modal" data-target="#addImage">Add Image</a>
  <a href="?deleteimage=<?php echo $images['name'];?>"onclick = "return confirm('Are you sure you want to delete this image?')"class="btn">delete</a>
  <?php

}

	if(isset($_GET['deleteimage'])){
    $stylistid = $_SESSION['stylistid'];
    $image = $_GET['deleteimage'];
    $profile->deleteImage($stylistid,$image);


}

if(isset($_POST['addImage'])){
    $stylistid = $_SESSION['stylistid'];
    $countfiles = count($_FILES['files']['name']);
   

	for($i=0;$i<$countfiles;$i++){
		$filename = $_FILES['files']['name'][$i];
		$target_file = 'upload/'.$filename;
		$file_extension = pathinfo($target_file,PATHINFO_EXTENSION);
		$file_extension = strtolower($file_extension);
		$valid_extension = array("png","jpeg","jpg");

		if(in_array($file_extension, $valid_extension)){
             
			if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$target_file)){

               $profile->setImage($filename,$target_file,$stylistid);
			}

}
}
 echo "<script>
    window.location.href='seeyourprofile.php';
    </script>";
}


?>
  <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
  <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
</div>
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div>
       
<br>
<br>
<br>
<div class="profile" style="margin-left:80px;">
<div class="description">
<a href="#" type="button" class="btn" data-toggle="modal" data-target="#addDescription" style="width:100%;">Add Description</a>
<div id="addDescription" class="modal fade" role="dialog">
            <div class="modal-dialog">
          
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                 
                  <h4 class="modal-title">Add Description</h4>
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
              <form action="seeyourprofile.php" method="POST">
            <div class="form-group">
              <label>Description:</label>
              <input type="text" name="description" value="" required="" class="form-control">
            </div>
		
			<button type="submit" name="addDescription"class="btn btn-success">Add</button>

          </form>
                </div>

          
            </div>
          </div>
      </div>
      <p>Your Description:</p>
<?php

$about = $profile->getDescription($_SESSION['stylistid']);
foreach($about as $description){
  ?>
  
  
  <p><?php echo $description['description'];?>
  <a href="?deletedescription=<?php echo $description['description'];?>" type="button" onclick = "return confirm('Are you sure you want to delete this description?')"class="btn" style="float:right;">Delete</a></p>
  <hr>
    
        
  <?php
}
  if(isset($_GET['deletedescription'])){
    $stylistid = $_SESSION['stylistid'];
    $description = $_GET['deletedescription'];
    $profile->deleteDescription($stylistid,$description);

    echo "<script>
    window.location.href='seeyourprofile.php';
    </script>";

}

if(isset($_POST['addDescription'])){
	$stylistid = $_SESSION['stylistid'];
	$description = $_POST['description'];
	$profile->setDescription($stylistid,$description);

	 echo "<script>
    window.location.href='seeyourprofile.php';
    </script>";
}



?>
</div>
<div class="time">
<?php	
$about = $profile->getAbout($_SESSION['stylistid']);
foreach($about as $opening){
  ?>
  <p>Opening Time:</p>
  <p><?php echo $opening['openingtime'];?>
  <a href="<?php echo $opening['openingtime'];?>" type="button" class="btn" data-toggle="modal" data-target="#addOpeningTime">Change</a>
<div id="addOpeningTime" class="modal fade" role="dialog">
            <div class="modal-dialog">
          
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  
                  <h4 class="modal-title">Change OpeningTime</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
              <form action="seeyourprofile.php" method="POST">
            <div class="form-group">
              <label>OpeningTime:</label>
              <input type="time" name="openingtime" value="<?php echo $opening['openingtime'];?>" required="" class="form-control">
            </div>
		
			<button type="submit" name="addOpeningTime" class="btn btn-success">Change</button>

          </form>
                </div>

          
            </div>
          </div>
      </div>
  <hr>
  <p>Closing Time:</p>
  <p><?php echo $opening['closingtime'];?>
   <a href="<?php echo $opening['closingtime'];?>" type="button" class="btn" data-toggle="modal" data-target="#addClosingTime">Change</a></p>
<div id="addClosingTime" class="modal fade" role="dialog">
            <div class="modal-dialog">
          
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                 
                  <h4 class="modal-title">Change ClosingTime</h4>
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
              <form action="seeyourprofile.php" method="POST">
            <div class="form-group">
              <label>ClosingTime:</label>
              <input type="time" name="closingtime" value="<?php echo $opening['closing'];?>" required="" class="form-control">
            </div>
		
			<button type="submit" name="addClosingTime" class="btn btn-success">Change</button>

          </form>
                </div>

          
            </div>
          </div>
      </div>
  <hr>
  <?php
}
  if(isset($_POST['addOpeningTime'])){
	$stylistid = $_SESSION['stylistid'];
	$opening = $_POST['openingtime'];
	$profile->updateOpeningTime($stylistid,$opening);

	echo "<script>
    window.location.href='seeyourprofile.php';
    </script>";
}


if(isset($_POST['addClosingTime'])){
	$stylistid = $_SESSION['stylistid'];
	$closing = $_POST['closingtime'];
	$profile->updateClosingTime($stylistid,$closing);

	 echo "<script>
    window.location.href='seeyourprofile.php';
    </script>";
}


?>
</div>
</div>
	</section>
</body>

<script>
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

</html>
<?php
}
else{
	echo "<script>
	alert('login first');
	window.location.href='stylistlogin.php';
	</script>";
}
?>