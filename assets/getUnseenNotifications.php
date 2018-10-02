<?php
	include_once'../classe/notification.class.php';
	session_start();
	$uid = $_SESSION['id'];

	$get = new notification();

	echo($get -> getUnseenNotifications($uid) -> rowCount());
?>