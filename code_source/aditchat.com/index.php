<?php
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	
	
	/* INCLUDE */
	include("scripts/bdd/connect.php");
	include("scripts/functions.php");
	require($_SERVER["DOCUMENT_ROOT"]."/scripts/class/User.php");
	require($_SERVER["DOCUMENT_ROOT"]."/scripts/class/Canal.php");
	require($_SERVER["DOCUMENT_ROOT"]."/scripts/class/Message.php");
	
	
	require($_SERVER["DOCUMENT_ROOT"]."/scripts/class/Form/Form.php");
	require($_SERVER["DOCUMENT_ROOT"]."/scripts/class/Form/Element.php");
	
	session_start();
	
	
	if(isset($_GET["page"])){
		$page="Pages/".$_GET["page"]."/".$_GET["page"].".php";
		if(isset($_GET["subPage"])){
			$page="Pages/".$_GET["page"]."/".$_GET["subPage"].".php";
		}
		if(!file_exists($page)){
			$_SESSION["erreur"][404]=" La page '".$_GET["page"]."/".$_GET["subPage"]."' est introuvable.";
			header("Location: /Erreur");
		}
	}else{
		header("Location: /Portail");
	}
?>

<!DOCTYPE html>
<html lang="FR-fr">
	<head>
		<title>T'chat - gratuit</title>
		<script src="/scripts/jquery.js"></script>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />		<?php 
			require("scripts/style/style.php"); 
			header( 'content-type: text/html; charset=utf-8' );
		?>
	</head>
	
	<body>
		<section class="page">
			<?php
				include($page);
			?>
		</section>
	</body>
</html>