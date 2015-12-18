<?php
class MessageSQL {
    private $_message;
    
    public function __construct($message){
        $this->_message = $message;
    }
    
    protected static function setData($messageFetch){
        $message = new Message(
            $messageFetch["content"],
            User::getUserByID($messageFetch["transmitter"])
        );
        
        $message->setID($messageFetch["id_message"]);
        $message->setIpTransmitter($messageFetch["ipTransmitter"]);
        $message->setDate($messageFetch["date"]);
        $message->wasSent($messageFetch["wasSent"]);
        	
        return $message;
    }
    
    public static function generateID(){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
	$req=$bdd->query("SELECT id_message FROM message WHERE id_message=(SELECT max(id_message) FROM message)");
	if($req->rowCount()==0){
            return 1;
        }else{
            $data=$req->fetch();
            return intval($data["id_message"])+1;
        }                       
    }
    
    public static function getMessageByID($id){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
	$req=$bdd->prepare("SELECT * FROM message WHERE id_message=:id");
	$req->execute(Array(":id"=>$id));
	
        if($req->rowCount()==1){
		$message->setData($req->fetch());
		return $message;
	}else{
		return false;
	}            
    }
    
    /**
     * This function return an array of Message by id order
     * @param type $id - id of user
     * @return Array<Message>
     */
    public static function getMessageByUser($id){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
        $sql = "SELECT * FROM message WHERE transmitter=:id";
        
        $req=$bdd->prepare($sql);
        $req->execute(Array(":id" => $id ));
        $message = Array();
        while($messageData = $req->fetch()){
            $message[] = MessageSQL::setData($messageData);
        }
        return $message;
    }
    
    
    public function save(){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
        $sql="INSERT INTO message VALUES (:id_message,:transmitter,:ipTransmitter,:content,:date,:wasSent)";
	$req=$bdd->prepare($sql);
      
        $array = Array(
            ":id_message" => $this->_message->getID(),
            ":transmitter" => $this->_message->getTransmitter()->getID(),
            ":ipTransmitter" => $this->_message->getIpTransmitter(),
            ":content" => $this->_message->getContent(),
            ":date" => $this->_message->getDate(),
            ":wasSent" => 0
	);
	$req->execute($array);
        
        foreach($array as $key => $val) $sql = str_replace ($key, $val, $sql);
        
        
        echo "message transmit<br/>$sql";
			
    }
    
    public function delete(){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
        $req=$bdd->prepare("DELETE FROM message WHERE id_message=:id");
        $req->execute(Array(":id" => $this->_message->getTransmitter()->getID()));
        return $bdd->errorInfo();
    }
}
