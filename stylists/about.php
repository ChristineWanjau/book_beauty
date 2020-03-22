<?php

include_once 'class/stylistContr.php';
session_start();


if(isset($_POST['submit'])){
	$stylistid = 1;
    $description = $_POST['description'];
    $openingtime = $_POST['openingtime'];
    $closingtime = $_POST['closingtime'];
	$filename = $_FILES['img']['name'];
	$tmpname = $_FILES['img']['tmp_name'];
	$filetype =$_FILES['img']['type'];
	$email = $_SESSION['email'];
   
    $insert = new stylistContr();

	for($i=0;$i<=count($tmpname)-1;$i++){
		$name = addslashes($filename[$i]);
		$tmp = addslashes(file_get_contents($tmpname[$i]));
	$insert->createImage($name,$tmp,$email);
  }
	$insert->createAbout($description,$openingtime,$closingtime,$email);


}

?>