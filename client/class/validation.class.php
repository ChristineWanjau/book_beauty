<?php
include_once 'class/client.class.php';

class validation extends client{
	
   public function signupValidation($email,$password,$confirm)
   {
	   $validclient= true;
	   if(client::getEmail($email)){
		   echo"<script>
		   alert('email already has an account');
		   window.location.href='register.html';
		   </script>";
		   $validclient = false;
	   }
	   elseif($password!==$confirm){
           echo"<script>
		   alert('password mismatch');
		   window.location.href='register.html';
		   </script>";
		   $validclient = false;
	   }
	   else{
		   
		   return $validclient;
	   }
	   
   }
   
   public function loginValidation($email,$password){
   	   $client = client::getEmail($email);
	   if(!$client){

	   	return false;
		   	// }
    //     elseif(password_verify($password,$client['password'])){ 
    //     return true;
	   }
	   else{
	       return true;
	   }
	
	    
   }

}

?>