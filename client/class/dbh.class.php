<?php


class dbh{
	
	private $host ="localhost";
	private $user ="root";
	private $pwd ="";
	private $dbname="book_beauty";
 

	protected function connect(){
		$dsn = 'mysql:host=' .$this->host.';dbname='.$this->dbname;
		$pdo = new PDO($dsn,$this->user, $this->pwd);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		return $pdo;

}


}


?>