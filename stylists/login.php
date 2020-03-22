<?php

declare(strict_types= 1);
session_start();

include_once 'class/validation.class.php';
include_once 'class/dbh.class.php';
 
if(isset($_SESSION['email'])){

	header("Location:stylisthome.php");
}
else{

if(isset($_POST['login'])){
$email = $_POST['email'];
$password=$_POST['password'];

$validate = new validation();
if($validate->loginValidation($email,$password)){
    
    $_SESSION['email'] = $email;
	echo "
	<script>
	window.location.href='stylisthome.php';
	</script>";
}
else{

	echo "
	<script>
	alert('Incorrect password or email');
	window.location.href='stylistlogin.php';
	</script>";
}
}
}


?>