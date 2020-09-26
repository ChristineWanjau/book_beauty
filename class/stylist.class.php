<?php
include_once 'dbh.class.php';
	
class stylist extends dbh{

	public function getEmailForValidation($stylistid){
		$sql ="SELECT * FROM stylistdetails WHERE stylistid = ?";
		$stmt =$this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		if(sizeof($results)>0){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function getEmail($stylistid){
		$sql ="SELECT * FROM stylistdetails WHERE stylistid = ?";
		$stmt =$this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;
	}
    public function setAbout($openingtime,$closingtime,$stylistid){
    	$sql = "INSERT INTO about(openingtime,closingtime,stylistid)VALUES(?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$openingtime,$closingtime,$stylistid]);
    }

    public function setDescription($stylistid,$description){
    	$sql = "INSERT INTO description(stylistid,description)VALUES(?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$stylistid,$description]);
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

	
	 public function getAbout($stylistid){
		$sql ="SELECT * FROM about WHERE stylistid = ?";
		$stmt =$this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;	
	}
	 public function getDescription($stylistid){
		$sql ="SELECT * FROM description WHERE stylistid = ?";
		$stmt =$this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;	
	}


	    public function getImageForStylist($stylistid){
		$sql = "SELECT name FROM img WHERE stylistid =  ? LIMIT 1";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;
		}

	
	public function getSalonistByLocation($location){
		$sql = "SELECT * FROM location WHERE street LIKE ? OR district LIKE ? OR city LIKE ? OR country LIKE ?";
		$params = array("%$location%" ,"%$location%","%$location%","%$location%");
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute($params);
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

	public function deleteImage($stylistid,$image){
		$sql = "DELETE FROM img WHERE stylistid = ? AND name = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$stylistid,$image]);

	}
	public function deleteDescription($stylistid,$description){
		$sql = "DELETE FROM description WHERE stylistid = ? AND description = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$stylistid,$description]);

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

	  public function updateOpeningTime($stylistid,$openingtime){
		$sql = "UPDATE about SET openingtime = ? WHERE stylistid = ?";
		$stmt = $this->connect()->prepare($sql);
		if($stmt->execute([$openingtime,$stylistid])){
			return true;
		}
		else{
			return false;
		}
	}
	 public function updateClosingTime($stylistid,$closingtime){
		$sql = "UPDATE about SET closingtime = ? WHERE stylistid = ?";
		$stmt = $this->connect()->prepare($sql);
		if($stmt->execute([$closingtime,$stylistid])){
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





	
	public function getLocations($lat1,$lat2,$lng1,$lng2){
		$sql ="SELECT * FROM location WHERE latitude BETWEEN ? AND ? AND longitude BETWEEN ? AND ?";
		$stmt =$this->connect()->prepare($sql);
		$stmt->execute([$lat1,$lat2,$lng1,$lng2]);
		$results = $stmt->fetchAll();
		return $results;
	}

}

?>