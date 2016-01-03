<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CanalSQL
 *
 * @author root
 */
class CanalSQL {
    private $_canal;
    
    public function __construct($canal){
        $this->_canal = $canal;
    }
    
    private static function setData($canalFetch){
        $canal = new Canal(
            $canalFetch["name"],
            User::getUserByID($canalFetch["creator"])
        );
        $canal->setID($canalFetch["id_canal"]);
        $canal->setName($canalFetch["name"]);
        $canal->setDateCreated($canalFetch["dateCreated"]);
        	
        return $canal;
    }
    
    public static function generateID(){
        include($_SERVER["DOCUMENT_ROOT"]."modele/bdd/connect.php");
	$req=$bdd->prepare("SELECT id_canal FROM canal WHERE id_canal=(SELECT max(id_canal) FROM canal)");
	$req->execute();
        if($req){
            if($req->rowCount()>0){
                $data=$req->fetch();
                return intval($data["id_canal"])+1;
            }else{
                return 1;
                echo("Non reowCount = 0");
            }
        }else{
            echo("Non");
            return 1;
        }
            
                                   
    }
    
    public static function getCanalByID($id){
        include($_SERVER["DOCUMENT_ROOT"]."modele/bdd/connect.php");
	$req=$bdd->prepare("SELECT * FROM canal WHERE id_canal=:id");
	$req->execute(Array(":id"=>$id));
	
        if($req->rowCount()==1){
		$canal = CanalSQL::setData($req->fetch());
		return $canal;
	}else{
		return false;
	}            
    }
        
    public function save(){
        include($_SERVER["DOCUMENT_ROOT"]."modele/bdd/connect.php");
        if(!Canal::getCanalByID($this->_canal->getID())){
           $sql="INSERT INTO canal VALUES (:id_canal,:name,:dateCreated,:creator)"; 
        }else{
            $sql="UPDATE canal SET 
                id_canal=:id_canal,
                name=:name,
                dateCreated=:dateCreated,
                creator=:creator";
        }
        
	$req=$bdd->prepare($sql);
      
        $array = Array(
            ":id_canal" => $this->_canal->getID(),
            ":name" => $this->_canal->getName(),
            ":dateCreated" => $this->_canal->getDateCreated(),
            ":creator" => $this->_canal->getCreator()->getID()
	);
	$req->execute($array);
        foreach($array as $key => $value)
            $sql = str_replace($key, $value, $sql);
        
        
        if(count($this->_canal->getAllMessages())>0){
            foreach(Message::getMessageByCanal($canal) as $messageInBDD){
                foreach($this->_canal->getAllMessages() as $messageInCanalObject){
                    if(!$messageInBDD->equals($messageInCanalObject)){
                        $messageInCanalObject->save();
                        $sql = "INSERT INTO CanalMessage (id_message,id_canal) VALUES (:idMessage,:idCanal)";// ACONTINUER
                        $req = $bdd->prepare($sql);
                        $req->execute(Array(
                            ":idMessage" => $messageInBDD->getID(),
                            "idCanal"    => $this->_canal->getID()
                        ));
                    }
                }
            }
        }
        
        if(count($this->_canal->getAllUsers())>0){
            
        }
			
    }
    
    public function delete(){
        include($_SERVER["DOCUMENT_ROOT"]."modele/bdd/connect.php");
        $req=$bdd->prepare("DELETE FROM message WHERE id_message=:id");
        $req->execute(Array(":id" => $this->_message->getTransmitter()->getID()));
        return $bdd->errorInfo();
    }
}
