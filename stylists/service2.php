<?php

session_start();
if(isset($_SESSION['email'])){

  if(isset($_POST['submit'])){

include_once 'class/stylistContr.php';

$service = $_POST['service'];
$hours = $_POST['hours'];
$price = $_POST['price'];

$insert = new stylistContr();
if(!$insert->createService($service,$hours,$price,$_SESSION['email'])){
    echo"<script>
	window.location.href='service.php';
	</script>";
}
else{
	
    echo "<script>
	alert('unable');
	window.location.href='service.php';
	</script>";
}

}
}

else
{
	echo "<script>
	alert('login first');
	window.location.href='stylistlogin.php';
	</script>";
}

?>