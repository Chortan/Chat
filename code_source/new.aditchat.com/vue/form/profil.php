<?php
include("vue/rsc/part/avatar.php");
authentificationRequire();
if(isset($_SESSION["user"]));
	$user = $_SESSION["user"];
		
	$formProfil = new Form("Vos informations");	
    $formProfil->setMethod("POST");
	
    $formProfil->setAction("/controller/profil/profil.php");
	
    $mail=new Element("mail",$user->getMail());
	$mail->setLabel("Mail");
	
	$birthdate = date('d/m/Y', strtotime(str_replace('-', '/', $user->getBirth())));
	$birth=new Element("birth",$birthdate);
    $birth->setLabel("Date de naissance");
	
	$phone=new Element("phone",$user->getPhoneNumber());
	$phone->setLabel("Numéro de téléphone");
	
	$country=new Element("country",$user->getCountry());
	$country->setLabel("Pays");
	
	$city=new Element("city",$user->getCity());
	$city->setLabel("Ville");
	
    $formProfil->addElement($mail);
	$formProfil->addElement($birth);
	$formProfil->addElement($phone);
	$formProfil->addElement($country);
	$formProfil->addElement($city);
    $formProfil->submit("Enregistrer");
    
	echo $formProfil->render();
?>