<?php

include_once 'class/appointment.class.php';

session_start();
if(isset($_SESSION['stylistid'])){

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
      <li><a href="service.php"><i class="fas fa-link"></i>Services</a></li>
      <li><a href="calendar2.php"><i class="far fa-calendar"></i>Calendar</a></li>
      <li class="active"><a href="stylistappointments.php"><i class="fas fa-calendar"></i>Appointments</a></li>
        <li><a href="clientreviews.php"><i class="fas fa-calendar-week"></i>Reviews</a></li>
        <li><a href="logout.php"><i class="fas fa-arrow-left"></i>Log out</a></li>
		</ul>
	</div>
	<section>
		<div class="logo">
			<h1>Your Appointments</h1>
		</div>
      <hr>
		<div class="yourservices">
		 <table id ="services" style="width:100%;">
         <th>AppointmentId</th>
         <th>Appointmentname</th>
         <th>ClientEmail</th>
         <th>Service</th>
         <th>Date for appointment</th>
         <th>Time for appointment</th>
         <th>Status</th>
         <?php

         $stylist = new appointment();
         $appointment = $stylist->getAppointmentByStylist($_SESSION['stylistid']);
         if(sizeof($appointment)>0){
         foreach($appointment as $appointments){
         ?>
         <tr><td><?php echo $appointments['appointmentid']; ?></td>
            <td><?php echo $appointments['appointmentname']; ?></td>
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
              <td><a href="<?php echo $appointments['appointmentid'];?>"type="button" class="btn btn-success " data-toggle="modal" data-target="#updatemodal<?php echo $appointments['appointmentid'];?>">Edit</a>
               <a href="?deleteappointment=<?php echo $appointments['appointmentid'];?>" type="button" onclick = "return confirm('Your appointment has been completed')"class="btn btn-danger">Done</a></td>
         </tr>

         <div id="updatemodal<?php echo $appointments['appointmentid']?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
          
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  
                  <h4 class="modal-title">Edit Appointment</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
              <form action="stylistedit.php" method="POST">
               <input type="hidden" name="appointmentid" value="<?php echo $appointments['appointmentid'];?>" required="" class="form-control">
               <input type="hidden" name="clientemail" value="<?php echo $appointments['clientemail'];?>" required="" class="form-control">
            <div class="form-group">
              <label>Date:</label>
               <input type="text" name="date" value="<?php echo $appointments['date'];?>" required="" class="form-control">
            </div>
            <div class="form-group">
              <label>Time:</label>
              <input type="text" name="time" value="<?php echo $appointments['time'];?>" required="" class="form-control">
            </div>
            <div class="form-group">
              <label>Message:</label>
              <input type="text" name="message" value="" required="" class="form-control">
            </div>
      
         <button type="submit" name="updatebutton"class="btn btn-success">Edit</button>

          </form>
                </div>
                <div class="modal-footer">

                </div>
          
            </div>
          </div>
        </div>
         
          <?php
         }
       }else{

        echo "<tr><td>No appointments yet</td></tr>";
       }

          
         ?>
          </table>
		</div>
	</section>
</body>
</html>
<?php

if(isset($_GET['deleteappointment'])){
    $stylistid = $_SESSION['stylistid'];
    $appointmentid = $_GET['deleteappointment'];
    $stylist->deleteAppointment($appointmentid);

}
}else{
	
	echo "<script>
	alert('login first');
	window.location.href='stylistlogin.php';
	</script>";
}

?>