<?php

include_once 'class/client.class.php';
include_once 'class/stylist.class.php';
include_once 'class/notifications.class.php';

session_start();
if(isset($_SESSION['clientemail'])){
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet"href="css/home.css">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
   	<input type="checkbox"id="check">
  <label for="check">
    <i class="fas fa-bars" id="btn"></i>
    <i class="fas fa-times" id="cancel"></i>
  </label>
  <div class="sidebar">
    <header>Stylist</header>
    <ul>
      <li><a href="clientappointments.php"><i class="fas fa-qrcode"></i>Your appointments</a><li>
      <li class="active"><a href="message.php"><i class="fas fa-link"></i>Your messages</a><li>
      <li><a href="stylistreview.php"><i class="far fa-calendar"></i>Your Reviews</a><li>
      <li><a href="index.php"><i class="fas fa-stream"></i>Back to homepage</a><li>

    </ul>
  </div>

</div>
<section>
  <div class="logo">
      <h1>Your Messages</h1>
    </div>
      <hr>
    <?php
    $message = new client();
    $noti = new notifications();
    $results = $noti->getNotifications($_SESSION['clientemail']);
    if(sizeof($results)>0){
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
   	<form action="send.php" method='post'>
    <input type="text" placeholder="Reply" name="reply">
    <input type="submit" value="Send">
    </form>
    </div>
    </div>
    <br>
    <?php
    }
  }else{
    ?>
    <div class="card">
   <div class="container">
     <p>You have no notifications today</p>
   </div>
   </div>
  <?php
  }
    
  
?>
</div>
</section>
	</body>
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