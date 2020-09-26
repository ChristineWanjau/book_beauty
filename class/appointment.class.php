<?php

include_once 'class/dbh.class.php';

class appointment extends dbh{

		public function getAppointmentByStylist($stylistid){
		$sql = "SELECT * FROM appointment WHERE stylistid = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;

	  }
	 public function getAppointmentsByClient($email){
		$sql = "SELECT * FROM appointment WHERE clientemail = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$email]);
		$results = $stmt->fetchAll();
		return $results;

	}

	 public function stylistEditAppointment($date,$time,$id){
		$sql = "UPDATE appointment SET date= ?, time= ? WHERE appointmentid = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$date,$time,$id]);
		if($stmt){
			return true;
		}
		else{
			return false;
		}

	}

	 public function editAppointment($id,$appointmentname,$service,$date,$time){
		$sql = "UPDATE appointment SET appointmentname = ?, service = ?, date =?,time=? WHERE appointmentid = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$appointmentname,$service,$date,$time,$id]);
		if($stmt){
			return true;
		}
		else{
			return false;
		}

	}
     
    public function deleteAppointment($id){
		$sql = "DELETE FROM appointment WHERE appointmentid = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id]);
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




}

?>