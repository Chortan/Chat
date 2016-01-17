<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    include($_SERVER["DOCUMENT_ROOT"]."/modele/User.php");
    session_start();
    
    $_SESSION["user"]->setIsOnline(0);
    $_SESSION["user"]->save();
    
    session_destroy();
    header("Location: /Portail");
?>

