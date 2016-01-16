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

if(isset($_POST["id_canal"])){
    $canal = Canal::getCanalByID(isset($_POST["id_canal"]));
    
    if($canal->isInCanal($_SESSION["user"])){
        $messages = Array();
        if(isset($_POST["lastMessage"])){
            $messages = $canal->getMessagesByDate($_POST["lastMessage"]);
        }else{
            $messages = $canal->getAllMessages();
        }
        if($message == false){
            http_response_code (500);
            die();
        }
        foreach($messages as $message){
            if($message->getTransmitter()->equals($_SESSION["user"])){
                $who = "me";
            }else{
                $who = "other";
            }
            echo("<div id='message' class='$who'>".
                "<a id='date'>".date("H:i", $message->getDate())."</a>".
                $message->getTransmitter()->getPseudo()." : ".
                $message->getContentWithEmoji()."</div><br/>");
        }
    }else{
        $messages[]=new Message(
            "Vous ne faisez pas partie de se canal, vous ne pouvez donc pas y envoyer et recevoir des messages de celui-ci.",
            $_SESSION["system"]
        );
        
    }
    
    
}