<!DOCTYPE html>
<html>
    <head>
        <title>Reset Your password</title>
        <link rel="stylesheet" href="css/style3.css">
    </head>
    <body>
    <div class="logo">
    <p>Reset Your Password</p>
    </div>
        <div class="container">
          <?php
          	$selector = $_GET['selector'];
          	$validator = $_GET['validator'];
        	
        	if(empty($selector) || empty($validator)){

        		echo "Could not validate your request";
        	}else{
        		if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !==false){
        			?>

        			<form action="new-password.php" method="POST">
        				<input type="hidden" name="selector" value="<?php echo $selector ?>">

        				<input type="hidden" name="selector" value="<?php echo $validator ?>">

        				<input type="password" name="pwd" placeholder="Enter a new password">

        			    <input type="password" name="pwd-repeat" placeholder="Confirm new password">

        			    <button type="submit" name="reset-password-submit">Reset Password</button>

        			</form>

        			<?php
        		}
        	}

          ?>
        </div>
    </body>
</html>

