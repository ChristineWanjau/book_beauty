<?php

session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Appoitnment</title>
	 <link rel="stylesheet"href="css/style3.css">
	 <link rel="stylesheet"href="css/home.css">
</head>
<body>
	 <div class="navbar">
            <div class="nav-logo">
			<p>Fill in this form to book your appointment</p>
			</div>
            <div class="nav-links">
			<ul>
				<li><a href="home.php">Back to homepage</a></li>
			</ul>
			
			</div>
           </div>
	<div class="container">
	<form action="appointment.php" method="post">
            <div class="textbox">
                <input type="text" placeholder="" required=""name="appointmentname">
                <label>Appointment Name</label>    
            </div>
                <div class="textbox">
                    <input type="text" placeholder=""  required="" name="email">
                    <label>Your Email</label>
                </div>
                <div class="textbox">
                    <input type="text"placeholder=""  value="<?php echo $_SESSION['service'];?>" required="" name="service">
                    <label>Service</label>
                </div>
                <div class="textbox">
                    <input type="text"placeholder=""  value="<?php echo $_SESSION['hours'];?>" required="" name="hours">
                    <label>Time Taken</label>
                </div>
                  <div class="textbox">
                    <input type="text"placeholder=""  value="<?php echo $_SESSION['price'];?>" required="" name="price">
                    <label>Price</label>
                </div>
                <div class="textbox">
                    <input type="date" placeholder="" required="" name="date">
                    <label>Preferred Date</label>
                </div>
                 <div class="textbox">
                    <input type="time" placeholder="" required="" name="time">
                    <label>Preferred Time</label>
                </div>
                <input class="btn" type="submit" name="booknow" value="Book Now"> 
            </form>
        </div>
</body>
</html>