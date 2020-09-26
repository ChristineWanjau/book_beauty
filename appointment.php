<?php

include_once 'class/client.class.php';
include_once 'class/stylist.class.php';
include_once 'class/appointment.class.php';
session_start();

if(isset($_POST['booknow'])){

 $appointmentname = $_POST['appointmentname'];
 $clientemail = $_POST['email'];
 $service = $_POST['service'];
 $date = $_POST['date'];
 $time = $_POST['time'];
 $timetaken = $_POST['hours'];
 $stylistid = $_SESSION['stylistid'];
 $status = 2;

$endTime = strtotime("+".$timetaken."hours", strtotime($time));
$time2 = date('h:i:s', $endTime);


$insert = new client();
$appoint = new appointment();
if($appoint->setAppointment($appointmentname,$clientemail,$service,$date,$time,$status,$stylistid))
{

   if($insert->setEvent($service,$date.$time,$date.$time2,$stylistid)){;
echo"
<script>
alert('You have successfully booked');
window.location.href='stylistpage.php';
</script>";
}
}
else{
echo"
<script>
alert('unable to book ');
window.location.href='stylistpage.php';
</script>";

}

}

?>