﻿<?php
    
    if(!isConnected()){
        include($_SERVER["DOCUMENT_ROOT"]."/vue/form/inscription.php");
        include($_SERVER["DOCUMENT_ROOT"]."/vue/form/connexion.php");  
    }else{
        echo("<a href='/Salon/Canal' class='btn btn-info' id='enterCanal' >Entrer dans le T'chat</a>");
    }
    
?>
    
    
  