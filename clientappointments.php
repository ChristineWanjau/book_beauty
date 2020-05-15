<?php

include_once 'class/client.class.php';
session_start();
if(isset($_SESSION['clientemail'])){
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet"href="css/app.css">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
</head>
    <body>
    	<div id="main">
            <div class="topnav" id="myTopnav">
              <div class="nav-logo">
                <p>Book Beauty</p>
              </div>


</div>
<hr>
   <div id="mySidenav" class="sidenav">
    <div class="user">
   <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
   	<i class="fas fa-user-circle"></i>
    <p><?php echo $_SESSION['clientemail'];?></p>
    </div>
    <a href="clientappointments.php"><i class="fas fa-link"></i>Appointments</a>
    <a href="message.php"><i class="far fa-calendar"></i>Messages</a>
    <a href="review.php"><i class="fas fa-calendar-week"></i>Your Reviews</a>
    <a href="home.php"><i class="fas fa-arrow-left"></i>Back to home page</a>
</div>

<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
<div class="yourservices">
		 <table id ="services" style="width:100%;">
         <th>Appointmentname</th>
         <th>Service</th>
         <th>Date for appointment</th>
         <th>Time for appointment</th>
         <th>Status</th>
         <th>Edit appointment</th>
         <?php

         $client = new client();
         $appointment = $client->getAppointments($_SESSION['clientemail']);
         foreach($appointment as $appointments){
         ?>
         <tr><td><?php echo $appointments['appointmentname']; ?></td>
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
           <td><button class="btn">Edit</button>
         </tr>
         
          <?php
         }
          
         ?>
          </table>
		</div>
	</div>
	</body>
</html>
<?php
}
else{
	
	echo "
	alert('login first');
	window.location.href='clientlogin.php';
	";
}
?>