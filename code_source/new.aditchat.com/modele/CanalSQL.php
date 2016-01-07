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
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
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
	
    public static function getCanalByUser($user){
            include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
            $req=$bdd->prepare("SELECT * FROM canal WHERE id_canal=:id");
    }
    
    /**
     * Selectionne un Canal a partir d'une liste de User
     * @param type $users Array of User
     */
    public static function getCanalByUsers($users){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
        
        $sql = "SELECT INTO canalUser WHERE ";
        $i=0;
        
        foreach($users as $user){
            if($i != 0) $sql = $sql . "AND ";
            $sql = $sql . "id_user='". strval($user->getID()) ."' ";            
            $i++;
        }
        
        echo($sql . "<br/>");
        $req = $bdd->prepare($sql);
        $req->execute(Array());
        
        if($req->rowCount()>0)
            return $this->setData ($req->fetch());
        else
            return false;
    }
        
    public function save(){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
        
        if($this->exists()){
            echo("Le canal exist !");
        }else{
            echo("Le canal n'exist pas !");
            $this->addUserInCanal();
        }
        
        
        
        /*if(!Canal::getCanalByID($this->_canal->getID())){
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
        
        
        
        $sql = "BEGIN INSERT INTO canalUser (id_canal, id_user) VALUES";
        $i=0;
        foreach ($this->_canal->getAllUsers() as $user){
            $sql = $sql . "(". $this->_canal->getID() .", ". $user->getID() .") ";
            if(isset($this->_canal->getAllUsers()[$i+1])){ $sql = $sql .  ", "; }
            $i++;
        }
        $sql = $sql . "WHERE NOT EXISTS (SELECT * FROM canalUser WHERE ";
        $i=0;
        foreach ($this->_canal->getAllUsers() as $user){
            if(i != 0) $sql += "AND ";
            $sql = $sql . "id_canal=".  $this->_canal->getID() . " AND id_user=". $user->getID() ." ";
        }
        $sql = $sql . ");END";
        
        echo $sql;*/
        
        /*if(count($this->_canal->getAllMessages())>0){
            foreach(Message::getMessageByCanal($canal) as $messageInBDD){
                foreach($this->_canal->getAllMessages() as $messageInCanalObject){
                    if(!$messageInBDD->equals($messageInCanalObject)){
                        $messageInCanalObject->save();
                        $sql = "INSERT INTO canalMessage (id_message,id_canal) VALUES (:idMessage,:idCanal)";// ACONTINUER
                        $req = $bdd->prepare($sql);
                        $req->execute(Array(
                            ":idMessage" => $messageInBDD->getID(),
                            "idCanal"    => $this->_canal->getID()
                        ));
                    }
                }
            }
        }*/
        
        if(count($this->_canal->getAllUsers())>0){
            
        }
			
    }
    
    private function addUserInCanal(){
        $sql = "IF NOT EXISTS (SELECT * FROM canalUser WHERE id_canal=" . $this->_canal->getID() . " ";
        foreach ($this->_canal->getAllUsers() as $user){
            $sql = $sql . "AND id_user=" . $user->getID();
        }
        $sql = $sql . ") INSERT INTO canalUser (id_canal, id_user) VALUES ";
        $i=0;
        foreach ($this->_canal->getAllUsers() as $user){
            $sql = $sql . "(" . $this->_canal->getID().", " . $user->getID() . ") ";
            if(isset($this->_canal->getAllUsers()[$i+1])){
                $sql = $sql . ", ";
            }            
            $i++;
        }
        $sql = $sql . ";";
        
        
        echo $sql;
    }
    
    /**
     * Créer le canal s'il n'existe pas sinon il le met à jour
     */
    private function createCanal(){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
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
    }
    
    /**
     * Verifie si le canal est bien créer et que tous les utilisateurs y sont enregistrés
     * @return boolean
     */
    private function exists(){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
        $sql="SELECT * FROM canalUser WHERE ";
        $i=0;
        foreach ($this->_canal->getAllUsers() as $user){
            if($i != 0) $sql = $sql . "AND ";
            $sql = $sql . "id_user=" . $user->getID() ." ";
            $i++;
        }
        $req = $bdd->prepare($sql);
        $req->execute();
        if($req->rowCount() > 0)
            return true;
        else
            return false;
    }


    public function delete(){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
        $req=$bdd->prepare("DELETE FROM message WHERE id_message=:id");
        $req->execute(Array(":id" => $this->_message->getTransmitter()->getID()));
        return $bdd->errorInfo();
    }
}
