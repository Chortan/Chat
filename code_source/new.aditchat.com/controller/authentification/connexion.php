<?php
    session_start();
    include($_SERVER["DOCUMENT_ROOT"]."/modele/User.php");

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
    if(count($_POST) > 0){
        if(!isset($_POST["login"])) $_SESSION["erreur"][]="Vous devez renseigner un mail ou pseudo'login'";
        if(!isset($_POST["password"])) $_SESSION["erreur"][]="Vous devez renseigner un mot de passe 'password'";

        if(isset($_SESSION["erreur"])) header("Location: /Erreur");

        if(empty($_POST["login"])) $_SESSION["erreur"][]="Vous devez compléter le champ mail ou pseudo";
        if(empty($_POST["password"])) $_SESSION["erreur"][]="Vous devez compléter le champ mot de passe";

        if(isset($_SESSION["erreur"])) header("Location: /Erreur");

        if(filter_var($_POST["login"], FILTER_VALIDATE_EMAIL)){
            $user = User::getUserByMail($_POST["login"]);
        }else{
            $user = User::getUserByPseudo($_POST["login"]);
        }
        
        

        if(!$user){
            $_SESSION["erreur"][401] = "Impossible de vous authentifier, merci de vérifier vos identifiants.";
            header("Location: /Erreur");
        }else{
            if($user->getPassword() != sha1($_POST["password"])){
                $_SESSION["erreur"][401] = "Impossible de vous authentifier, merci de vérifier vos identifiants.";
                header("Location: /Erreur");
            }else{
                $user->setIsOnline(1);
                $user->save();
                $_SESSION["user"] = $user;
                header("Location: /Portail");
            }
        }
		
    }
?>