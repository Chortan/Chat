<?php

    if(!isConnected()){
		echo("<nav><ul id=\"menu_1\">
			<li><a href='/Portail' title=\"Accueil\">Accueil</a></li>
			<li><a href='/Portail/Connexion'>Connexion</a></li>
			<li><a href='/Portail/Inscription'>Inscription</a></li>
			<li><a href='#'>Contact</a></li>
			</ul></nav>");
    }else{
		authentificationRequire();
		if(isset($_SESSION["user"]));
		$user = $_SESSION["user"];
		$user->getPseudo();
		$pseudo = $user->getPseudo();
		$avatar = $user->getAvatar();
		
        echo("<nav><ul id=\"menu_2\">
				<li><a href='/Portail' title=\"Accueil\">Accueil</a></li>
				<li><a href='#' title=\"Contacts\">Mes contacts</a></li>
				<li><a href='#' title=\"Profil\">$pseudo</a></li>
				<img src='$avatar'>
				<li><a href='/controller/authentification/deconnexion.php' title=\"Déconnexion\">Déconnexion</a></li>
				</ul></nav>");
    }

?>