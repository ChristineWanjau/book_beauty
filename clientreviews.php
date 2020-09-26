<?php

include_once 'class/review.class.php';
include_once 'class/stylist.class.php';

session_start();
if(isset($_SESSION['stylistid'])){
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet"href="css/home.css">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
   	<input type="checkbox"id="check">
  <label for="check">
    <i class="fas fa-bars" id="btn"></i>
    <i class="fas fa-times" id="cancel"></i>
  </label>
  <div class="sidebar">
    <header>Stylist</header>
    <ul>
            <li class="active"><a href="stylisthome.php"><i class="fas fa-qrcode"></i>My Profile</a><li>
			<li><a href="service.php"><i class="fas fa-link"></i>Services</a></li>
			<li><a href="calendar2.php"><i class="far fa-calendar"></i>Calendar</a></li>
			<li><a href="stylistappointments.php"><i class="fas fa-calendar"></i>Appointments</a></li>
		    <li><a href="clientreviews.php"><i class="fas fa-calendar-week"></i>Reviews</a></li>
		    <li><a href="logout.php"><i class="fas fa-arrow-left"></i>Log out</a></li>

    </ul>
  </div>

</div>
<section>
  <div class="logo">
      <h1>Reviews</h1>
    </div>
      <hr>
      <br>
      <br>
      <?php
     $get = new review();
     $reviews = $get->getReviewsByStylist($_SESSION['stylistid']);
     if(sizeof($reviews)>0){
     foreach ($reviews as $text) {
      ?>
   <div class="card">
   <div class="container">
   	<p><b>Client:</b><?php echo $text['clientemail']; ?></p>
   	<br>
   	<p><b>Date:</b><?php echo $text['datetime']; ?></p>
   	<br>
    <p><b>Review:</b><?php echo $text['review']; ?></p>
     
    </div>
    </div>
    <?php
}
}else{
  ?>
  <div class="card">
   <div class="container">
    <p><b>No reviews yet</b></p>
     
    </div>
    </div>
    <?php

}
 
?>
    <br> 

</div>
</section>
	</body>
</html>
<?php
}
else{

	echo"
	<script>
	alert('login first')
	window.location.href='clientlogin.php'
	</script>";
	
}
?>