<?php include_once 'classe/login.class.php';
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$mail=$_POST['mail'];
	$motdepasse=$_POST['motdepasse'];
	$login = new login();
	$login->check($mail);
	$hashMDP = $login->passwordhash($motdepasse);	
	$login->register($nom,$prenom,$mail,$hashMDP);
	header('location:index.html')
?>