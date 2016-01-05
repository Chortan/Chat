<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once($_SERVER["DOCUMENT_ROOT"]."/modele/User.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/controller/functions.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/modele/Message.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/modele/Canal.php");
session_start();

if(isset($_POST["message"]) AND $_POST["id_canal"] AND isConnected()){
    /*$message = $_POST["message"];
    echo "data:".$message."<br/>";
    $message = new Message($message,$_SESSION["user"]);
    $canal = Canal::getCanalByID($_POST["id_canal"]);
	if(!$canal){
		$name = $_SESSION["user"]->getPseudo() . ", " . User::getUserByID($_POST["id_canal"]);
		$canal = new Canal();
	}
    $canal->addMessage($message);
    $canal->save();*/
    header("Location: /Salon/Canal");
}
?>
