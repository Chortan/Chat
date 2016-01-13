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
        
        if(($idCanal = $this->exists()) == false){
            $this->createCanal();
            $this->addUserInCanal();
        }else{
            $this->_canal = Canal::getCanalByID($idCanal);
            $this->_canal->addMessage();
        }      
			
    }
    
    private function addUserInCanal(){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
        $sql= "INSERT IGNORE INTO canalUser VALUES ";
        $i=0;
        foreach($this->_canal->getAllUsers() as $user){
            $sql = $sql . "(" . $this->_canal->getID() . ", " . $user->getID() . ")";
            $i++;
            if(isset($this->_canal->getAllUsers()[$i])) $sql = $sql . ", "; 
        }        
        echo $sql;
        $req = $bdd->prepare($sql);
        $req->execute(Array());
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
        $sql="SELECT * FROM canalUser WHERE id_canal IN ( "
                . "SELECT id_canal FROM canalUser WHERE ";
        $i=0;
        foreach ($this->_canal->getAllUsers() as $user){
            if($i != 0) $sql = $sql . "OR ";
            $sql = $sql . "id_user=" . $user->getID() ." ";
            $i++;
        }
        $sql = $sql . ")";
        $req = $bdd->prepare($sql);
        $req->execute();
                        
        while($dataFetch = $req->fetch()){
            $idCanal = $dataFetch["id_canal"];
            $idUser = $dataFetch["id_user"];
            $buffer[$idCanal][] = $idUser;
        }
        echo("<br/>");
        foreach($buffer as $idCanal => $idUser){            
            if(count($idUser) == count($this->_canal->getAllUsers())){
                return $idCanal;                
            }                
        }        
        return false;
    }


    public function delete(){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
        $req=$bdd->prepare("DELETE FROM message WHERE id_message=:id");
        $req->execute(Array(":id" => $this->_message->getTransmitter()->getID()));
        return $bdd->errorInfo();
    }
    
    /**
     * Savoir un un utilisateurs données est dans le canal ou pas (a partir de la BDD) 
     * @param type $user L'utilisateur a qui on veut savoir s'il est dans le canal
     * @return boolean 
     */
    public function isInCanal($user){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
        $req = $bdd->prepare("SELECT * FROM canalUser WHERE id_user=:id_user AND id_canal=:id_canal");
        $req->execute(Array(":id_canal" => $this->_canal->getID(), ":id_user" => $user->getID() ));
        if($req->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }
    
    public function addMessage($message){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
        $req = $bdd->prepare("INSERT INTO canalMessage VALUES (:id_canal, :id_message)");
        $req->execute(Array(
            ":id_canal" => $this->_canal->getID(), 
            ":id_message" => $message->getID()
        ));
    }
}
