<?php

declare(strict_types= 1);
include_once 'class/clientContr.class.php';
include_once 'class/validation.class.php';

$firstname = $_POST['firstname'];
$lastname =$_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

    //Password hashing
$validate = new validation();
$insert = new clientContr();
if(!$validate->signupValidation($email,$password,$confirm)){
     echo"<script>
       alert('Unable to insert');
       window.location.href='register.html';
       </script>";

}
elseif(!$hashedpassword = password_hash($password, PASSWORD_DEFAULT)){
   echo"<script>
       alert('Unable to hash password');
       window.location.href='register.html';
       </script>";
}
elseif(!$insert->createClient($firstname,$lastname,$email,$phone,$hashedpassword)){
  
   echo"<script>
       alert('inserted successfully');
       window.location.href='home.php';
       </script>";
}
else{
  
   echo"<script>
       alert('Unable to insert');
       window.location.href='register.html';
       </script>";
}

?>