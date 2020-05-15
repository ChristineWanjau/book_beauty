<?php

include_once 'class/stylist.class.php';
$lat  = $_POST['lat'];
$lng  = $_POST['lng'];

$lat1 = $lat+10;
$lng1 = $lng-10;

$locate = new stylist();
$result = $locate->getLocations($lat,$lat1,$lng,$lng1);
echo $result;
?>