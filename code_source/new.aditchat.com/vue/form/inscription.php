<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
    
    $formInscription = new Form("Inscription");
    
    $formInscription->setClass("form");
    $formInscription->setMethod("POST");

    $formInscription->setAction("/controller/authentification/inscription.php");

    $pseudo=new Element("pseudo","Votre pseudo");
            $pseudo->requireElement(true);
            $pseudo->setClass("form-control");
    $mail=new Element("mail","Votre email");
            $mail->setTypeElement("email");
            $mail->requireElement(true);
            $mail->setClass("form-control");
    $password=new Element("password","Mot de passe");
            $password->setTypeElement("password");
            $password->requireElement(true);
            $password->setClass("form-control");
    $confirmPassword=new Element("confirmPassword","Confirmez votre mot de passe");
            $confirmPassword->setTypeElement("password");
            $confirmPassword->requireElement(true);
            $confirmPassword->setClass("form-control");
    $birth=new Element("birth","Votre date de naissances");
            $birth->requireElement(true);
            $birth->setClass("form-control");
            
    
    $divRadio = new Element("divRadio","");
            $divRadio->setElement("div");
            $divRadio->setTypeElement("");
            $divRadio->setClass("container-fluid");
            
    $radioHomme = new Element("sexe","Homme");
            $radioHomme->setTypeElement("radio");
            $radioHomme->setName("sexe");
            $radioHomme->setClass("sexeRadio");
            $radioHomme->setValue('H');
    $radioFemme = new Element("sexe","Femme");
            $radioFemme->setTypeElement("radio");
            $radioFemme->setName("sexe");
            $radioFemme->setClass("sexeRadio");
            $radioFemme->setValue('F');
            
    $divRadio->addElement($radioHomme);
    $divRadio->addElement($radioFemme);

    $formInscription->addElement($pseudo);
    $formInscription->addElement($mail);
    $formInscription->addElement($password);
    $formInscription->addElement($confirmPassword);
    $formInscription->addElement($birth);
    $formInscription->addElement($divRadio);
    $formInscription->submit("Inscription");

    echo $formInscription->render();

?>
