<?php

include_once 'class/client.class.php';
include_once 'class/appointment.class.php';
session_start();
if(isset($_SESSION['clientemail'])){
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <link rel="stylesheet"href="css/home.css">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet"href="modal/css/modals.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="modal/js/modals.min.js" type="text/javascript"></script>
 
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
      <h1>Your Appointments</h1>
    </div>
      <hr>
<div class="yourservices">
		 <table id ="services" style="width:100%;">
        <th>AppointmentId</th>
         <th>Appointmentname</th>
         <th>Service</th>
         <th>Date for appointment</th>
         <th>Time for appointment</th>
         <th>Status</th>
         <th>Edit appointment</th>
         <?php

         $client = new client();
         $appoint = new appointment();
         $appointment = $appoint->getAppointmentsByClient($_SESSION['clientemail']);
         if(sizeof($appointment)>0){
         foreach($appointment as $appointments){
         ?>
         <tr><td><?php echo $appointments['appointmentid'];?></td>
         <td><?php echo $appointments['appointmentname']; ?></td>
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
            <a href="?deleteappoint=<?php echo $appointments['appointmentid'];?>" type="button" onclick = "return confirm('Are you sure you want to delete this appointment?')"class="btn btn-danger">Delete</a></td>
              </td>
         </tr>

          <div id="updatemodal<?php echo $appointments['appointmentid'];?>"class="modal fade" role="dialog">
            <div class="modal-dialog">
          
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Your Appointment</h4>
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
              <form action="send.php" method="post">

              <div class="form-group">
              <label>Appointment ID</label>
                <input type="text" placeholder="" required=""name="appointmentid" value="<?php echo $appointments['appointmentid']?>"class="form-control">
                    
            </div>
            <div class="form-group">
              <label>Appointment Name</label>
                <input type="text" placeholder="" required=""name="appointmentname" value="<?php echo $appointments['appointmentname']?>"class="form-control">
                    
            </div>
            <div class="form-group">
                <input type="hidden" placeholder="" required=""name="clientemail" value="<?php echo $appointments['stylistid']?>"class="form-control">
                    
            </div>
            <div class="form-group">
              
                <input type="hidden" placeholder="" required=""name="stylistid" value="<?php echo $appointments['clientemail']?>"class="form-control">
                    
            </div>
                <div class="form-group">
                  <label>Service</label>
                    <input type="text"placeholder=""  value="<?php echo $appointments['service']?>" required="" name="service" class="form-control">
                    
                </div>
                <div class="form-group">
                  <label>Date</label>
                    <input type="date" placeholder="" value="<?php echo $appointments['date']?>"required="" name="date" class="form-control">
                    
                </div>
                 <div class="form-group">
                  <label>Time</label>
                    <input type="time" placeholder="" value="<?php echo $appointments['time']?>" required="" name="time" class="form-control">
                    
                </div>
                <input class="btn" type="submit" name="booknow" value="Edit"> 
            </form>
                </div>    
            </div>
          </div>
        </div>
         
          <?php
         }
       }else{

        echo"<tr><td>Book your appointments today with bookbeauty</td></tr>";
       }

         if(isset($_GET['deleteappoint'])){
    $id= $_GET['deleteappoint'];
    $client->deleteAppointment($id);



}
          
         ?>
          </table>
		</div>
	</div>
</section>
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