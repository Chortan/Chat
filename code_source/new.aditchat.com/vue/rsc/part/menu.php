<?php

    if(!isConnected()){
		echo("<nav id='menu'><ul id=\"menu_1\">
			<li><h1>Aditchat</h1></li>
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
		
        echo("<nav id='menu'><ul id=\"menu_2\">
        		<li><h1>Aditchat</h1></li>
				<li><a href='/Portail' title=\"Accueil\">Accueil</a></li>
				<li><a href='/Salon/Canal' title=\"Contacts\">Mes contacts</a></li>
				<li><a href='/controller/authentification/deconnexion.php' title=\"Déconnexion\">Déconnexion</a></li>
				<li><div id='pseudo'><a href='/Portail/Profil' title=\"Profil\">$pseudo</a>
				<img src='/$avatar'></div></li>
				</ul></nav>");
    }

?>