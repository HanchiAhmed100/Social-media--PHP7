<?php
	include_once '../classe/poste.class.php';
	session_start();
	$uid = $_SESSION['id'];
	$modifier = new poste();
	if(isset($_POST['id'])){
        		$modifier ->addComment($_POST['id'],$uid,$_POST['content']);
    }
?>