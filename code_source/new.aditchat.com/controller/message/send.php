<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include($_SERVER["DOCUMENT_ROOT"]."/modele/Message.php");
include($_SERVER["DOCUMENT_ROOT"]."/modele/MessageSQL.php");

if(isset($_POST["message"]) AND isConnected()){
    $messageText = htmlentities($_POST["message"]);
    $message = new Message($messageText,$_SESSION["user"]);
    $message->save();
}
?>
