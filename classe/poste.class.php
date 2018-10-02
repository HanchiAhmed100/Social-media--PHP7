<?php
	include_once 'conn.class.php';
 	class poste{
 	 	private $conn;

	  	public function __construct(){
 	 		$db = new conn;
          	$connect = $db->connect();
          	$this->conn = $connect;
 	 	}
 	 	public function sendpost($uid,$content){
 	 		$datestatus = date("Y-m-d H:i:s");
 	 		$stmt = $this->conn->prepare ("INSERT INTO status (uid,content,datestatus) VALUES (:uid,:content,:datestatus)");
			$stmt -> bindParam(':uid',$uid);
			$stmt -> bindParam(':content',$content);
			$stmt -> bindParam(':datestatus',$datestatus);
			$stmt -> execute();
 	 	}
 	 	public function getpost($uid){
 	 		$check = $this->conn->prepare ("SELECT * FROM status WHERE uid=:uid order by id desc");
			$check -> bindParam(':uid',$uid);
			$check -> execute();
			return $check;
 	 	}
 	 	 public function getonepost($id){
 	 		$check = $this->conn->prepare ("SELECT * FROM status WHERE id=:id");
			$check -> bindParam(':id',$id);
			$check -> execute();
			return $check;
 	 	}

 	 	public function getUserPosts($id){
 	 		$check = $this->conn->prepare ("SELECT * FROM status WHERE uid=:id");
			$check -> bindParam(':id',$id);
			$check -> execute();
			return $check;
 	 	}
 	 	public function supprimer($id){
 	 		$supp = $this->conn->prepare("DELETE FROM status WHERE id=:id ");
			$supp -> bindParam(':id',$id);
			$supp -> execute();
 	 	}
  	 	public function modifier($id,$content,$datestatus){

 	 		$modifs = $this->conn->prepare("UPDATE status SET content=:content,datestatus=:datestatus WHERE id =:id");
 	 		$modifs -> bindParam(':id',$id);
 	 		$modifs -> bindParam(':content',$content);
 	 	 	$modifs -> bindParam(':datestatus',$datestatus);
 	 		$modifs -> execute();
 	 	}

 	 	public function likePost($uid,$pid){
 	 		$stmt = $this->conn->prepare ("INSERT INTO likes (uid,pid) VALUES (:uid,:pid)");
			$stmt -> bindParam(':uid',$uid);
			$stmt -> bindParam(':pid',$pid);
			$stmt -> execute();
 	 	}

 	 	public function unlikePost($uid,$pid){
 	 		$stmt = $this->conn->prepare ("DELETE FROM likes where uid=:uid and pid=:pid");
			$stmt -> bindParam(':uid',$uid);
			$stmt -> bindParam(':pid',$pid);
			$stmt -> execute();
 	 	}

 	 	public function getLikes($pid){
 	 		$check = $this->conn->prepare ("SELECT * FROM likes WHERE pid=:pid");
			$check -> bindParam(':pid',$pid);
			$check -> execute();
			return $check -> rowCount();
 	 	}

 	 	public function getComments($pid){
 	 		$check = $this->conn->prepare ("SELECT * FROM comments WHERE pid=:pid");
			$check -> bindParam(':pid',$pid);
			$check -> execute();
			return $check;
 	 	}

 	 	public function addComment($pid,$uid,$content){
 	 		$check = $this->conn->prepare ("INSERT INTO comments(pid,uid,content) VALUES (:pid,:uid,:content)");
			$check -> bindParam(':pid',$pid);
			$check -> bindParam(':uid',$uid);
			$check -> bindParam(':content',$content);
			$check -> execute();
 	 	}

 	 	public function getPicture($id){
 	 		$check = $this->conn->prepare("SELECT * FROM status where id=:id");
 	 		$check -> bindParam(':id',$id);
 	 		$check -> execute();
 	 		$n = $check -> fetch();
 	 		return $n['picture'];
 	 	}

 	 	public function getUserLikes($pid,$uid){
 	 		$check = $this->conn->prepare ("SELECT * FROM likes WHERE pid=:pid and uid=:uid");
			$check -> bindParam(':pid',$pid);
			$check -> bindParam(':uid',$uid);
			$check -> execute();
			return $check -> rowCount();
 	 	}

 	 	public function getUsername($id){
 	 		$check = $this->conn->prepare("SELECT * FROM users where id=:id");
 	 		$check -> bindParam(':id',$id);
 	 		$check -> execute();
 	 		$n = $check -> fetch();
 	 		return $n['nom'].' '.$n['prenom'];
 	 	}

 	 	public function getUserPicture($id){
 	 		$check = $this->conn->prepare("SELECT * FROM users where id=:id");
 	 		$check -> bindParam(':id',$id);
 	 		$check -> execute();
 	 		$n = $check -> fetch();
 	 		return $n['picture'];
 	 	}

 	 	public function getUserCover($id){
 	 		$check = $this->conn->prepare("SELECT * FROM users where id=:id");
 	 		$check -> bindParam(':id',$id);
 	 		$check -> execute();
 	 		$n = $check -> fetch();
 	 		return $n['cover'];
 	 	}

 	 	public function getUser($id){
 	 		$check = $this->conn->prepare("SELECT * FROM users where id=:id");
 	 		$check -> bindParam(':id',$id);
 	 		$check -> execute();
 	 		$n = $check -> fetch();
 	 		return $n;
 	 	}

 	 	public function alluser($id){
 	 		$check = $this->conn->prepare("SELECT * FROM users WHERE id!=:id");
 	 		$check -> bindParam(':id',$id);
 	 		$check -> execute();
 	 		return $check;
 	 	}

 	}
?>