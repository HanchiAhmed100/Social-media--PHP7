<?php
	include_once '../classe/message.class.php';
	session_start();
	$uid = $_SESSION['id'];
	$uid2 = $_POST['id'];
	$get = new message();
	$result = $get -> getMessages($uid,$uid2);

	while($p = $result -> fetch()){
		$t = $p['uid'] == $uid ? 'self' : 'other';
		echo("<li class='$t'>");
		echo("<div class='msg'>");
		echo("<p>");
		echo(htmlspecialchars($p['content']));
		echo("</p>");
		echo("</div>");
		echo("</li>");
	}
?>