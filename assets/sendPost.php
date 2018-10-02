<?php
	include_once '../classe/poste.class.php';
	session_start();
	$uid = $_SESSION['id'];
	$get = new poste();
	$get -> sendpost($uid,$_POST["content"]);
?>