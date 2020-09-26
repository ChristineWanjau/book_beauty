<?php

include_once 'class/stylist.class.php';
include_once 'class/stylistvalidation.php';
session_start();
if(isset($_POST['submit'])){

$street = $_POST['street'];
$district = $_POST['district'];
$city = $_POST['city'];
$postal = $_POST['postal'];
$country = $_POST['country'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];




$inserted = new stylist();
$inserted->setLocation($_SESSION['email'],$street,$district,$city,$postal,$country,$lat,$lng);

}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style3.css">
</head>
<body>
	<div class="logo">
		<p>Set your password to finish registration</p>
	</div>
	<div class="container">
	<form action="stylistregister3.php" method="POST">
		<div class="textbox">
            <input type="password" name="password" pattern="^\S{4,}$" required="">
            <label> Set your Password</label>
            </div>
             <div class="textbox">
            <input type="password" name="confirm" required="">
            <label> Confirm Password</label>
            </div>
            <button class="btn" type="submit" name="done">Submit</button>
	</form>
</div>
</body>
</html>
<?php
if(isset($_POST['done'])){

$password = $_POST['password'];
$confirm = $_POST['confirm'];
    
$validate = new stylistvalidation();
$insert = new stylist();
if(!$validate->signupValidation($_SESSION['email'],$password,$confirm)){
     echo"<script>
       alert('Unable to insert');
       window.location.href='stylistregister3.php';
       </script>";
  
}
elseif(!$hashedpassword = password_hash($password, PASSWORD_DEFAULT)){
   echo"<script>
       alert('Unable to hash password');
       window.location.href='index.php';
       </script>";
}
elseif($insert->setStylist($_SESSION['businessname'],$_SESSION['stylist_name'],$_SESSION['email'],$hashedpassword,$_SESSION['contact'])){

	echo "
	<script>
	window.location.href='stylistlogin.php';
	</script>";
}

else{
	echo"<script>
       alert('unable to insert');
       window.location.href='stylistregister2.php';
       </script>";
}
}

?>