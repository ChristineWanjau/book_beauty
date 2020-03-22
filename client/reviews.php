<?php

include_once 'class/client.class.php';

session_start();
if(isset($_SESSION['email'])){
?>

<!DOCTYPE html>
<html>
<head>
	<title>home</title>
	<link rel="stylesheet"href="css/myprofile.css">
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
			<li><a href="myprofile.php"><i class="fas fa-qrcode"></i>My Profile</a><li>
			<li><a href="#"><i class="fas fa-calendar"></i>Appointments</a><li>
		    <li class="active"><a href="reviews.php"><i class="fas fa-calendar-week"></i>Reviews</a><li>
		    <li><a href="#"><i class="fas fa-question-circle"></i>Settings</a><li>
		</ul>
	</div>
	<section>
		<div class="logo">
			<h1>MY PROFILE</h1>
		</div>
		<div class="session">
			<i class="fas fa-user-circle"></i>
			<a href="logout.php">Log out</a>
            <?php
            $names = new client();
            $name = $names->getEmail( $_SESSION['email']);
             foreach($name as $client){
        	echo $client['first_name'];
        }
            echo $_SESSION['email'];
      ?>
            
        </div>
	</section>
</body>
</html>
<?php
}
else{
	echo "<script>
	alert('login first');
	window.location.href='login.php';
	</script>";
}
?>