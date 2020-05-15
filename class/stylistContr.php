<?php

include_once 'stylist.class.php';

class stylistContr extends stylist{
	
	public function createStylist($businessname,$stylistname,$email,$password,$contact,$location){
		$this->setStylist($businessname,$stylistname,$email,$password,$contact,$location);
	}
	public function createAbout($description,$openingtime,$closingtime,$stylistid){
		$this->setAbout($description,$openingtime,$closingtime,$stylistid);
	}
	public function createImage($name,$image,$stylistid){
		$this->setImage($name,$image,$stylistid);
	}

	public function createService($services,$hours,$price,$stylistid){
	   $this->setService($services,$hours,$price,$stylistid);
	}
	public function getSession($email){
		$this->getEmail($email);
	}

	}



?>