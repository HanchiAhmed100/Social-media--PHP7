<?php
	include_once '../classe/amis.class.php';
	session_start();
	$uid = $_SESSION['id'];
	$get = new amis();
	$result = $get -> getFriendRequests($uid);

	while($p = $result -> fetch()){
		$ud = $p['uid'];
		echo("<a href='other.php?u=$ud'>".$get -> getUser($p['uid'])."</a>");
	}
?>