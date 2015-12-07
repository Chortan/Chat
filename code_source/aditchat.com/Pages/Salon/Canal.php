<?php
	
	if(isset($_SESSION["user"])){
		
	
	
	$meTMP=new User(1,"jordanroi3",19,'H',"jordanroi3@gmail.com","toto");
	
	
	$me=$_SESSION["user"];  
	
	$canal=new Canal(1,"Canal 1");
	
	$you1 	= new User(1,"axiome",20,'F',"svalentak@gmail.com","toto");
	
	$canal->addUser($me);
	$canal->addUser($you1);
	
	for($i=1;$message=Message::getMessageByID($i);$i++){
		$canal->addMessage($message);
	}
	
	echo("<input id='userName' type='hidden' value='". $me->getPseudo() ."'/>");
	
?>



<?php
	if(count($_POST)>0){
		if(!isset($_POST["message"])) $_SESSION["erreur"][402]="Vous n'avez pas renseigner les information nécessaire dans le formulaire.";
		else{
			$message=new Message($_POST["message"],$_SESSION["user"]);
			
			var_dump($message);
			var_dump($message->getUser());
			$message->save();



		}
	}
?>

<script src="/Pages/Salon/scripts/messageSender.js"></script>

<section class="messages">
	<h2><?php 
		$canal->generateTitle(); 
		echo($canal->getTitle()) 
	?></h2>
	<section class="displayMessages">
		<?php
			foreach($canal->getAllMessages() as $key => $message){
				if($message->getUser()==$me){
					echo("<div class='you'><p>");
				}else{
					echo("<div class='other'><p>");
				}
				echo("<span class='userName'>".$message->getUser()->getPseudo()." : </span>");
				echo($message->getMessage());				
				echo("</p></div>");
			}
			
		?>	
	</section>
</section>

<div class="messageSender">
	<input type="text" name="message" class="messageSender"/>
	<input type="button" name="sendMessage" class="messageSender"/>
</div>

<?php
	}else {
		$_SESSION["erreur"][401]="Vous devez être authentifié pour accéder au services. Cliquez-<a class='button' href='/Portail'>ici</a>";
		header("Location: /Erreur");
	}
	
?>