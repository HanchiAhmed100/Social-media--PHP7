<?php
	include_once 'conn.class.php';
 	class action{
 	 	private $conn;

	  	public function __construct(){
 	 		$db = new conn;
          	$connect = $db->connect();
          	$this->conn = $connect;
 	 	}
 	}
?>