<?php

include_once 'class/service.class.php';

session_start();
if(isset($_SESSION['stylistid'])){

?>

<!DOCTYPE html>
<html>
<head>
	<title>home</title>
	<link rel="stylesheet"href="css/home.css">
   <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet"href="modal/css/modals.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="modal/js/modals.min.js" type="text/javascript"></script>
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
		 <li><a href="stylisthome.php"><i class="fas fa-qrcode"></i>My Profile</a><li>
      <li><a href="service.php"><i class="fas fa-link"></i>Services</a></li>
      <li><a href="calendar2.php"><i class="far fa-calendar"></i>Calendar</a></li>
      <li><a href="stylistappointments.php"><i class="fas fa-calendar"></i>Appointments</a></li>
        <li><a href="clientreviews.php"><i class="fas fa-calendar-week"></i>Reviews</a></li>
        <li><a href="logout.php"><i class="fas fa-arrow-left"></i>Log out</a></li>
		</ul>
	</div>
	<section>
		<div class="logo">
			<h1>Your services</h1>
		</div>
    <hr>
		<div class="yourservices">
		 <table id ="services">
         <th>Service </th>
         <th>Hours</th>
         <th>Price</th>
         <th>Action</th>
         <?php

         $stylist = new service();
         $service = $stylist->getServiceByStylist($_SESSION['stylistid']);
         if(sizeof($service)>0){
         foreach($service as $services){
         ?>
         <tr><td><?php echo $services['services']; ?></td>
         	 <td><?php echo $services['hours']; ?></td>
         	 <td><?php echo $services['price']; ?></td>
         	 <td><a href="<?php echo $services['services']?>" type="button" class="btn btn-success" data-toggle="modal" data-target="#updatemodal<?php echo $services['services'];?>">update</a>
          <a href="?deleteservice=<?php echo $services['services'];?>" type="button" onclick = "return confirm('Are yu sure you want to delete this service?')"class="btn btn-danger">delete</a></td>
         </tr>

            <div id="updatemodal<?php echo $services['services']?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
          
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                 
                  <h4 class="modal-title">Update</h4>
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
              <form action="service2.php" method="POST">
            <div class="form-group">
              <label>Service:</label>
              <input type="text" name="service" value="<?php echo $services['services'];?>" required="" class="form-control">
            </div>
            <div class="form-group">
              <label>Hours:</label>
              <input type="text" name="hours" value="<?php echo $services['hours'];?>" required="" class="form-control">
            </div>
              <div class="form-group">
              <label for="pwd">Price:</label>
              <input type="text"  name="price" value = "<?php echo $services['price'];?>" required="" class="form-control">
            </div>
		
			<button type="submit" name="updatebutton"class="btn btn-success">Update</button>

          </form>
                </div>
          
          
            </div>
          </div>
        </div>
         
          <?php
         }
        }else{

          echo "<tr><td>Enter your services</td></tr>";
        }
         ?>
          </table>
		</div>
		<button class="open-button" onclick="openForm()">Add Service</button>
			<div class="form-popup" id="myForm">
              <form action="service2.php" method="post" class="form-container" enctype="multipart/form-data">
                 <h1>Add Service</h1>
               	<label for="Service"><b>Service</b></label>
               		<input type="text" placeholder="Enter Service" name="service" required="">
                	<label for="Hours"><b>Hours</b></label>
                	<input type="text" placeholder="Enter Hours" name="hours" required=""><br>
                	<label for="Price"><b>Price</b></label>
                	<input type="text" placeholder="Enter Price" name="price" required="">
                  <label for = "serviceimage">Image for Service</label>
                  <input type="file" name="files[]" mutliple="multiple"/>
                	<input type="submit" name="submit" class="btn" value="Enter Service">
        
               </form>
			</div>
	</section>
</body>
</html>
<?php



if(isset($_GET['deleteservice'])){
    $stylistid = $_SESSION['stylistid'];
    $service = $_GET['deleteservice'];
    $stylist->deleteService($stylistid,$service);



}
}else{
	
	echo "<script>
	alert('login first');
	window.location.href='stylistlogin.php';
	</script>";
}

?>