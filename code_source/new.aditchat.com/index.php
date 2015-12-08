<?php
    // Activation des erreur
    error_reporting(E_ALL);
    ini_set('display_errors','On');
    
    //Fonction
   // include($_SERVER["DOCUMENT_ROOT"]."controlleur/functions.php");
    
    //Activation des session
    session_start();


    if(!isset($_GET["page"])){
        header("Location: /Portail");
    }else if(isset($_GET["page"])){
        $page = strtolower($_GET["page"]);
        $pagePath = "vue/page/".$page."/".$page.".php";
        if(!file_exists($pagePath)){
            header("Location : /Error");
        }
    }else if(isset($_GET["page"]) AND isset($_GET["subpage"])){
        $page = strtolower($_GET["page"]);
        $subpage = strtolower($_GET["subpage"]);
        $pagePath = "vue/page/".$page."/".$subpage . ".php";
        if(!file_exists($pagePath)){
            header("Location : /Error");
        }
    }
?>

<!DOCTYPE html>
<html lang="FR-fr">
	<head>
		<title>ADITCHAT</title>
		<script src="/scripts/jquery.js"></script>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
	
	<body>
		<section class="page">
                    <?php include($pagePath);?>
		</section>
	</body>
</html>