<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $formConnexion = new Form("Connexion");	
    $formConnexion->setMethod("POST");

    $formConnexion->setAction("/controller/authentification/connexion.php");

    $pseudo=new Element("login","Votre pseudo");
    $password=new Element("password","Mot de passe");
            $password->setTypeElement("password");

    $formConnexion->addElement($pseudo);
    $formConnexion->addElement($password);
    $formConnexion->submit("Entrez dans le Tchat");
    echo $formConnexion->render();
?>
