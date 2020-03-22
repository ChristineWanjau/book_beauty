<?php

include 'config.php';

$first_name = $_POST['firstname'];
$last_name =$_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];


$check = "SELECT * FROM client WHERE email = $email";
$checkemail = mysqli_query($connection,$check);
if(mysqli_num_rows($checkemail)>0){

	 echo
        "
        <script>
        alert('email already has an account');
        window.location.href='register.php';
        </script>
        ";
}
elseif($password!=$confirm){

	 echo
        "
        <script>
        alert('password mismatch');
        window.location.href='register.php';
        </script>
        ";
}
else{

	$hashedpassword= password_hash($confirm, PASSWORD_BYCRYPT);

	$insert = "INSERT INTO client (firstname,lastname,email,phone,password)VALUES('$first_name','$last_name','$email','$phone','hashedpassword')";
	$insert_query = mysqli_query($connection,$insert);
	if($insert_query){

       echo "
		<script>
		window.location.href="login.php";
		</script>";
	}

}

?>