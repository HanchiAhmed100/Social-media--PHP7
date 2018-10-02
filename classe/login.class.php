<?php
	include_once 'conn.class.php';
 	class login{
 	 	private $conn;

	  	public function __construct(){
 	 		$db = new conn;
          	$connect = $db->connect();
          	$this->conn = $connect;
 	 	}

 	 	public function register($nom,$prenom,$mail,$motdepasse){
			$stmt = $this->conn->prepare ("INSERT INTO users (nom, prenom, mail , motdepasse) VALUES (:nom,:prenom,:mail,:motdepasse)");
			$stmt -> bindParam(':nom',$nom);
			$stmt -> bindParam(':prenom', $prenom);
			$stmt -> bindParam(':mail', $mail);
			$stmt -> bindParam(':motdepasse', $motdepasse);
			$stmt -> execute();
 	 	}
 	 	public function passwordhash($motdepasse){
 	 		$motdepasse = md5($motdepasse);
 	 		return $motdepasse;
 	 	}
 	 	public function check($mail){
 	 		$check = $this->conn->query("SELECT mail FROM users WHERE mail ='$mail' ");
 	 		if($check->rowCount() > 1){
 	 				echo "<script>alert(\"Registeration Failed! Adress exist deja \")</script>";
			}else{
				echo "<script>alert(\"Succesfully Registered!\")</script>";
			}
 	 	}
 	 	public function select($mail,$motdepasse){
 	 		$check = $this->conn->prepare("SELECT * FROM users WHERE mail =:mail AND motdepasse = :motdepasse");
 	 		$check -> bindParam(':mail',$mail);
 	 		$check -> bindParam(':motdepasse',$motdepasse);
 	 		$check -> execute();
 	 		if($check -> rowCount() === 1){
      			while($response = $check->fetch()){
	      			session_start();
					$_SESSION['id'] = $response['id'];
				    $_SESSION['nom'] = $response['nom'];
				    $_SESSION['prenom'] = $response['prenom'];
				    $_SESSION['pPic'] = $response['picture'] == '' ? "images/im2.png" : $response['picture'];
				    header('location:acceuil.php');
				}
 			}else{
				echo "<script>alert(\"mot de passe ou login incorrecte !\")</script>";
			}
 	 	return $check;
 	 	}

 	 	public function getUsers(){
 	 		$check = $this->conn->prepare("SELECT * FROM users");
 	 		$check -> execute();
 	 		return $check;
 	 	}

 	 	public function getUser($id){
 	 		$check = $this->conn->prepare("SELECT * FROM users where id=:id");
 	 		$check -> bindParam(':id',$id);
 	 		$check -> execute();
 	 		return $check;
 	 	}

 	 	public function getFriends($id){
 	 		$check = $this->conn->prepare("SELECT * FROM friends where uid=:id or uid2=:id");
 	 		$check -> bindParam(':id',$id);
 	 		$check -> execute();
 	 		return $check;
 	 	}

 	 	public function getUsername($id){
 	 		$check = $this->conn->prepare("SELECT * FROM users where id=:id");
 	 		$check -> bindParam(':id',$id);
 	 		$check -> execute();
 	 		$n = $check -> fetch();
 	 		return $n['nom'].' '.$n['prenom'];
 	 	}

 	 	public function getFriendRequests($id){
 	 		$check = $this->conn->prepare("SELECT * FROM friendrequests where uid2=:id");
 	 		$check -> bindParam(':id',$id);
 	 		$check -> execute();
 	 		return $check -> rowCount() ;
 	 	}

 	 	public function setProfilePicture($uid,$pic){
 	 		$check = $this->conn->prepare("UPDATE users SET picture=:pic WHERE id =:uid");
 	 		$check -> bindParam(":uid",$uid);
 	 		$check -> bindParam(":pic",$pic);
 	 		$check -> execute();
 	 	}

 	 	public function setProfileCover($uid,$pic){
 	 		$check = $this->conn->prepare("UPDATE users SET cover=:pic WHERE id =:uid");
 	 		$check -> bindParam(":uid",$uid);
 	 		$check -> bindParam(":pic",$pic);
 	 		$check -> execute();
 	 	}


 	}
?>