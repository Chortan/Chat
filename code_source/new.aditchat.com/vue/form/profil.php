<?php
//require_once("controller/functions.php");
authentificationRequire();
if(isset($_SESSION["user"]));
	$user = $_SESSION["user"];
		
	$formProfil = new Form("Vos informations");	
    $formProfil->setMethod("POST");

    $formProfil->setAction("/controller/profil/profil.php");

    //$pseudo=new Element("pseudo",$user->getPseudo());
           //$pseudo->setName("Pseudo");
		   //$pseudo->setClass("form-control");
			
    $mail=new Element("mail",$user->getMail());
			$mail->setLabel("Mail");
           //$mail->setClass("form-control");
	$birthdate = date('d/m/Y', strtotime(str_replace('-', '/', $user->getBirth())));
	$birth=new Element("birth",$birthdate);
           	$birth->setLabel("Date de naissance");
			//$birth->setClass("form-control");
	$phone=new Element("phone",$user->getPhoneNumber());
			$phone->setLabel("Numéro de téléphone");
			//$phone->setClass("form-control");
	$country=new Element("country",$user->getCountry());
		$country->setLabel("Pays");
            //$country->setClass("form-control");
	$city=new Element("city",$user->getCity());
		$city->setLabel("Ville");
            //$city->setClass("form-control");

    //$formProfil->addElement($pseudo);
    $formProfil->addElement($mail);
	$formProfil->addElement($birth);
	$formProfil->addElement($phone);
	$formProfil->addElement($country);
	$formProfil->addElement($city);
    $formProfil->submit("Enregistrer");
    echo $formProfil->render();
?>