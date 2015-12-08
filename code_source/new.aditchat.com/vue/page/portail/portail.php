<?php
    include($_SERVER["DOCUMENT_ROOT"]."/vue/rsc/form/form.php");
    include($_SERVER["DOCUMENT_ROOT"]."/vue/rsc/form/element.php");
?>
    
    
    <?php
	$formInscription = new Form("Inscription");
	$formConnexion = new Form("Connexion");
	
	$formInscription->setMethod("POST");
	$formConnexion->setMethod("POST");

	$formInscription->setAction("/Portail/Inscription");
	$formConnexion->setAction("/Portail/Connexion");
	
	$pseudo=new Element("pseudo","Votre pseudo");
		$pseudo->requireElement(true);
	$mail=new Element("mail","Votre email");
		$mail->setTypeElement("email");
		$mail->requireElement(true);
	$password=new Element("password","Mot de passe");
		$password->setTypeElement("password");
		$password->requireElement(true);
	$confirmPassword=new Element("confirmPassword","Confirmez votre mot de passe");
		$confirmPassword->setTypeElement("password");
		$confirmPassword->requireElement(true);
	$birth=new Element("birth","Votre date de naissances");
		$birth->requireElement(true);
	
	$radioHomme=new Element("sexe","Homme");
		$radioHomme->setTypeElement("radio");
		$radioHomme->setName("sexe");
                $radioHomme->setClass("sexeRadio");
                $radioHomme->setValue("sexeHomme");
	$radioFemme=new Element("sexe","Femme");
		$radioFemme->setTypeElement("radio");
		$radioFemme->setName("sexe");
                $radioFemme->setClass("sexeRadio");
                $radioFemme->setValue("sexeFemme");
                
	$formInscription->addElement($pseudo);
	$formInscription->addElement($mail);
	$formInscription->addElement($password);
	$formInscription->addElement($confirmPassword);
	$formInscription->addElement($birth);
	$formInscription->addElement($radioFemme);
	$formInscription->addElement($radioHomme);
	$formInscription->submit("Inscription");
	
	$formConnexion->addElement($pseudo);
	$formConnexion->addElement($password);
	$formConnexion->submit("Entrez dans le Tchat");
	
        echo $formInscription->render();
	echo $formConnexion->render();
?>