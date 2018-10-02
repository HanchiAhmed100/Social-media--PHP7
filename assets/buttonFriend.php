<?php
	include_once '../classe/amis.class.php';
	session_start();
	$uid = $_SESSION['id'];
	$uid2 = $_POST['id2'];
	$modifier = new amis();
	$html = '<input class="btn btn-danger" type="submit" name="add" value="Ajouter" onclick="addFriendRequest('.$uid2.');" >';
	if($modifier -> getFriendRequest($uid,$uid2) > 0){
		$html = '<input class="btn btn-danger" type="submit" name="add" value="Retirer l\'invitation" onclick="removeFriendRequest('.$uid2.');" >';
	}

	if($modifier -> getFriendRequest2($uid,$uid2) > 0){
		$html = '<input class="btn btn-danger" type="submit" name="add" value="Accepter" onclick="acceptFriendRequest('.$uid2.');" >';
	}

	if($modifier -> checkFriend($uid,$uid2) > 0){
		$html = '<input class="btn btn-success" type="submit" name="add" value="Retirer de la liste" onclick="removeFriend('.$uid2.');" >';
	}
	echo($html);
?>