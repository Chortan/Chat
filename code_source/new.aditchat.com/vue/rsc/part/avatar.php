<?php
authentificationRequire();
if(isset($_SESSION["user"]));
	$user = $_SESSION["user"];
	$avatar = $user->getAvatar();
echo("
<form method=\"POST\" action=\"/controller/profil/profil.php\" enctype=\"multipart/form-data\" name=\"Avatar\">
<h3 class='Avatar'>Avatar</h3>
<img src=\"$avatar\" height=\"30%\" width=\"30%\" class=\"Avatar\">
		<input type=\"file\" name=\"avatar\" accept=\"image/*\">
		<input type=\"submit\" name=\"envoyer\" value=\"Enregistrer l'avatar\">
</form>");
?>