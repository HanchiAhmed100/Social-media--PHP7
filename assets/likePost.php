<?php
	include_once '../classe/poste.class.php';
	session_start();
	$uid = $_SESSION['id'];
	$modifier = new poste();
	if(isset($_POST['id'])){
			if($modifier -> getUserLikes($_POST['id'],$uid) < 1){
        		$modifier ->likePost($uid,$_POST['id']);
        	}else{
        		$modifier ->unlikePost($uid,$_POST['id']);
        	}
    }
    $liked = $modifier -> getUserLikes($_POST['id'],$uid) < 1 ? 'liked' : 'unliked';
    echo ($liked.$modifier -> getLikes($_POST['id']));
?>