<?php
    
    require_once($_SERVER["DOCUMENT_ROOT"]."modele/Message.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."modele/User.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."modele/Canal.php");
    
    //Activation des session
    session_start();
    

    // Activation des erreur
    error_reporting(E_ALL);
    ini_set('display_errors','On');
    
    //Fonction
    include($_SERVER["DOCUMENT_ROOT"]."controller/functions.php");
    
   


    if(!isset($_GET["page"])){
        header("Location: /Portail");
    }else if(isset($_GET["page"]) AND !isset($_GET["subpage"])){
        $page = strtolower($_GET["page"]);
        $pagePath = "vue/page/".$page."/".$page.".php";
        
    }else if(isset($_GET["page"]) AND isset($_GET["subpage"])){
        $page = strtolower($_GET["page"]);
        $subpage = strtolower($_GET["subpage"]);
        $pagePath = "vue/page/".$page."/". $subpage . ".php";        
    }else{
        header("Location: /Portail");
    }
    
    if(!file_exists($pagePath)){
        header("Location: /Erreur/code/404");
    }
?>

<!DOCTYPE html>
<html lang="FR-fr">
	<head>
		<title>ADITCHAT</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
		<script src="/scripts/jquery.js"></script>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
	
	<body>
		<section class="page">
                    <?php 
                        include($_SERVER["DOCUMENT_ROOT"]."vue/rsc/form/form.php");
                        include($_SERVER["DOCUMENT_ROOT"]."vue/rsc/form/element.php");
                        include($pagePath);
                    ?>
		</section>
	</body>
</html>