<?php

include_once 'class/stylist.class.php';
$lat  = $_POST['lat'];
$lng  = $_POST['lng'];

$lat1 =$lat-10;
$lng1 = $lng-10;
$lat2 = $lat1+10;
$lng2 = $lng1+10;

echo $lat1;
echo $lng1;
echo $lat2;
echo $lng2;

$locate = new stylist();
$result = $locate->getLocations($lat1,$lat2,$lng1,$lng2);
echo $result[0];
foreach($result as $locate){
	echo $locate['district'];
}
?>