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

	public function getImageperstylist($stylistid){
		$sql = "SELECT * FROM img WHERE stylistid =  ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;
		}

	public function getServices($stylistid){
		$sql = "SELECT * FROM services WHERE stylistid = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;

	}

	public function setAppointment($apointmentname,$clientemail,$service,$date,$time,$appointmentstatus,$stylistid){
		$sql = "INSERT INTO appointment(appointmentname,clientemail,service,date,time,appointmentstatus,stylistid)VALUES(?,?,?,?,?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$apointmentname,$clientemail,$service,$date,$time,$appointmentstatus,$stylistid]);
		if($stmt){
			return true;
		}
		else{
			return false;
		}
	}

	public function getSalonistByService($service){
		$sql = "SELECT * FROM services WHERE services = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$service]);
		$results = $stmt->fetchAll();
		return $results;

	}
	public function getServicesOffered(){
		$sql = "SELECT * FROM serviceoffered";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchAll();
		return $results;

	}
     
     public function getAppointments($email){
		$sql = "SELECT * FROM appointment WHERE clientemail = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$email]);
		$results = $stmt->fetchAll();
		return $results;

	}

	 public function getNumberOfsms($email){
		$sql = "SELECT COUNT(notification) FROM client_notifications WHERE clientemail = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$email]);
		$results = $stmt->fetchAll();
		return $results;

	}

	public function getNotifications($email){
		$sql = "SELECT * FROM client_notifications WHERE clientemail = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$email]);
		$results = $stmt->fetchAll();
		return $results;

	}
	}
?>