<?php
include_once 'class/stylist.class.php';
if(isset($_SESSION['stylistid'])){
     $data = array();
	 $event = new stylist();
	 $results = $event->getEvent($_SESSION['stylistid']);
     $data = $results;

}
else{

	echo "no success";
}