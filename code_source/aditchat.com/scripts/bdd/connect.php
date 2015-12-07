<?php
	try	{
		if(file_exists($_SERVER["DOCUMENT_ROOT"]."/scripts/bdd/loging.php")){
			require("loging.php");
		}else{
			header("Location: /first.php");
		}
		
		//include($_SERVER["DOCUMENT_ROOT"]."/scripts/bdd/reconfigure.php");		
	}
	catch (Exception $e){	
		//die('Erreur : ' . $e->getMessage());	//Afficher l'erreur de connexion
		echo("Could not established a connexion to data base :<br/>". $e->getMessage());
	}
?>