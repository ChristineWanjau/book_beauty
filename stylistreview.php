<?php

include_once 'class/review.class.php';
include_once 'class/stylist.class.php';

session_start();
if(isset($_SESSION['clientemail'])){
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
      <li><a href="clientappointments.php"><i class="fas fa-qrcode"></i>Your appointments</a><li>
      <li class="active"><a href="message.php"><i class="fas fa-link"></i>Your messages</a><li>
      <li><a href="stylistreview.php"><i class="far fa-calendar"></i>Your Reviews</a><li>
      <li><a href="index.php"><i class="fas fa-stream"></i>Back to homepage</a><li>

    </ul>
  </div>

</div>
<section>
  <div class="logo">
      <h1>Your Reviews</h1>
    </div>
      <hr>
   <div class="card">
   <div class="container">
    <h1>Send a review to Stylist</h1>
   	<form action="sendreview.php" method='post'>
    <input type="hidden" name="clientemail" value="<?php echo $_SESSION['clientemail'];?>">
    <input type="text" placeholder="Stylist email" name="email"><br>
    <input type="text" placeholder="Review" name="review">
    <input type="submit" class="btn"value="Send">
    </form>
    </div>
    </div>
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