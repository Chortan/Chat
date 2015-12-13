<?php

class MessageSQL {
    private $_message;
    
    public function __construct($message){
        $this->_message = $message;
    
           $this->_message = new Message("",$user);    
    }
    
    private static function setData($messageFetch){
        $message = new Message(
            $messageFetch["content"],
            $messageFetch["transmitter"]
        );
        
        $message->setID($userFetch["id_message"]);
        $message->setIpTransmitter($userFetch["ipTransmitter"]);
        $message->setDate($userFetch["date"]);
        $message->setWasSent($userFetch["wasSent"]);
        	
        return $message;
    }
    
    public static function generateID(){
	$req=$bdd->query("SELECT id_message FROM message WHERE id_message=(SELECT max(id_message) FROM message)");
	if($req->rowCount()==0){
            return 1;
        }else{
            $data=$req->fetch();
            return intval($data["id_message"])+1;
        }                       
    }
    
    public static function getMessageByID($id){
	$req=$bdd->prepare("SELECT * FROM message WHERE id_message=:id");
	$req->execute(Array(":id"=>$id));
	
        if($req->rowCount()==1){
		$message->setData($req->fetch());
		return $message;
	}else{
		return false;
	}            
    }
    
    
    public function save(){
	$req=$bdd->prepare("INSERT INTO message VALUES (:id_message,:transmitter,:ipTransmitter,:content,:date,:wasSent)");
	$req->execute(Array(
            ":id_message" => $this->_message->getID(),
            ":transmitter" => $this->_message->getTransmitter()->getID(),
            ":ipTransmitter" => $this->getIpTransmitter(),
            ":content" => $this->_message->getContent(),
            ":date" => $this->_message->getDate(),
            ":wasSent" => $this->_message->getWasSent()
	));
			
	$req->debugDumpParams();
    }
    
    public function delete(){
        $req=$bdd->prepare("DELETE FROM message WHERE id_message=:id");
        $req->execute(Array(":id" => $this->_message->getTransmitter()->getID()));
        return $bdd->errorInfo();
    }
}
