<?php
spl_autoload_register();

    function erreur($code,$message){
        $_SESSION["erreur"][$code] = $message;
        header("Location: /Erreur");
    }
    
    function authentificationRequire(){
        if(!isset($_SESSION["user"])){
            erreur(401,"Authentification requise : <a href='/Portail/Inscription'>Inscription</a> - <a href='/Portail/Connexion'>Connexion</a>");
        }
    }
    
    function isConnected(){
        if(isset($_SESSION["user"])){
            return true;
        }else{
            return false;
        }
    }
    
    function __autoload($class_name) {
        require_once($_SERVER["DOCUMENT_ROOT"]."/modele/".$class_name.".php");
    }
?>