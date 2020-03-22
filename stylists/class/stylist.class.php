<?php
include_once 'dbh.class.php';
	
class stylist extends dbh{
	
	public function getEmail($email){
		$sql ="SELECT * FROM stylistdetails WHERE email= ?";
		$stmt =$this->connect()->prepare($sql);
		$stmt->execute([$email]);
		$results = $stmt->fetchAll();
		return $results;
	}
    protected function setAbout($description,$openingtime,$closingtime,$stylistid){
    	$sql = "INSERT INTO about(description,openingtime,closingtime,stylistid)VALUES(?,?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$description,$openingtime,$closingtime,$stylistid]);
    }

     protected function setImage($name,$image,$stylistid){
    	$sql = "INSERT INTO img(name,image,stylistid)VALUES(?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$result =$stmt->execute([$name,$image,$stylistid]);
	}
	protected function setStylist($businessname,$stylistname,$email,$password,$contact,$location){
		$sql = "INSERT INTO stylistdetails(businessname,stylist_name,email,password,contact,location)VALUES(?,?,?,?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$businessname,$stylistname,$email,$password,$contact,$location]);
	}

	protected function setService($services,$hours,$price,$stylistid){
		$sql = "INSERT INTO services(services,hours,price,stylistid)VALUES(?,?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$services,$hours,$price,$stylistid]);
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
		foreach($results as $row){
			echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"width="250px" height="250px">';
		}

	}


}

?>