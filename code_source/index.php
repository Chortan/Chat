<!DOCTYPE html>

<?php
error_reporting(E_ALL);
session_start();
if (0 > version_compare(PHP_VERSION, '5')) {
	die('This file was generated for PHP 5');
}

if(isset($_GET["page"])){
	$page=$_GET["page"];
	if(file_exists($page)){
		
	}else{
		http_response_code(404);
	}
}

?>

<html>
	<head>
		<title>X - un t'chat gratuit</title>
	</head>
	<body>
		<h1>This is a t'chat</h1>
	</body>
</html>