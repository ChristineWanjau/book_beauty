<?php

include_once 'class/stylist.class.php';
session_start();


if(isset($_POST['submit'])){
	$stylistid = 1;
    $description = $_POST['description'];
    $openingtime = $_POST['openingtime'];
    $closingtime = $_POST['closingtime'];
	$email = $_SESSION['stylistid'];
     

    $insert = new stylist();
	$countfiles = count($_FILES['files']['name']);
   

	for($i=0;$i<$countfiles;$i++){
		$filename = $_FILES['files']['name'][$i];
		$target_file = 'upload/'.$filename;
		$file_extension = pathinfo($target_file,PATHINFO_EXTENSION);
		$file_extension = strtolower($file_extension);
		$valid_extension = array("png","jpeg","jpg");

		if(in_array($file_extension, $valid_extension)){
             
			if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$target_file)){

               $insert->setImage($filename,$target_file,$email);
			}
			else{
			echo "nope";
		}
		}
		else{

			echo "no success";
		}
		
  }
	$insert->setAbout($openingtime,$closingtime,$email);
	$insert->setDescription($email,$description);
	echo "<script>
	window.location.href='stylisthome.php';
	</script>";


}

?>