<?php

include_once 'class/stylist.class.php';

if(isset($_POST['reset'])){

//have two tokens
	//one to authenticate 
	//check the database 
 $selector = bin2hex(random_bytes(8));
 $token = random_bytes(32);

 $url = "www.book_beauty.net/forgottenpwd/create-new-password.php?selector=".$selector."&validator=".bin2hex($token);

 $expires = date("U") + 1800; //expire one hour from now

$useremail = $_POST['email'];

//delete any existing tokens inside the database

$style = new stylist();
$style->deleteToken($useremail);
//hashtoken

$hashedToken = password_hash($token, PASSWORD_DEFAULT);
$style->setToken($useremail,$selector,$hashedToken,$expires);

$to = $useremail;

$subject = 'Reset your password for book_beauty';

$message = '<p>We recieved a password reset request .The link to reset your password make this request, you can ignore this email</p>';

$message.= '<p>Here is your password reset link:</br>';
$message.='<a href="' .$url . '">' . $url . '</a></p>';

$headers = "From:book_beauty <chriswanjau1509@gmail.com>\r\n";

$headers.="Reply-To:<chriswanjau1509@gmail.com>\r\n";
$headers.="Content-type:text/html\r\n";


mail($to, $subject, $message, $headers);

header("Location:/forgotpassword.php?reset=success");
}
else{
  
  echo"
  <script>
  window.location.href='stylistlogin.php';
  </script>";
 
}