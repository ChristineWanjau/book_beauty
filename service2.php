<?php

session_start();
if(isset($_SESSION['stylistid'])){

  if(isset($_POST['submit'])){

include_once 'class/service.class.php';

$service = $_POST['service'];
$hours = $_POST['hours'];
$price = $_POST['price'];

$insert = new service();
$countfiles = count($_FILES['files']['name']);
   
   
	for($i=0;$i<$countfiles;$i++){
		$filename = $_FILES['files']['name'][$i];
		$target_file = 'upload/'.$filename;
		$file_extension = pathinfo($target_file,PATHINFO_EXTENSION);
		$file_extension = strtolower($file_extension);
		$valid_extension = array("png","jpeg","jpg");

		if(in_array($file_extension,$valid_extension)){
			if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$target_file)){
              
             if($insert->serviceExists($service)){
               if(!$insert->setService($service,$hours,$price,$filename,$target_file,$_SESSION['stylistid'])){
                 echo"<script>
	             window.location.href='service.php';
	             </script>";
	            }
	         else{
	
            echo "<script>
	        alert('unable');
	        window.location.href='service.php';
	        </script>";
	}
}else{
    
  $insert->newService($service);
  $insert->setService($service,$hours,$price,$filename,$target_file,$_SESSION['stylistid']);
   echo"<script>
	window.location.href='service.php';
	</script>";
}

}
}
}
}

if(isset($_POST['updatebutton'])){
	include_once 'class/service.class.php';
	$insert = new service();
	$service = $_POST['service'];
	$hours = $_POST['hours'];
	$price = $_POST['price'];
	$stylistid = $_SESSION['stylistid'];
	if($insert->updateService($service,$hours,$price,$stylistid)){
		echo "<script>
    window.location.href='service.php';
    </script>";

	}else{
		echo "<script>
    window.location.href='service.php';
    </script>";
	}
}
}
else
{
	echo "<script>
	alert('login first');
	window.location.href='stylistlogin.php';
	</script>";
}


?>