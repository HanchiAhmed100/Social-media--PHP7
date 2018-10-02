<?php
	include_once'../classe/notification.class.php';
	include_once'../classe/poste.class.php';

	session_start();
	$uid = $_SESSION['id'];

	$get = new notification();
	$poste = new poste();

	$nots = $get -> getUnopenedNotifications($uid) ->fetchAll();
	for ($i=0; $i < count($nots) ; $i++) { 
		$nots[$i]["name"]=$poste -> getUsername($nots[$i]['uid']);
	}
	$data = json_encode($nots);
	echo($data);
?>