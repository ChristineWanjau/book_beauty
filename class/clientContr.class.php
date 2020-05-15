<?php

include_once 'class/client.class.php';

class clientContr extends client{
	
	public function createClient($firstname,$lastname,$email,$phone,$password){
		
		$this->setClient($firstname,$lastname,$email,$phone,$password);

	}
}
?>