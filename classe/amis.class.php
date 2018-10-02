<?php
	include_once 'conn.class.php';
 	class amis{
 	 	private $conn;

	  	public function __construct(){
 	 		$db = new conn;
          	$connect = $db->connect();
          	$this->conn = $connect;
 	 	}
	public function getField($column, $condition){
		$check = $this->conn->prepare("SELECT * FROM ".$column.$condition);
		$check -> execute();
		return $check;
	} 

 	 	public function getfreind($uid){
 	 		$check = $this->conn->prepare("SELECT * FROM friends WHERE uid=:uid ");
			$check -> bindParam(':uid',$uid);
			$check -> execute();
			return $check;
 	 	}
 	 	public function addamis($uid,$uid2){
 	 		$check = $this->conn->prepare("INSERT INTO friends (uid,uid2) VALUES (:uid,:uid2) ");
			$check -> bindParam(':uid',$uid);
			$check -> bindParam(':uid2',$uid2);
			$check -> execute();
		}

		public function addFriendRequest($uid,$uid2){
			if($this -> checkFriendRequest($uid,$uid2) > 0){
				return 0;
			}
 	 		$check = $this->conn->prepare("INSERT INTO friendrequests (uid,uid2) VALUES (:uid,:uid2)");
			$check -> bindParam(':uid',$uid);
			$check -> bindParam(':uid2',$uid2);
			$check -> execute();
		}

		public function removeFriendRequest($uid,$uid2){
 	 		$check = $this->conn->prepare("DELETE FROM friendrequests WHERE uid=:uid AND uid2=:uid2 OR uid=:uid2 AND uid2=:uid");
			$check -> bindParam(':uid',$uid);
			$check -> bindParam(':uid2',$uid2);
			$check -> execute();
		}

		public function removeFriend($uid,$uid2){
 	 		$check = $this->conn->prepare("DELETE FROM friends WHERE uid=:uid AND uid2=:uid2 OR uid=:uid2 AND uid2=:uid");
			$check -> bindParam(':uid',$uid);
			$check -> bindParam(':uid2',$uid2);
			$check -> execute();
		}

		public function acceptFriendRequest($uid,$uid2){
 	 		$check = $this->conn->prepare("INSERT INTO friends (uid,uid2) VALUES (:uid,:uid2)");
			$check -> bindParam(':uid',$uid);
			$check -> bindParam(':uid2',$uid2);
			$check -> execute();

			$this -> removeFriendRequest($uid,$uid2);
		}

 	 	public function checkFriendRequest($uid,$uid2){
 	 		$check = $this->conn->prepare("SELECT * FROM friendrequests WHERE (uid=:uid AND uid2=:uid2) OR (uid=:uid2 AND uid2=:uid)");
			$check -> bindParam(':uid',$uid);
			$check -> bindParam(':uid2',$uid2);
			$check -> execute();
			return $check -> rowCount();
 	 	}

 	 	public function getFriendRequests($uid){
 	 		$check = $this->conn->prepare("SELECT * FROM friendrequests WHERE uid2=:uid");
			$check -> bindParam(':uid',$uid);
			$check -> execute();
			return $check;
 	 	}

 	 	public function getFriends($uid){
 	 		$check = $this->conn->prepare("SELECT * FROM friends WHERE uid=:uid or uid2=:uid");
			$check -> bindParam(':uid',$uid);
			$check -> execute();
			return $check;
 	 	}

 	 	public function checkFriend($uid,$uid2){
 	 		$check = $this->conn->prepare("SELECT * FROM friends WHERE (uid=:uid AND uid2=:uid2) OR (uid=:uid2 AND uid2=:uid)");
			$check -> bindParam(':uid',$uid);
			$check -> bindParam(':uid2',$uid2);
			$check -> execute();
			return $check -> rowCount();
 	 	}

 	 	public function getFriendRequest($uid,$uid2){
 	 		$check = $this->conn->prepare("SELECT * FROM friendrequests WHERE uid=:uid AND uid2=:uid2");
			$check -> bindParam(':uid',$uid);
			$check -> bindParam(':uid2',$uid2);
			$check -> execute();
			return $check -> rowCount();
 	 	}

 	 	public function getFriendRequest2($uid,$uid2){
 	 		$check = $this->conn->prepare("SELECT * FROM friendrequests WHERE uid2=:uid AND uid=:uid2");
			$check -> bindParam(':uid',$uid);
			$check -> bindParam(':uid2',$uid2);
			$check -> execute();
			return $check -> rowCount();
 	 	}


 	 	public function getUser($id){
 	 		$check = $this->conn->prepare("SELECT * FROM users where id=:id");
 	 		$check -> bindParam(':id',$id);
 	 		$check -> execute();
 	 		$n = $check -> fetch();
 	 		return $n['nom'].' '.$n['prenom'];
 	 	}
 	}
?>