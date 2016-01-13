<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once($_SERVER["DOCUMENT_ROOT"]."/modele/User.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/modele/Message.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/modele/Canal.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/controller/functions.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/controller/userSystem.php");

session_start();
authentificationRequire();

if(isset($_POST["id_canal"]) && isset($_POST["message"])){
    $canal = Canal::getCanalByID(isset($_POST["id_canal"]));
    if($canal->isInCanal($_SESSION["user"])){
        $canal->addMessage(new Message($_POST["message"],$_SESSION["user"]));
        $canal->save();
        header("Location: /Salon/Canal/".$canal->getID());
    }else{
        $messages[]=new Message(
            "Vous ne faisez pas partie de se canal, vous ne pouvez donc pas y envoyer et recevoir des messages.",
            $_SESSION["system"]
        );
        
    }
}
?>
