<?php
	include_once 'conn.class.php';
 	class message{
 	 	private $conn;

	  	public function __construct(){
 	 		$db = new conn;
          	$connect = $db->connect();
          	$this->conn = $connect;
 	 	}
 	 	public function getMessages($uid,$uid2){
 	 		$check = $this->conn->prepare ("SELECT * FROM messages WHERE (uid=:uid AND uid2=:uid2) or (uid2=:uid AND uid=:uid2)");
			$check -> bindParam(':uid',$uid);
			$check -> bindParam(':uid2',$uid2);
			$check -> execute();
			return $check;
 	 	}
 	 	public function sendMessage($uid,$sendTo,$msg){
 	 		$check = $this->conn->prepare("INSERT INTO messages (uid,uid2,content,date) VALUES (:uid,:sendTo,:msg,'2012/12/12')");
			$check -> bindParam(':uid',$uid);
			$check -> bindParam(':sendTo',$sendTo);
			$check -> bindParam(':msg',$msg);
			$check -> execute();
 	 	}
 	 	public function vu(){
 	 		$check = $this->conn->query ("SELECT vu FROM message WHERE uid=':uid' AND sendTo =':sendTo' order by id desc ");
 	 	}

 	}
?>