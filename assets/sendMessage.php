<?php
	include_once '../classe/message.class.php';
	session_start();
	$uid = $_SESSION['id'];
	$get = new message();
	$get -> sendMessage($uid,$_POST['id2'],$_POST['content']);
?>