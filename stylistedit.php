<?php
include 'class/appointment.class.php';
include 'class/notifications.class.php';
session_start();

$stylistid = $_SESSION['stylistid'];
$clientemail = $_POST['clientemail'];
$appointmentid = $_POST['appointmentid'];
$date = $_POST['date'];
$time = $_POST['time'];
$message = $_POST['message'];

$send = new appointment();
$noti = new notifications();

$results = $send->stylistEditAppointment($date,$time,$appointmentid);
if($results){
	$noti->sendStylistNotification($clientemail,$message,$stylistid);
	echo "
	<script>
	window.location.href='stylistappointments.php';
	</script>";
}
else{
	echo"
	<script>
	alert('unable to edit');
	</script>";
}


?>