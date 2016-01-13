<?php	
	require_once($_SERVER["DOCUMENT_ROOT"]."/modele/User.php");	
	$users = User::getUsersOnline();
        echo("<h4 id='utilisateurConnecte'>Les utilisateurs connectés</h4>"
            . "<section id='listUser'>");
    $compteur = 0;
    $id = '';
	foreach( $users as $user){

        $compteur++;
        if(($compteur % 2) != 0){
            $id='divCanalUser';
        }

        echo("<div id='" . $id . "'>");

            if($user->getSexe() == 'H')
                $sexeEmoji = "1f466";
            else if($user->getSexe() == 'F')
                $sexeEmoji = "1f469";
            else
                $sexeEmoji = "1f464";
            
            echo("<img src='/vue/rsc/image/emoji/16x16/$sexeEmoji.png' id='canalUser'/>");
            echo("<a href='/controller/canal/create.php?user=".$user->getID()."' class='btn btn-info' id='canalUser'>".$user->getPseudo()."</a></div>");
	       //echo("</section>");
       $id='';
    }
    
    echo("<div>");
        $sexeEmoji = "1f469";
    echo("<img src='/vue/rsc/image/emoji/16x16/$sexeEmoji.png' id='canalUser'/>");
    echo("<a href='/controller/canal/create.php?user=".$user->getID()."' class='btn btn-info' id='canalUser'>Femme</a>");
    echo("</div>");

    echo("<div id='divCanalUser'>");
    $sexeEmoji = "1f466";
    echo("<img src='/vue/rsc/image/emoji/16x16/$sexeEmoji.png'/ id='canalUser'>");
    echo("<a href='/controller/canal/create.php?user=".$user->getID()."' class='btn btn-info' id='canalUser'>Homme</a>");
    echo("</div>");

    echo("<div>");
        $sexeEmoji = "1f469";
    echo("<img src='/vue/rsc/image/emoji/16x16/$sexeEmoji.png' id='canalUser'/>");
    echo("<a href='/controller/canal/create.php?user=".$user->getID()."' class='btn btn-info' id='canalUser'>Femme</a>");
    echo("</div>");

    echo("<div id='divCanalUser'>");
    $sexeEmoji = "1f466";
    echo("<img src='/vue/rsc/image/emoji/16x16/$sexeEmoji.png'/ id='canalUser'>");
    echo("<a href='/controller/canal/create.php?user=".$user->getID()."' class='btn btn-info' id='canalUser'>Homme</a>");
    echo("</div>");
        echo("</section>");
?>