<?php
include($_SERVER["DOCUMENT_ROOT"]."modele/User.php");
include($_SERVER["DOCUMENT_ROOT"]."modele/bdd/connect.php");

session_start();
    
if(count($_POST) > 0){
	
	if(isset($_SESSION["user"]));
	$user = $_SESSION["user"];
	
    if(!isset($_POST["mail"])){$mail = $user->getMail();}else{$mail = $_POST["mail"];}
	if(!isset($_POST["birth"])){ $birth = $user->getBirth();}else{$birth = $_POST["birth"];}
	if(!isset($_POST["phone"])){$phone = $user->getPhoneNumber();}else{$phone = $_POST["phone"];}
	if(!isset($_POST["country"])){$country = $user->getCountry();}else{$country = $_POST["country"];}
	if(!isset($_POST["city"])){$city = $user->getCity();}else{$city = $_POST["city"];}

	if(empty($_POST["mail"])){$mail = $user->getMail();}else{$mail = $_POST["mail"];}
	if(empty($_POST["birth"])){ $birth = $user->getBirth();}else{$birth = $_POST["birth"];}
	if(empty($_POST["phone"])){$phone = $user->getPhoneNumber();}else{$phone = $_POST["phone"];}
	if(empty($_POST["country"])){$country = $user->getCountry();}else{$country = $_POST["country"];}
	if(empty($_POST["city"])){$city = $user->getCity();}else{$city = $_POST["city"];}
	
	/*Enregistrement de l'avatar*/
	$avatar_tmp = $user->getAvatar();
	if(isset($_FILES['avatar']) && $_FILES['avatar']['name']){
		$dossier = $_SERVER["DOCUMENT_ROOT"]."/vue/rsc/image/avatar/";
		$fichier = basename($_FILES['avatar']['name']);
		move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier);
		$avatar = "vue/rsc/image/avatar/$fichier";
	}
	else{
	$avatar = $avatar_tmp;
	}
	
	$user->setBirth($birth);
	$user->setPhoneNumber($phone);
	$user->setMail($mail);
	$user->setCountry($country);
	$user->setCity($city);
	$user->setAvatar($avatar);
	$user->save();
	
	header("Location: /Portail/Profil");
	
}
?>