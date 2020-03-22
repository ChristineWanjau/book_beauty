<?php

include_once 'stylist.class.php';

class validation extends stylist{
	
   public function signupValidation($email,$password,$confirm)
   {
	   $validstylist= true;
	   if(stylist::getEmail($email)){
		   echo"<script>
		   alert('email already has an account');
		   window.location.href='stylistregister.php';
		   </script>";
		   $validstylist = false;
	   }
	   elseif($password!==$confirm){
           echo"<script>
		   alert('password mismatch');
		   window.location.href='stylistregister.php';
		   </script>";
		   $validstylist = false;
	   }
	   else{
		   
		   return $validstylist;
	   }
	   
   }
   
   public function loginValidation($email,$password){
   	   $stylist = stylist::getEmail($email);
	   if(!$stylist){
	   	
	   	return false;
		   	}
        elseif(password_verify($password,$stylist['password'])){ 
        return true;
	   }
	   else{
	       return true;
	   }
	
	    
   }

}

?>