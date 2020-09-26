<?php

include_once 'class/stylist.class.php';

session_start();
if(isset($_SESSION['stylistid'])){
?>

<!DOCTYPE html>
<html>
<head>
	<title>home</title>
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
		<header><i class="fas fa-user-circle"></i>Stylist</header>
		<ul>

           <!--  <?php
            $names = new stylist();
            $name = $names->getEmail( $_SESSION['stylistid']);
             foreach($name as $salon){
             	?>
        	<li><p>Welcome:</p><?php echo $salon['stylist_name']; ?></li>
        	<li><?php echo $salon['businessname']; ?></li>
        	<?php
        }
  
      ?> -->
            <li class="active"><a href="stylisthome.php"><i class="fas fa-qrcode"></i>My Profile</a><li>
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

        <div class="profile_form">
        	<a href="seeyourprofile.php" class="btn">See Your Profile</a>
			
			<form action="about.php" method="post" enctype="multipart/form-data">
				<div class="text">
			    <label>Insert Image</label><br>
				<input type="file" name="files[]" mutliple="multiple"/>
			</div>
			<br>
				<div class="text">
				<label>Description</label><br>
				<textarea name="description" ROWS="10"></textarea>
			</div>
			<br>
				<div class="text">
				<label>Opening hours:</label><br>
				<input type="time" name="openingtime" placeholder="opening hours">
			</div>
			<br>
			<div class="text">
				<label>Closing hour:</label><br>
				<input type="time" name="closingtime" placeholder="closing hours">
			</div>
			<br>
           <input type="submit" class="btn"name="submit">
			</form>
		</div>
       

	</section>
</body>
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