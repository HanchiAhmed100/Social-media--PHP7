<?php
	include_once'../classe/notification.class.php';
	session_start();

	$uid = $_SESSION['id'];
	$uid2 = $_POST['uid2'];

	$get = new notification();

	if($uid != $uid2)
		$get -> setNotification($uid,$uid2,10);
?>