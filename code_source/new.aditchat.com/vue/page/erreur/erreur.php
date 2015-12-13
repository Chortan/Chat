<?php
if(isset($_SESSION["erreur"])){
	
	echo("<ul>
		<h1>Une erreur est survenu</h1>");
		$errorCode=200;
		foreach($_SESSION["erreur"] as $key => $erreur){
			echo("<li><strong>$key :</strong>$erreur</li>");
			$errorCode=$key;
		}
		http_response_code($errorCode);
		unset($_SESSION["erreur"]);
		
	echo("</ul>");
}else{
	echo("<h1>Aucune erreur</h1>
		<p>
			Retour à l'<a href='/Portail'>Accueil</a>.
		</p>
	");
}
?>