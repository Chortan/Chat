<?php
    
    authentificationRequire();	
   
    $canal = Canal::getCanalByID($_GET["id"]);
    if($canal){    
        foreach(Message::getMessageByCanal($canal) as $id => $message){
            echo($message->getTransmitter()->getPseudo()." : ".$message->getContent()."<br/>");
        }
    }
?>

<form action="/controller/message/send.php" method="POST">
    <input type="hidden" name="id_canal" value="<?php echo($_GET["id"]); ?>"/>
    <input type="text" name="message" placeholder="Message ..."/>
    <input type="submit"/>
</form>