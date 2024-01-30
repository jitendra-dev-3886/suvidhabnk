<?php

class Db {
    private $servername = "localhost";
	private $username = "paydeer_paydeer_db";
	private $password = "paydeer_paydeer_db1";
	private $db="paydeer_db";
	
	public function __construct(){
	    
	}
	public function db(){
	    $conn = new mysqli($this->$servername, $this->$username, $this->$password, $this->$db);
	    if($conn->connect_error){
	        die("Connection failed:".$conn->connect_error);
	    }
	    return $conn;
	}
	
}


?>