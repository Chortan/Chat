<?php
	if(count($_POST) > 0){
		if(!isset($_POST["login"])) $_SESSION["erreur"][]="Vous devez renseigner un mail ou pseudo'login'";
		if(!isset($_POST["password"])) $_SESSION["erreur"][]="Vous devez renseigner un mot de passe 'password'";
		
		if(isset($_SESSION["erreur"])) header("Location: /Erreur");
		
		if(empty($_POST["login"])) $_SESSION["erreur"][]="Vous devez compléter le champ mail ou pseudo";
		if(empty($_POST["password"])) $_SESSION["erreur"][]="Vous devez compléter le champ mot de passe";
	
		if(isset($_SESSION["erreur"])) header("Location: /Erreur");
		
		if(filter_var($_POST["login"], FILTER_VALIDATE_EMAIL)){
			$sql="SELECT idUser FROM user WHERE UCASE(email)=UCASE(:login) AND UCASE(password)=UCASE(:password)";
		}else{
			$sql="SELECT idUser FROM user WHERE UCASE(pseudo)=UCASE(:login) AND UCASE(password)=UCASE(:password)";
		}
		
		$req=$bdd->prepare($sql);
		$req->execute(
			Array(
				":login" => $_POST["login"] , 
				":password" => sha1($_POST["password"])
			)
		);
		
		if($req->rowCount()==1){
			$idUser=$req->fetch();
			$user= new User(0,"","","","","");
			$_SESSION["user"]=$user->getUserByID($idUser["idUser"]);
			header("Location: /Salon/Canal");
		}else if($req->rowCount()==0){
			$_SESSION["erreur"][]="Les identifiant données sont invalide.";
			echo "Les identifiant données sont invalide.";
			
		}else{
			$_SESSION["erreur"][]="Une erreur est survenu au seins de la base de données.";
			echo "Une erreur est survenu au seins de la base de données.";
		}

		if(isset($_SESSION["erreur"])) header("Location: /Erreur");
		
	}
?>


<?php
    include($_SERVER["DOCUMENT_ROOT"]."/vue/form/connexion.php");
?>