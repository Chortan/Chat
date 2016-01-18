<?php
authentificationRequire();
if(isset($_SESSION["user"]));
	$user = $_SESSION["user"];
	$avatar = $user->getAvatar();
echo("
<form method=\"POST\" action=\"/controller/profil/profil.php\" enctype=\"multipart/form-data\" name=\"Avatar\">
	<h3 class='Avatar'>Avatar</h3>
	<div id=\"avatar\">
		<img src=\"$avatar\" height=\"25%\" width=\"25%\" class=\"Avatar\">
	</div>
	<fieldset class='form-group'>
		<div class=\"btn-toolbar\" role=\"toolbar\" aria-label=\"...\">
			<div class=\"btn-group\" role=\"group\" aria-label=\"...\">
				<input id=\"selection\" type=\"file\" name=\"avatar\" accept=\"image/*\" style=\"display: none;\">
				<button type=\"button\" class=\"btn btn-primary\" onclick=\"document.getElementById('selection').click();\">Importer une image</button>
			</div>
			<div class=\"btn-group\" role=\"group\" aria-label=\"...\">
				<input id=\"envoie\" type=\"submit\" name=\"envoyer\" style=\"display: none;\">
				<button type=\"button\" class=\"btn btn-primary\" onclick=\"document.getElementById('envoie').click();\">Enregistrer l'avatar</button>
			</div>
		</div>
	</fieldset>
</form>");
?>