<?php
    
    include($_SERVER["DOCUMENT_ROOT"]."/modele/User.php");
    include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
    
    session_start();
    
if(count($_POST)>0){
    $errorCodeExist=200;
    $errorCodeEmpty=200;

    if(!isset($_POST["pseudo"])) $_SESSION["erreur"][$errorCodeExist]="Vous n'avez pas spécifié de nom d'utilisateur";
    if(!isset($_POST["mail"])) $_SESSION["erreur"][$errorCodeExist]="Vous n'avez pas spécifié de mail";
    if(!isset($_POST["password"])) $_SESSION["erreur"][$errorCodeExist]="Vous n'avez pas spécifié de mot de passe";
    if(!isset($_POST["confirmPassword"])) $_SESSION["erreur"][$errorCodeExist]="Vous n'avez pas spécifié la confirmation du mot de passe";
    if(!isset($_POST["birth"])) $_SESSION["erreur"][$errorCodeExist]="Vous n'avez pas spécifié de date d'anniversaire";
    
    if(empty($_POST["pseudo"])) $_SESSION["erreur"][$errorCodeEmpty]="Vous n'avez pas spécifié de nom d'utilisateur";
    if(empty($_POST["mail"])) $_SESSION["erreur"][$errorCodeEmpty]="Vous n'avez pas spécifié de mail";
    if(empty($_POST["password"])) $_SESSION["erreur"][$errorCodeEmpty]="Vous n'avez pas spécifié de mot de passe";
    if(empty($_POST["confirmPassword"])) $_SESSION["erreur"][$errorCodeEmpty]="Vous n'avez pas spécifié la confirmation du mot de passe";
    if(empty($_POST["birth"])) $_SESSION["erreur"][$errorCodeEmpty]="Vous n'avez pas spécifié de date d'anniversaire";

    if(isset($_POST["sexe"])){
        if($_POST["sexe"]=='H' || $_POST["sexe"]=='F')
            $sexe=$_POST["sexe"];
        else
            $_SESSION["erreur"][]="Veuillez renseigner votre sexe.";
    }else{
        $_SESSION["erreur"][]="Veuillez renseigner votre sexe.";
    }

    if(isset($_SESSION["erreur"])) header("Location: /Erreur");
        $user = new User($_POST["pseudo"], $_POST["birth"], $sexe, $_POST["mail"], $_POST["password"]);
        $user->encrypt();

       $req=$bdd->prepare("SELECT * FROM user WHERE UCASE(pseudo)=UCASE(:pseudo) OR UCASE(mail)=UCASE(:mail)");
        $req->execute(Array(
            ":pseudo"=>$_POST["pseudo"], 
            ":mail" => $_POST["mail"]
        ));
        
        if($req->rowCount()>=1){
            $_SESSION["erreur"][]="Le pseudo ou le mail renseigner existe déjà.";
            header("Location: /Erreur");
        }else{
            $user->save();
            header("Location: /Portail/Connexion");
        }

    }
?>