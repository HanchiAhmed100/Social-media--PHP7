<?php
	include_once 'conn.class.php';
 	class notification{
 	 	private $conn;

	  	public function __construct(){
 	 		$db = new conn;
          	$connect = $db->connect();
          	$this->conn = $connect;
 	 	}

 	 	public function getUnseenNotifications($uid){
 	 		$check = $this->conn->prepare ("SELECT * FROM notifications WHERE uid2=:uid AND seen='0' ");
			$check -> bindParam(':uid',$uid);
			$check -> execute();
			return $check;
 	 	}

 	 	public function setNotificationsSeen($uid){
 	 		$check = $this->conn->prepare ("UPDATE notifications set seen='1' WHERE uid2=:uid");
			$check -> bindParam(':uid',$uid);
			$check -> execute();
			return $check;
 	 	}

 	 	public function setNotificationsOpened($uid){
 	 		$check = $this->conn->prepare ("UPDATE notifications set opened='1' WHERE uid2=:uid");
			$check -> bindParam(':uid',$uid);
			$check -> execute();
			return $check;
 	 	}

 	 	public function getUnopenedNotifications($uid){
 	 		$check = $this->conn->prepare ("SELECT * FROM notifications WHERE uid2=:uid AND opened='0' ");
			$check -> bindParam(':uid',$uid);
			$check -> execute();
			return $check;
 	 	}

 	 	public function setNotification($uid,$uid2,$pid){
 	 		$check = $this->conn->prepare ("INSERT INTO notifications (uid, uid2, pid) VALUES (:uid,:uid2,:pid)");
 	 		$check -> bindParam(':uid',$uid);
 	 		$check -> bindParam(':uid2',$uid2);
 	 		$check -> bindParam(':pid',$pid);
			$check -> execute();
 	 	}
 	}
?>