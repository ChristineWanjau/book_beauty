<?php

include_once 'class/review.class.php';
$stylistid = $_POST['email'];
$review = $_POST['review'];
$clientemail = $_POST['clientemail'];
$date = date('d-m-y h:i:s');

$client = new review();

if($client->insertReview($review,$clientemail,$date,$stylistid)){
	echo "<script>
	window.location.href='stylistreview.php';
	</script>";
}
else{
	echo "
	alert('no success');
	";
}

?>