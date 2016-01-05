<?php	
	require_once($_SERVER["DOCUMENT_ROOT"]."/modele/User.php");	
	$users = User::getUsersOnline();
	foreach( $users as $user){
		echo("<a href='/Salon/Canal/".$user->getID()."'>".$user->getPseudo()."</a><br/>");
	}
?>