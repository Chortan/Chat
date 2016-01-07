<?php	
	require_once($_SERVER["DOCUMENT_ROOT"]."/modele/User.php");	
	$users = User::getUsersOnline();
        echo("<section id='listUser'>"
            . "<h4>Les utilisateurs connectés</h4>");
	foreach( $users as $user){
            if($user->getSexe() == 'H')
                $sexeEmoji = "1f466";
            else if($user->getSexe() == 'F')
                $sexeEmoji = "1f469";
            else
                $sexeEmoji = "1f464";
            
            echo("<img src='/vue/rsc/image/emoji/16x16/$sexeEmoji.png'/>");
            echo("<a href='/controller/canal/create.php?user=".$user->getID()."'>".$user->getPseudo()."</a><br/>");
	}
        echo("</section>");
?>