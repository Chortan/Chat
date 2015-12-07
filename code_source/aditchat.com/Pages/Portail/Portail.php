<?php
	$formInscription = new Form("Inscription");
	$formConnexion = new Form("Connexion");
	
	$formInscription->setMethod("POST");
	$formConnexion->setMethod("POST");

	$formInscription->setAction("/Portail/Inscription");
	$formConnexion->setAction("/Portail/Connexion");
	
	$pseudo=new Element("login","Votre pseudo");
	$mail=new Element("mail","Votre email");
		$mail->setTypeElement("email");
	$password=new Element("password","Mot de passe");
		$password->setTypeElement("password");
	$confirmPassword=new Element("confirmPassword","Confirmez votre mot de passe");
		$confirmPassword->setTypeElement("password");
	
	
	$formInscription->addElement($pseudo);
	$formInscription->addElement($mail);
	$formInscription->addElement($password);
	$formInscription->addElement($confirmPassword);
	$formInscription->submit("Inscription");
	
	$formConnexion->addElement($pseudo);
	$formConnexion->addElement($password);
	$formConnexion->submit("Entrez dans le Tchat");
	echo $formInscription->render();
	echo $formConnexion->render();
?>