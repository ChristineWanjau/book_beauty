<?php

include_once 'class/dbh.class.php';

class review extends dbh{
    
    public function insertReview($message,$clientemail,$datetime,$stylistid){
		$sql = "INSERT INTO reviews(review,datetime,clientemail,stylistid)VALUES(?,?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$message,$datetime,$clientemail,$stylistid]);
		if($stmt){
			return true;
		}
		else{
			return false;
		}
        }


        public function getReviewsByStylist($stylistid){
		$sql ="SELECT * FROM reviews WHERE stylistid = ?";
		$stmt =$this->connect()->prepare($sql);
		$stmt->execute([$stylistid]);
		$results = $stmt->fetchAll();
		return $results;	
	}

	 public function getAllReviews(){
		$sql ="SELECT * FROM reviews";
		$stmt =$this->connect()->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchAll();
		return $results;	
	}



}

?>