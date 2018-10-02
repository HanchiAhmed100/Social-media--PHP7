<?php
	include_once '../classe/amis.class.php';
	session_start();
	$uid = $_SESSION['id'];
	$uid2 = $_POST['id2'];
	$modifier = new amis();
	$modifier ->removeFriendRequest($uid,$uid2);
?>