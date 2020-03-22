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
   <script src="home.js"></script>
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
			<li><a href="stylisthome.php"><i class="fas fa-qrcode"></i>My Profile</a><li>
			<li class="active"><a href="service.php"><i class="fas fa-link"></i>Services</a><li>
			<li><a href="#"><i class="fas fa-stream"></i>Appointments</a><li>
		    <li><a href="#"><i class="fas fa-calendar-week"></i>Reviews</a><li>
		    <li><a href="#"><i class="fas fa-question-circle"></i>About</a><li>
		    <li><a href="#"><i class="fas fa-sliders-h"></i>Contact</a><li>
		</ul>
	</div>
	<section>
		<div class="logo">
			<h1>Your services</h1>
		</div>
		<div class="yourservices">
         <?php

         $stylist = new stylist();
         $service = $stylist->getService($_SESSION['email']);
         foreach($service as $services){
         ?>
         <table>
         <th>Service </th>
         <th>Hours</th>
         <th>Price</th>
         <tr><td><?php echo $services['services']; ?></td>
         	 <td><?php echo $services['hours']; ?></td>
         	 <td><?php echo $services['price']; ?></td>
         </tr>
          </table>
          <?php
         }
          
         ?>
		</div>
		<button class="open-button" onclick="openForm()">Add Service</button>
			<div class="form-popup" id="myForm">
              <form action="service2.php" method="post" class="form-container">
                 <h1>Add Service</h1>
               	<label for="Service"><b>Service</b></label>
               		<input type="text" placeholder="Enter Service" name="service" required="">
                	<label for="Hours"><b>Hours</b></label>
                	<input type="text" placeholder="Enter Hours" name="hours" required=""><br>
                	<label for="Price"><b>Price</b></label>
                	<input type="text" placeholder="Enter Price" name="price" required="">
                	<input type="submit" name="submit" class="btn" value="Enter Service">
                <button type="submit" class="btn cancel" onclick="closeForm()">Close</button>
               </form>
			</div>
	</section>
</body>
</html>
<?php
}else{
	
	echo "<script>
	alert('login first');
	window.location.href='stylistlogin.php';
	</script>";
}

?>