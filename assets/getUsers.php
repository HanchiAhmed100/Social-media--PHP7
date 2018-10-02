<?php
	include_once '../classe/login.class.php';
	session_start();
	$uid = $_SESSION['id'];
	$modifier = new login();
	
	$get = $modifier -> getUsers();
	while ($res = $get -> fetch()) {
		echo($res['nom'].$res['prenom']." ");
	}
?>