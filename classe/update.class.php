<?php
	include_once 'conn.class.php';
 	class update{
 	 	private $conn;

	  	public function __construct(){
 	 		$db = new conn;
          	$connect = $db->connect();
          	$this->conn = $connect;
 	 	}
 	 	public function update(){
			$stmt = $dbh->prepare ("INSERT INTO isetbook (username,datenaissance,relation,scolarite) VALUES (:username,:datenaissance,:relation,:scolarite)");
			$stmt -> bindParam(':username',$username);
			$stmt -> bindParam(':datenaissance', $datenaissance);
			$stmt -> bindParam(':relation', $relation);
			$stmt -> bindParam(':scolarite', $scolarite);
			$stmt -> execute();
 	 	}

 	}
?>