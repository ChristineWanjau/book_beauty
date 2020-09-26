<?php

include_once 'class/dbh.class.php';
	
class client extends dbh{
	
	public function getEmail($email){
		$sql ="SELECT *FROM client WHERE clientemail= ? LIMIT 1";
		$stmt =$this->connect()->prepare($sql);
		$stmt->execute([$email]);
		$results = $stmt->fetchAll();
		return $results;
		
	}
	public function setClient($firstname,$lastname,$email,$phone,$password){
		$sql = "INSERT INTO client(first_name,last_name,clientemail,phone,password)VALUES(?,?,?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$firstname,$lastname,$email,$phone,$password]);
	}

	public function getImage(){
		$sql = "SELECT * FROM img";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchAll();
		return $results;
		}

	public function getImageperstylist($stylistid){
		$sql = "SELECT * FROM img WHERE stylistid =  ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;
		}


	

	  public function setEvent($title,$start,$end,$stylistid){
		$sql = "INSERT INTO events(title,start,end,stylistid)VALUES(?,?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$title,$start,$end,$stylistid]);
		if($stmt){
			return true;
		}
		else{
			return false;
		}

	}

		
		 public function getCoords($stylistid){
		$sql ="SELECT * FROM location WHERE stylistid = ?";
		$stmt =$this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;	
	

	}



	}
?>