<?php


declare(strict_types= 1);
session_start();

include_once 'class/validation.class.php';
include_once 'class/dbh.class.php';

$email = $_POST['email'];
$password=$_POST['password'];

$validate = new validation();
if($validate->loginValidation($email,$password)){

	$_SESSION['email'] = $email;
	echo "
	<script>
	window.location.href='myprofile.php';
	</script>";
}
else{

	echo "
	<script>
	alert('Incorrect password or email');
	window.location.href='login.php';
	</script>";
}


?>