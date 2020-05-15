<?php

include_once 'class/client.class.php';
include_once 'class/stylist.class.php';

session_start();
if(isset($_SESSION['clientemail'])){
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet"href="css/sms.css">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
   	<div id="main">
      <div class="topnav" id="myTopnav">
              <div class="nav-logo">
                <p>Book Beauty</p>
              </div>
</div>
<hr>
   <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
     <div class="user">
   <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <i class="fas fa-user-circle"></i>
    <p><?php echo $_SESSION['clientemail'];?></p>
    </div>
    <a href="clientappointments.php"><i class="fas fa-link"></i>Appointments</a>
    <a href="message.php"><i class="far fa-calendar"></i>Messages</a>
    <a href="review.php"><i class="fas fa-calendar-week"></i>Your Reviews</a>
    <a href="home.php"><i class="fas fa-arrow-left"></i>Back to home page</a>
</div>

<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
    <?php
    $message = new client();
    $results = $message->getNotifications($_SESSION['clientemail']);
    foreach ($results as $sms) {
    	?>
   <div class="card">
   <div class="container">
   	<?php 
   	$salon = new stylist();
   	$res = $salon->getEmail($sms['stylistid']);
   	foreach ($res as $row) {
   		?>
   		<p><b>Stylist Name:</b><p>
   		<?php
   		echo $row['businessname'];
   		?>
   		<p><b>Message:</b></p>
   		<?php
   	}
   	echo $sms['notification'];
   	?>
   	<form action="" method='post'>
    <input type="text" placeholder="Reply">
    <input type="submit" value="Send">
    </form>
    </div>
    </div>
    <br>
    <?php
    }
    ?>  

</div>
	</body>

		<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
</html>
<?php
}
else{

	echo"
	<script>
	alert('login first')
	window.location.href='clientlogin.php'
	</script>";
	
}
?>