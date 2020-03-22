<?php

include_once 'class/stylist.class.php';

session_start();
if(isset($_SESSION['email'])){
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
		<header>Stylist</header>
		<ul>
			<li class="active"><a href="stylisthome.php"><i class="fas fa-qrcode"></i>My Profile</a><li>
			<li><a href="service.php"><i class="fas fa-link"></i>Services</a><li>
			<li><a href="#"><i class="fas fa-calendar"></i>Appointments</a><li>
		    <li><a href="#"><i class="fas fa-calendar-week"></i>Reviews</a><li>
		    <li><a href="#"><i class="fas fa-question-circle"></i>About</a><li>
		    <li><a href="#"><i class="fa fa-volume-control-phone"></i>Contact</a><li>
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
            $names = new stylist();
            $name = $names->getEmail( $_SESSION['email']);
             foreach($name as $salon){
        	echo $salon['stylist_name'];
        	echo $salon['businessname'];
        }
            echo $_SESSION['email'];
      ?>
            
        </div>

        <div class ="profile">
        <?php
        $profile = new stylist();
        $profile->getImage($_SESSION['email']);
        $results = $profile->getAbout($_SESSION['email']);
        foreach($results as $stylist){
        	echo $stylist['description'];
        }
        ?>

        </div>
		<div class="about">
			<form action="about.php" method="post" enctype="multipart/form-data">
				<div class="textbox">
				<input type="file" name="img[]" mutliple="multiple"/>
			</div>
				<div class="textbox">
				<textarea name="description" ROWS="10" COLUMNS="20"></textarea>
			</div>
			<!-- 	<div class="textbox">
				<input type="text" placeholder="location">
			</div> -->
				<div class="textbox">
				<label>Opening hours:</label><br>
				<input type="time" name="openingtime" placeholder="opening hours">
			</div>
			<div class="textbox">
				<label>Closing hour:</label><br>
				<input type="time" name="closingtime" placeholder="closing hours">
			</div>
           <input type="submit" name="submit">
			</form>
		</div>
		<div class="insert image">
			<p>insert image here</p>
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