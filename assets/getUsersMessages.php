<?php

include_once '../classe/login.class.php';
session_start();
$uid = $_SESSION['id'];

$get = new login();
$ff = $get -> getFriends($uid);
while($f = $ff -> fetch()){
	$uuid = $uid == $f['uid'] ? $f['uid2'] : $f['uid'];
	$ud = $get -> getUser($uuid)->fetch()['id'];
	echo("<a href='messages.php?u=$ud'>".$get -> getUsername($uuid)."</a>");
}

?>