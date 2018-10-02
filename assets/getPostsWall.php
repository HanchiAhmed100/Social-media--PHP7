<?php
	include_once '../classe/poste.class.php';
	include_once '../classe/amis.class.php';
	session_start();
	$uid = $_SESSION['id'];
	$get = new poste();
	$amis = new amis();

	$tmp = $amis ->getFriends($uid);
	while($tmp2 = $tmp -> fetch()){
		$tmp4 = $uid == $tmp2['uid'] ? $tmp2['uid2'] : $tmp2['uid'];
		$tmp3 = $get ->getUserPosts($tmp4);
		while($p = $tmp3 -> fetch()){
			echo("<div class='post'>");
		echo(" <img src='images/im2.png' class='img img-circle' width='25px'>".$get -> getUsername($p['uid']));
              echo'<hr>';
		echo(htmlspecialchars($p["content"])."<hr>");
		$likes = $get -> getLikes($p['id']);
		$pid = $p['id'];
		$uid2 = $p['uid'];
		$liked = $get -> getUserLikes($pid,$uid) >= 1 ? "fa-heart liked" : "fa-heart-o";

		$comments = $get -> getComments($p['id']) -> rowCount();
		echo("<i class='tmp fa $liked fa-x2 like' onclick='likePost($pid,$uid2,this);'> J'aime</i> &nbsp &nbsp <i class='tmp fa fa-comments-o' onclick='addComment($pid);'> Commenter</i>");
		echo("<p style='float:right;'>".$p["datestatus"]."</p>");

		echo("<hr>");
		echo("<i class='fa fa-heart numLikes'>$likes</i> <i class='fa fa-comments' onclick=\"$('#c$pid').show();\">$comments</i> <hr>");

		$cmts = $get -> getComments($p['id']);
		while($c = $cmts -> fetch()){
			echo("<div>");
			echo($n = $get -> getUsername($c['uid']));
			echo("<br>");
			echo($c['content']);
			echo("</div>");
		}

		

		echo("</div>");
		}
	}
?>