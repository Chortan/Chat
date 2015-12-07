<?php
	if(count($_POST)>0){
		$errorCodeExist=200;
		$errorCodeEmpty=200;
		
		if(!isset($_POST["pseudo"])) $_SESSION["erreur"][$errorCodeExist]="Vous n'avez pas spécifié de nom d'utilisateur";
		if(!isset($_POST["mail"])) $_SESSION["erreur"][$errorCodeExist]="Vous n'avez pas spécifié de mail";
		if(!isset($_POST["password"])) $_SESSION["erreur"][$errorCodeExist]="Vous n'avez pas spécifié de mot de passe";
		if(!isset($_POST["confirmPassword"])) $_SESSION["erreur"][$errorCodeExist]="Vous n'avez pas spécifié la confirmation du mot de passe";
		if(!isset($_POST["birth"])) $_SESSION["erreur"][$errorCodeExist]="Vous n'avez pas spécifié de date d'anniversaire";
		if(!isset($_POST["sexeFemme"]) AND !isset($_POST["sexeHomme"])) $_SESSION["erreur"][$errorCodeExist]="Vous n'avez pas spécifié votre sexe";
		
		if(empty($_POST["pseudo"])) $_SESSION["erreur"][$errorCodeEmpty]="Vous n'avez pas spécifié de nom d'utilisateur";
		if(empty($_POST["mail"])) $_SESSION["erreur"][$errorCodeEmpty]="Vous n'avez pas spécifié de mail";
		if(empty($_POST["password"])) $_SESSION["erreur"][$errorCodeEmpty]="Vous n'avez pas spécifié de mot de passe";
		if(empty($_POST["confirmPassword"])) $_SESSION["erreur"][$errorCodeEmpty]="Vous n'avez pas spécifié la confirmation du mot de passe";
		if(empty($_POST["birth"])) $_SESSION["erreur"][$errorCodeEmpty]="Vous n'avez pas spécifié de date d'anniversaire";
		
		if(isset($_POST["sexeHomme"])){
			$sexe='H';
		}else if(isset($_POST["sexeFemme"])){
			$sexe='F';
		}else{
			$sexe='';
		}

		if(isset($_SESSION["erreur"])) header("Location: /Erreur");
		
		$user = new User(User::generateID(),$_POST["pseudo"],$_POST["birth"],$sexe,$_POST["mail"],$_POST["password"]);
		$user->updateAge($_POST["birth"]);
		
		
		$req=$bdd->prepare("SELECT * FROM user WHERE UCASE(pseudo)=UCASE(:pseudo) OR UCASE(email)=UCASE(:email)");
		$req->execute(Array(
			":pseudo"=>$_POST["pseudo"], 
			":email" => $_POST["mail"]
		));
		
		if($req->rowCount()>=1){
			$_SESSION["erreur"][]="Le pseudo ou le mail renseigner existe déjà.";
			header("Location: /Erreur");
		}else{
			$user->save();
		}
		
	}
?>

<?php
	$formInscription = new Form("Inscription");
	
	$formInscription->setMethod("POST");

	$formInscription->setAction("/Portail/Inscription");
	
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
		$radioHomme->setName("sexeHomme");
                $radioHomme->setClass("sexeRadio");
	$radioFemme=new Element("sexe","Femme");
		$radioFemme->setTypeElement("radio");
		$radioFemme->setName("sexeFemme");
                $radioFemme->setClass("sexeRadio");
	
	$formInscription->addElement($pseudo);
	$formInscription->addElement($mail);
	$formInscription->addElement($password);
	$formInscription->addElement($confirmPassword);
	$formInscription->addElement($birth);
	$formInscription->addElement($radioFemme);
	$formInscription->addElement($radioHomme);
	$formInscription->submit("Inscription");
	
	echo $formInscription->render();
?>