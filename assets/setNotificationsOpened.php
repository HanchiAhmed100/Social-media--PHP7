<?php
	include_once'../classe/notification.class.php';
	session_start();
	$uid = $_SESSION['id'];

	$get = new notification();

	$get -> setNotificationsOpened($uid);
?>