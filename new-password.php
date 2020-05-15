<?php

if(isset($_POST['reset-password-submit']))
{
	$selector = $_POST['selector'];
	$validator = $_POST['validator'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['pwd-repeat'];

	if(empty($password)|| empty($passwordRepeat)){
		echo"<script>
	window.location.href='create-new-password.php';
	</script>";
	}
	elseif($password !=$passwordRepeat){
    echo"<script>
	window.location.href='create-new-password.php';
	</script>";
	}
	$currentDate = date("U");
    
    $style = new stylist();
    $results = $style->selectToken($selector,$currentDate);
    foreach($results as $row){
    	if($row<0){
    
    	echo "You need to resubmit your reset request";
    	exit();
    }
    else{

    	$tokenBin = hex2bin($validator);
    	$tokenCheck = password_verify($tokenBin,$row['pwdResetToken'] );
    	if($tokenCheck === false){
    		echo "You need to resubmit your reset request";
    	}
    	elseif($tokenCheck === true){

    		$tokenEmail = $row['pwdResetEmail'];
            if(!$style->getEmail($tokenEmail)){
            	echo "There was an error";
            }
            else{
            	$newpwdhash = password_hash($password, PASSWORD_DEFAULT);
            	$style->updatePassword($newpwdhash,$tokenEmail);

            	$style->deleteToken($tokenEmail);
            	header("Location:/stylistlogin.php?newpwd=passwordupdated");
            }



    	}
    }
}

}
else
{
	echo"<script>
	window.location.href='create-new-password.php';
	</script>";
}

?>