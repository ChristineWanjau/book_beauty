<?php

include 'class/client.class.php';

$appointmentid = $_POST['appointmentid'];
$appointmentname =$_POST['appointmentname'];
$clientemail = $_POST['clientemail'];
$stylistid = $_POST['stylistid'];
$service = $_POST['service'];
$date = $_POST['date'];
$time = $_POST['time'];

$send = new client();

$results = $send->editAppointment($appointmentid,$appointmentname,$service,$date,$time);
if($results){
    $notification = $clientemail."has edited their appointment.Appointment number".$appointmentid;
	$send->sendNotification($clientemail,$notification,$stylistid,$appointmentid);
	echo "
	<script>
	window.location.href='clientappointments.php';
	</script>";
}
else{
	echo"
	<script>
	alert('unable to edit');
	</script>";
}


?>