<?php
	        
    authentificationRequire();
    echo("<section id='listUser'>"
            . "<h2>Les utilisateurs connectés</h2>");
    foreach(User::getAllUsers() as $user){
        echo("<a href='/Salon/Canal/".$user->getID()."'>".$user->getPseudo()."</a><br/>");
    }
    echo("</section>");
?>

