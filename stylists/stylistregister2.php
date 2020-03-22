<?php

declare(strict_types= 1);

include_once 'class/stylistContr.php';
include_once 'class/validation.class.php';

$businessname = $_POST['businessname'];
$stylist_name =$_POST['name'];
$email = $_POST['email'];
$contact= $_POST['contact'];
$location =$_POST['location'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

    
$validate = new validation();
$insert = new stylistContr();
if(!$validate->signupValidation($email,$password,$confirm)){
     echo"<script>
       alert('Unable to insert');
       window.location.href='stylistregister.php';
       </script>";
  
}
elseif(!$hashedpassword = password_hash($password, PASSWORD_DEFAULT)){
   echo"<script>
       alert('Unable to hash password');
       window.location.href='index.php';
       </script>";
}
elseif(!$insert->createStylist($businessname,$stylist_name,$email,$password,$contact,$location)){
  
   echo"<script>
       alert('inserted successfully');
       window.location.href='stylistlogin.php';
       </script>";
}
else{
  
   echo"<script>
       alert('Unable to insert');
       window.location.href='index.php';
       </script>";
}

?>
