<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once($_SERVER["DOCUMENT_ROOT"]."/modele/User.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/modele/Message.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/modele/Canal.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/controller/functions.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/controller/userSystem.php");

session_start();
authentificationRequire();

if(isset($_POST["id_canal"]) && isset($_POST["message"])){
    if(is_numeric($_POST["id_canal"])){        
        $canal = Canal::getCanalByID(intval($_POST["id_canal"]));
        if($canal){
            if($canal->isInCanal($_SESSION["user"])){
                $canal->addMessage(new Message($_POST["message"],$_SESSION["user"]));
                echo("Save canal ... ");
                $canal->save();
                echo("ok<br/>");
                header("Location: /Salon/Canal/".$canal->getID());
            }else{
                $messages[]=new Message(
                    "Vous ne faisez pas partie de se canal, vous ne pouvez donc pas y envoyer et recevoir des messages.",
                    $_SESSION["system"]
                );
            }
        }else{
            $message = new Message("Le canal n'existe pas !", $_SESSION["system"]);
        }
    }
}
?>