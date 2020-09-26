<?php


include_once 'class/dbh.class.php';

class service  extends dbh{
   public function setService($services,$hours,$price,$filename,$target_file,$stylistid){
		$sql = "INSERT INTO services(services,hours,price,image,image_name,stylistid)VALUES(?,?,?,?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$services,$hours,$price,$filename,$target_file,$stylistid]);
	}

	public function getServiceByStylist($stylistid){
		$sql ="SELECT * FROM services WHERE stylistid = ?";
		$stmt =$this->connect()->prepare($sql);
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
	public function getSalonistByService($service){
		$sql = "SELECT * FROM services WHERE services = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$service]);
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

	public function getServicesOffered(){
		$sql = "SELECT * FROM serviceoffered";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchAll();
		return $results;

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

  

}
?>