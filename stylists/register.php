<? php

include_once 'class/stylistContr.php';
include_once 'class/validation.class.php';

$businessname = $_POST['businessname'];
$stylistname =$_POST['name'];
$email = $_POST['email'];
$contact= $_POST['contact'];
$location =$_POST['location'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

    //Password hashing
$validate= new validation();
$insert = new stylistContr();
if(!$validate->signValidation($email,$password,$confirm)){
     echo"<script>
       alert('Unable');
       window.location.href='stylistregister.php';
       </script>";

}
elseif(!$hashedpassword = password_hash($password, PASSWORD_DEFAULT)){
   echo"<script>
       alert('Unable to hash password');
       window.location.href='stylistregister.php';
       </script>";
}
else

if($insert->createStylist($businessname,$stylistname,$email,$password,$contact,$location)){
  
   echo"<script>
       alert('inserted successfully');
       window.location.href='stylisthome.html';
       </script>";
}
else{
  
   echo"<script>
       alert('Unable to insert');
       window.location.href='stylistregister.php';
       </script>";
}

? >
