<?php
	        
        authentificationRequire();
        
        $canalTest = new Canal("Test",$_SESSION["user"]);
        $canalTest->addUser($_SESSION["user"]);
        echo("canal créer<br/>");
        $canalTest->save();
        echo("Canal Sauvegardé<br/>");
?>

