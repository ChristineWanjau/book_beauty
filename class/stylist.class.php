<?php
include_once 'dbh.class.php';
	
class stylist extends dbh{
	
	public function getEmail($stylistid){
		$sql ="SELECT * FROM stylistdetails WHERE stylistid = ?";
		$stmt =$this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;
	}
    public function setAbout($description,$openingtime,$closingtime,$stylistid){
    	$sql = "INSERT INTO about(description,openingtime,closingtime,stylistid)VALUES(?,?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$description,$openingtime,$closingtime,$stylistid]);
    }

     public function setImage($filename,$target_file,$stylistid){
    	$sql = "INSERT INTO img(name,image,stylistid)VALUES(?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$result =$stmt->execute(array($filename,$target_file,$stylistid));
	}
	public function setStylist($businessname,$stylistname,$email,$password,$contact){
		$sql = "INSERT INTO stylistdetails(businessname,stylist_name,stylistid,password,contact)VALUES(?,?,?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		if($stmt->execute([$businessname,$stylistname,$email,$password,$contact])){

		return true;
		}
		else{
		return false;
		}

	}

	public function setLocation($stylistid,$street,$district,$city,$postalcode,$country,$latitude,$longitude){
		$sql = "INSERT INTO location(stylistid,street,district,city,postalcode,country,latitude,longitude)VALUES(?,?,?,?,?,?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		if($stmt->execute([$stylistid,$street,$district,$city,$postalcode,$country,$latitude,$longitude])){
			return true;
		}
		else{
			return false;
		}
	}

	public function setService($services,$hours,$price,$filename,$target_file,$stylistid){
		$sql = "INSERT INTO services(services,hours,price,image,image_name,stylistid)VALUES(?,?,?,?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$services,$hours,$price,$filename,$target_file,$stylistid]);
	}

	public function getService($stylistid){
		$sql ="SELECT * FROM services WHERE stylistid = ?";
		$stmt =$this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;	
	}

	 public function getAbout($stylistid){
		$sql ="SELECT * FROM about WHERE stylistid = ?";
		$stmt =$this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;	
	}

	public function getImage($stylistid){
		$sql = "SELECT * FROM img WHERE stylistid = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;

	}
	public function getLocation($stylistid){
		$sql ="SELECT * FROM location WHERE stylistid = ?";
		$stmt =$this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;
	}


	public function deleteToken($useremail){
		$sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
		$stmt = $this->connect()->prepare($sql);
		if($stmt->execute([$useremail])){
			return true;
		}
		else{
			return false;
		}
	}

	public function setToken($pwdResetEmail,$pwdResetSelector,$pwdResetToken,$pwdResetExpires){
		$sql = "INSERT INTO pwdReset(pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires)VALUES(?,?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$pwdResetEmail,$pwdResetSelector,$pwdResetToken,$pwdResetExpires]);
	}

	public function selectToken($selector,$expires){
		$sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$useremail]);
		$results = $stmt->fetchAll();
		return $results;
	}

     public function updateEmail($password,$email){
		$sql = "UPDATE stylistdetails SET password = ? WHERE stylistid=?";
		$stmt = $this->connect()->prepare($sql);
		if($stmt->execute([$password,$email])){
			return true;
		}
		else{
			return false;
		}
	}

	public function getEvent($stylistid){
		$sql = "SELECT * FROM events WHERE stylistid = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;

	}

	public function getAppointment($stylistid){
		$sql = "SELECT * FROM appointment WHERE stylistid = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;

	}

	public function deleteService($stylistid,$service){
		$sql = "DELETE FROM services WHERE stylistid = ? AND services =?";
		$stmt = $this->connect()->prepare($sql);
		if($stmt->execute([$stylistid,$service])){
			return true;
		}
		else{
			return false;
		}
	}

	public function serviceExists($service){
		$sql = "SELECT * FROM serviceoffered WHERE service = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$service]);
		if($stmt->fetchAll()){
			return true;
		}
		else 
		{
			return false;
		}
		

	}
	public function newService($service){
		$sql = "INSERT INTO serviceoffered(service)VALUES(?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$service]);
	}

	public function updateService($price,$hours,$service,$stylistid){
		$sql ="UPDATE services SET price = ? , hours = ? WHERE services = ? AND stylistid = ?";
		$stmt = $this->connect()->prepare($sql);
		if($stmt->execute([$price,$hours,$service,$stylistid])){
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getLocations($lat,$lat1,$lng,$lng1){
		$sql ="SELECT * FROM location WHERE latitude = BETWEEN ? AND ? AND longitude = BETWEEN ? AND ?";
		$stmt =$this->connect()->prepare($sql);
		$stmt->execute([$lat,$lat1,$lng,$lng1]);
		$results = $stmt->fetchAll();
		return $results;
	}

}

?>