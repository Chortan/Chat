<?php
	        
    authentificationRequire();
    foreach(User::getAllUsers() as $user){
        echo("<a href='/Salon/Canal/".$user->getID()."'>".$user->getPseudo()."</a><br/>");
    }
?>

