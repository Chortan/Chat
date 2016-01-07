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

session_start();

$system = new User("Système", "01/01/0001", 'O', "system@aditchat.com", "systemAditchat.c0m");
$_SESSION["system"]=$system;
