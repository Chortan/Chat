<?php


class UserSQL {
    private $_user;
    
    public function __construct($user){
        $this->_user = $user;   
    }
    
    private static function setData($userFetch){
        $user = new User(
            $userFetch["pseudo"],
            $userFetch["birth"],
            $userFetch["sexe"],
            $userFetch["mail"],
            $userFetch["password"]
        );
        
        $user->setID($userFetch["id_user"]);
        $user->setAvatar($userFetch["avatar"]);
        $user->setCountry($userFetch["country"]);
        $user->setCity($userFetch["city"]);
        $user->setInscription($userFetch["inscription"]);
        $user->setLastMessage($userFetch["lastMessage"]);
        
        return $user;
    }
    
    public static function generateID(){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
	$req=$bdd->prepare("SELECT id_user FROM user WHERE id_user=(SELECT max(id_user) FROM user)");
	$req->execute();
        if($req->rowCount()==0){
            return 0;
        }else{
            $data=$req->fetch();
            return intval($data["id_user"])+1;
        }                       
    }
    
    public static function getUserByID($id){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
	$req=$bdd->prepare("SELECT * FROM user WHERE id_user=:id");
	$req->execute(Array(":id"=>$id));
	
        if($req->rowCount()==1){
		return UserSQL::setData($req->fetch());
	}else{
		return false;
	}            
    }
    
    public static function getUserByPseudo($pseudo){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
	$req = $bdd->prepare("SELECT * FROM user WHERE pseudo=:pseudo");
	$req->execute(Array(":pseudo"=>$pseudo));
	
        if($req->rowCount()==1){
		return UserSQL::setData($req->fetch());
	}else{
		return false;
	}        
    }
    
    public static function getAllUsers(){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
	$req = $bdd->prepare("SELECT * FROM user");
	$req->execute(Array());
	
        while($userFetch = $req->fetch()){
		$users[] = UserSQL::setData($userFetch);
	}
        
        return $users;
    }
    
    public static function getUserByMail($mail){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
	$req=$bdd->prepare("SELECT * FROM user WHERE mail=:mail");
	$req->execute(Array(":mail"=>$mail));
	
        if($req->rowCount()==1){
		return UserSQL::setData($req->fetch());
	}else{
		return false;
	}        
    }
    
    public static function getUserByPhoneNumber($phoneNumber){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
	$req=$bdd->prepare("SELECT * FROM user WHERE phoneNumber=:phoneNumber");
	$req->execute(Array(":phoneNumber"=>$phoneNumber));
	
        if($req->rowCount()==1){
		return UserSQL::setData($req->fetch());
	}else{
		return false;
	}        
    }
    
    public static function getUserByCanal($user){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
        $sql = "SELECT * FROM user WHERE id_user IN (SELECT id_user FROM canalUser WHERE id_user=:id)";
        $req = $bdd->prepare($sql);
        $req->execute(Array(":id" => $user->getID()));
        while($userFetch = $req->fetch()){
            $users[] = MessageSQL::setData($userFetch);            
        }
        return $users;
        
    }

    public function save(){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
        if(!UserSQL::getUserByID($this->_user->getID())){
            $sql="INSERT INTO user VALUES (:id_user,:pseudo,:password,:mail,:phoneNumber,:birth,:avatar,:sexe,:country,:city,:inscription,:isOnline,:lastMessage,:lastConnexion)";
	}else{
            $sql="UPDATE user SET 
		id_user=:id_user, 
		pseudo=:pseudo,
		password=:password, 
		mail=:mail,
                phoneNumber=:phoneNumber,
		birth=:birth, 
		avatar=:avatar,
		sexe=:sexe,   
		country=:country,
		city=:city, 
		inscription=:inscription,
                isOnline=:isOnline, 
		lastMessage=:lastMessage,
		lastConnexion=:lastConnexion";
	}   
	$req=$bdd->prepare($sql);
	$array = Array(
		":id_user" => $this->_user->getID(),
		":pseudo" => $this->_user->getPseudo(),
		":password" => $this->_user->getPassword(),
		":mail" => $this->_user->getMail(),
                ":phoneNumber" => $this->_user->getPhoneNumber(),
		":birth" => $this->_user->getBirth(),
		":avatar" => $this->_user->getAvatar(),
		":sexe" => $this->_user->getSexe(),
		":country" => $this->_user->getCountry(),
		":city" => $this->_user->getCity(),
		":inscription" => $this->_user->getInscription(),
                ":isOnline" => $this->_user->isOnline(),
		":lastMessage" => $this->_user->getLastMessage(),
		":lastConnexion" => $this->_user->getLastConnexion()
	);
        $req->execute($array);
        print "<pre>";
        foreach ($array as $id => $table){
            $sql = str_replace($id, "'$table'", $sql);
        }
        print_r($sql."<br/>");
        print_r($bdd->errorInfo());
        print "</pre>";
        
    }
    
    public function delete(){
        include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
        $req=$bdd->prepare("DELETE FROM user WHERE id_user=:id");
        $req->execute(Array(":id" => $this->_user->getID()));
        return $bdd->errorInfo();
    }
}


?>