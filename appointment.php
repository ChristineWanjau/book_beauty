<?php

include_once 'class/client.class.php';
include_once 'class/stylist.class.php';
session_start();

if(isset($_POST['booknow'])){

 $appointmentname = $_POST['appointmentname'];
 $clientemail = $_POST['email'];
 $service = $_POST['service'];
 $date = $_POST['date'];
 $time = $_POST['time'];
 $timetaken = $_POST['timetaken'];
 $stylistid = $_SESSION['stylistid'];
 $status = 2;


$insert = new client();
if($insert->setAppointment($appointmentname,$clientemail,$service,$date,$time,$status,$stylistid))
{
echo"
<script>
alert('You have successfully booked');
window.location.href='stylistpage.php';
</script>";
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