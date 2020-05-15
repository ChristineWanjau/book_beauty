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
   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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
			<li><a href="calendar.php"><i class="far fa-calendar"></i>Calendar</a><li>
			<li><a href="stylistappointments.php"><i class="fas fa-stream"></i>Appointments</a><li>
		    <li><a href="#"><i class="fas fa-calendar-week"></i>Reviews</a><li>
		    <li><a href="#"><i class="fas fa-question-circle"></i>About</a><li>
		    <li><a href="#"><i class="fas fa-sliders-h"></i>Contact</a><li>
		</ul>
	</div>
	<section>
		<div class="logo">
			<h1>Your Appoitnments</h1>
		</div>
		<div class="yourservices">
		 <table id ="services" style="width:100%;">
         <th>Appointmentname</th>
         <th>ClientEmail</th>
         <th>Service</th>
         <th>Date for appointment</th>
         <th>Time for appointment</th>
         <th>Status</th>
         <?php

         $stylist = new stylist();
         $appointment = $stylist->getAppointment($_SESSION['stylistid']);
         foreach($appointment as $appointments){
         ?>
         <tr><td><?php echo $appointments['appointmentname']; ?></td>
         	 <td><?php echo $appointments['clientemail']; ?></td>
         	 <td><?php echo $appointments['service']; ?></td>
         	 <td><?php echo $appointments['date']; ?></td>
         	 <td><?php echo $appointments['time']; ?></td>
         	 <td><?php 
         	 $status = $appointments['appointmentstatus'];

         	 switch($status){
         	 	case 1:
         	 	echo "Done";
         	 	break;
         	 	case 2:
         	 	echo "Pending";
         	 	break;
         	 	default:
         	    echo "postponed";
         	 	break;

         	 } ?></td>
         </tr>
         
          <?php
         }
          
         ?>
          </table>
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