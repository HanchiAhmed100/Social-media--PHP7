<?php
	include_once '../classe/poste.class.php';
	include_once '../classe/amis.class.php';
	session_start();
	$uid = $_POST['id'];
	$get = new poste();
	$result = $get -> getpost($uid);
	$amis = new amis();

	if($uid == $_SESSION['id'] || $amis -> checkFriend($uid,$_SESSION['id']) > 0)
	while($p = $result -> fetch()){
		echo("<div class='post'>");
		$pPic = $get -> getUserPicture($p['uid']);
		echo(" <img src='$pPic' class='img img-circle' width='25px'>".$get -> getUsername($p['uid']));
		if($uid == $_SESSION['id']){echo '<li class="dropdown" style="float:right;list-style:none">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-plus plusss"></i></a>
                	<ul class="dropdown-menu">';
                  	/*echo "<li><a  href=\"?modifier=".$p['id']."\">Modifier</a></li>";*/
                  	echo "<li onclick='test(".$p['id'].");'> <a>Modifier</a></li>";
                  	echo "<li onclick='deletePost(".$p['id'].");'> <a>Supprimer</a></li>";
                	echo '</ul></li>';}
              echo'<hr>';

        if(!empty($get -> getPicture($p['id'])))
        	echo('<img src="'.$get -> getPicture($p['id']).'" style="width:100%"><hr>');
		echo(htmlspecialchars($p["content"])."<hr>");
		$likes = $get -> getLikes($p['id']);
		$pid = $p['id'];
		$uid2 = $p['uid'];
		$liked = $get -> getUserLikes($pid,$_SESSION['id']) >= 1 ? "fa-heart liked" : "fa-heart-o unliked";

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

		

		echo("</div>");
	}
?>