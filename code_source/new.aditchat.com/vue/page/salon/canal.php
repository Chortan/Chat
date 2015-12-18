<?php
    
    authentificationRequire();	
    
    $message = Message::getMessageByUser($_SESSION["user"]->getID());
    
    foreach($message as $id => $message){
        echo($message->getTransmitter()->getPseudo()." : ".$message->getContent()."<br/>");
    }
?>

<form action="/controller/message/send.php" method="POST">
    <input type="text" name="message" placeholder="Message ..."/>
    <input type="submit"/>
</form>