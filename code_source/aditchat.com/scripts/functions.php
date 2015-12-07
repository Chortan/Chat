<?php
	function erreur($code){
		header("Location: /Erreur");
		$_SESSION["erreur"]=404;
	}
?>