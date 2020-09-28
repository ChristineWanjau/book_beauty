<?php

class dbh{
	
	private $host ="us-cdbr-east-02.cleardb.com";
	private $user ="b88a372c6c809a";
	private $pwd ="b0beb5d3";
	private $dbname="heroku_321bbbaa2f484f8";
 

	protected function connect(){
		$dsn = 'mysql:host=' .$this->host.';dbname='.$this->dbname;
		$pdo = new PDO($dsn,$this->user, $this->pwd);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		return $pdo;

}


}


?>