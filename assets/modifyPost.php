<?php
	include_once '../classe/poste.class.php';
	session_start();
	$uid = $_SESSION['id'];
	$modifier = new poste();
	if(isset($_POST['id'])){
        		$datestatus = date("Y-m-d H:i:s");
        		$modifier ->modifier($_POST['id'],$_POST['content'],$datestatus);
    }
?>