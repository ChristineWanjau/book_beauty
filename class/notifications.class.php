<?php

include_once 'stylist.class.php';

class notifications extends dbh{

   public function getNumberOfsms($email){
		$sql = "SELECT COUNT(notification) FROM client_notifications WHERE clientemail = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$email]);
		$results = $stmt->fetchColumn();
		return $results;

	}

	public function getNotifications($email){
		$sql = "SELECT * FROM client_notifications WHERE clientemail = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$email]);
		$results = $stmt->fetchAll();
		return $results;

	}
	  public function sendStylistNotification($clientemail,$notification,$stylistid){
		$sql = "INSERT INTO client_notifications(clientemail,notification,stylistid)VALUES(?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$clientemail,$notification,$stylistid]);
		if($stmt){
			return true;
		}
		else{
			return false;
		}

	}
	   
	    public function sendNotification($clientemail,$notification,$stylistid,$appointmentid){
		$sql = "INSERT INTO stylist_notifications(clientemail,notification,stylistid,appointmentid)VALUES(?,?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$clientemail,$notification,$stylistid,$appointmentid]);
		if($stmt){
			return true;
		}
		else{
			return false;
		}

	}

}

?>