<?php
include($_SERVER["DOCUMENT_ROOT"]."/modele/bdd/connect.php");
include($_SERVER["DOCUMENT_ROOT"]."/modele/User.php");
class UserSQL {
    private $_user;
    
    public function __construct($user){
        $this->_user = $user;
    
           $this->_user = new User(0,"","",'',"","")    ;    
    }
    
    private static function setData($userFetch){
        $user = new User(
            $userFetch["id_user"],
            $userFetch["pseudo"],
            $userFetch["birth"],
            $userFetch["sexe"],
            $userFetch["mail"],
            $userFetch["password"]
        );
        
        $user->setAge($userFetch["age"]);
        $user->setAvatar($userFetch["avatar"]);
        $user->setCountry($userFetch["country"]);
        $user->setCity($userFetch["city"]);
        $user->setInscription($userFetch["inscription"]);
        $user->setLastMessage($userFetch["lastMessage"]);
        	
        return $user;
    }
    
    private static function generateID(){
	include($_SERVER["DOCUMENT_ROOT"]."/scripts/bdd/connect.php");
	$req=$bdd->query("SELECT id_user FROM user WHERE id_user=(SELECT max(id_user) FROM user)");
	if($req->rowCount()==0){
            return 1;
        }else{
            $data=$req->fetch();
            return intval($data["id_user"])+1;
        }                       
    }
    
    public static function getUserByID($id){
	include($_SERVER["DOCUMENT_ROOT"]."/scripts/bdd/connect.php");
	$req=$bdd->prepare("SELECT * FROM user WHERE id_user=:id");
	$req->execute(Array(":id"=>$id));
	
        if($req->rowCount()==1){
		$user->setData($req->fetch());
		return $user;
	}else{
		return false;
	}            
    }
    
    public function save(){
        if(!User::getUserByID($this->_id)){
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
		lastConnexion=:lastConnexion, 
		lastMessage=:lastMessage";
	}   
	$req=$bdd->prepare($sql);
	$req->execute(Array(
		":id_user" => $this->_user->getID(),
		":pseudo" => $this->_user->getPseudo(),
		":password" => $this->_user->getPassword(),
		":mail" => $this->_user->getMail(),
                ":phoneNumber" => $this->_user->getPhoneNumber(),
		":birth" => $this->_user->getBirth(),
		":avatar" => $this->_user->getAvatar(),
		":sexe" => $this->_user->getSexe(),
		":country" => $this->_user->getSexe(),
		":city" => $this->_user->getCity(),
		":inscription" => $this->_user->getInscription(),
                ":isOnline" => $this->_user->getIsOnline(),
		":lastMessage" => $this->_user->getLastMessage(),
		":lastConnexion" => $this->_user->getLastConnexion()
	));
	return $bdd->errorInfo();
    }
    
    public function delete(){
        $req=$bdd->prepare("DELETE FROM user WHERE id_user=:id");
        $req->execute(Array(":id" => $this->_user->getID()));
        return $bdd->errorInfo();
    }
}
