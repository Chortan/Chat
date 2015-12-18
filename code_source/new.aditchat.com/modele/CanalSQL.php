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
        $canal = new Message(
            $canalFetch["name"],
            User::getUserByID($canalFetch["creator"])
        );
        $canal->setID($canalFetch["id_canal"]);
        $canal->setName($canalFetch["dateCreated"]);
        	
        return $canal;
    }
    
    public static function generateID(){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
	$req=$bdd->query("SELECT id_message FROM canal WHERE id_canal=(SELECT max(id_canal) FROM canal)");
	if($req){
            if($req->rowCount()>0){
                $data=$req->fetch();
                return intval($data["id_canal"])+1;
            }else{
                return 1;            
            }
        }else
            return 1;
                                   
    }
    
    public static function getCanalByID($id){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
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
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
        $sql="INSERT INTO canal VALUES (:id_canal,:name,:dateCreated,:creator)";
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
        echo "Canal saved<br/>$sql";
			
    }
    
    public function delete(){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
        $req=$bdd->prepare("DELETE FROM message WHERE id_message=:id");
        $req->execute(Array(":id" => $this->_message->getTransmitter()->getID()));
        return $bdd->errorInfo();
    }
}
