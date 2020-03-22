<?php

include_once 'class/dbh.class.php';
	
class client extends dbh{
	
	public function getEmail($email){
		$sql ="SELECT *FROM client WHERE email= ? LIMIT 1";
		$stmt =$this->connect()->prepare($sql);
		$stmt->execute([$email]);
		$results = $stmt->fetchAll();
		return $results;
		
	}
	protected function setClient($firstname,$lastname,$email,$phone,$password){
		$sql = "INSERT INTO client(first_name,last_name,email,phone,password)VALUES(?,?,?,?,?)";
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
	}
?>