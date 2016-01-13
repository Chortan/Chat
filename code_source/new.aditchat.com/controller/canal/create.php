<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
   
    require_once($_SERVER["DOCUMENT_ROOT"]."/modele/User.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/modele/Message.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/modele/Canal.php");
    
    session_start();     
    require_once($_SERVER["DOCUMENT_ROOT"]."/controller/functions.php");
    authentificationRequire();
    
    if(isset($_GET["user"])){
        $to = User::getUserByID($_GET["user"]);
        $me = $_SESSION["user"];
        
        $canal = new Canal($me->getPseudo(). ", " . $to->getPseudo(), $me);
        $canal->addUser($to);
        
        $canal->save();
        
    }
?>

