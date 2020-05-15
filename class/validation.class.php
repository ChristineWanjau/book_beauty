<?php
include_once 'class/client.class.php';

class validation extends client{
	
   public function signupValidation($email,$password,$confirm)
   {
	   $validclient= true;
	   if(client::getEmail($email)){
		   echo"<script>
		   alert('email already has an account');
		   window.location.href='index.php';
		   </script>";
		   $validclient = false;
	   }
	   elseif($password!==$confirm){
           echo"<script>
		   alert('password mismatch');
		   window.location.href='stylistregister3.php';
		   </script>";
		   $validclient = false;
	   }
	   else{
		   
		   return $validclient;
	   }
	   
   }
   
   public function loginValidation($email,$password){
   	   $salon = new client();
   	   $style = $salon->getEmail($email);
       foreach($style as $item){
	   if(!$item){
	   	return false;
	   }
        elseif(password_verify($password,$item['password'])){ 
        return true;
	   }
	   else{
	       return false;
	   }
	}
	
	    
   }
}

?>