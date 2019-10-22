<?php

class DBConnection
{
	public $connection;

	public function __construct() {
       try {
   			$this->connection = new PDO("mysql:host=localhost;dbname=taskmaster", "root", "");
   			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   			return $this->connection;
   		} catch(PDOException $e) {
		   	echo "Connection failed: " . $e->getMessage();
		   }
		}

}

?>
