<?php
    include($_SERVER["DOCUMENT_ROOT"]."/modele/UserSQL.php");
    
    class User {		
        protected $_id;
		
	protected $_pseudo;
	protected $_birth;
	protected $_sexe;
	protected $_avatar;
	
	protected $_reputation;
	
	protected $_mail;
        protected $_phoneNumber;
	protected $_password;
		
	protected $_country;
	protected $_city;
	
        protected $_isOnline;

        protected $_inscription;
	protected $_lastConnexion;
	protected $_lastMessage;
	
	protected $_connected;
		
	/* ==================== CONSTRUCTEUR ========================== */
	public function __construct($id,$pseudo,$birth,$sexe,$email,$password) {
        	$this->setID($id); 
		$this->setPseudo($pseudo); 
		$this->setBirth($birth);
		$this->setSexe($sexe);
		$this->setEmail($email); 
		$this->setPassword($password);
		$this->setCountry("");
		$this->setCity("");
		$this->setStatut(0);
		$this->setReputation(0);
		$this->setInscriptionDate(time());
		$this->setLastConnexion(0);
		$this->setLastMessage(0);
		$this->setConnected(0);
		$this->setAvatar("ressources/default/avatar.png");
	}
		
	/* ======================= METHODE ============================ */
	
	public function getID(){
		return $this->_id;
	}
	
	public function setID($id){
		if(is_numeric($id)){
			$this->_id=$id;
			return true;
		}else{
			return false;
		}
	}
		
	public function getPseudo(){
		return $this->_pseudo;
	}
	

        public function setPseudo($pseudo){
		$pseudo=str_replace(""," ",$pseudo);
		$this->_pseudo=htmlspecialchars($pseudo);
        }
	
	public function getBirth(){
		return $this->_birth;
	}
	
	public function setBirth($stringBirth){
		$birth = explode("/", $stringBirth);
		
		if(count($birth)!=3){
			return false;
		}else if(intval($birth[0])<=0 AND intval($birth[0])>31){ 
			return false;
		}else if(intval($birth[1])<=0 AND intval($birth[1])>12){
			return false;
		}else if(intval($birth[2]) > date("Y") AND intval($birth[2]) > 1900){
			return false;
		}else{
			$this->_birth=$stringBirth;
		}
	}
	
	public function getSexe(){
		return $this->_sexe;
	}
	
	public function setSexe($sexe){
		if($sexe == 'H' OR $sexe == 'F'){
			$this->_sexe=htmlspecialchars($sexe);
			return true;
		}else{
			return false;
		}
	}
	
	public function getAvatar(){
		return $this->_avatar;
	}
	
	public function setAvatar($avatar){
		$this->_avatar=$avatar;
	}
			
	public function getMail(){
		return $this->_mail;
	}
	
	public function setMail($email){
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$this->_mail=$email;
			return true;
		}else{
			return false;
		}			
	}
	
	public function getPassword(){
		return $this->_password;
	}
	
	public function setPassword($password){
		$this->_password = sha1($password);
	}

        function getPhoneNumber() {
            return $this->_phoneNumber;
        }


        function setPhoneNumber($_phoneNumber) {
            $this->_phoneNumber = $_phoneNumber;
        }
        
        function getIsOnline() {
            return $this->_isOnline;
        }

        function getInscription() {
            return $this->_inscription;
        }

        function setIsOnline($_isOnline) {
            $this->_isOnline = $_isOnline;
        }

        function setInscription($_inscription) {
            $this->_inscription = $_inscription;
        }
        	
	public function getCountry(){
		return $this->_country;
	}
	
	public function setCountry($country){
		$this->_country=htmlspecialchars($country);
        }
	
	public function getCity(){
		return $this->_city;
	}
	
	public function setCity($city){
		$this->_city=htmlspecialchars($city);
	}

	public function getLastConnexion(){
		return $this->_lastConnexion;
	}
	
	public function setLastConnexion($lastConnexion){
		$this->_lastConnexion=$lastConnexion;
	}
	
	public function getLastMessage(){
		return $this->_lastMessage;
	}
	
	public function setLastMessage($lastMessage){
		$this->_lastMessage=$lastMessage;
	}
		
	public function isOnline(){
		return $this->_connected;
	}
	
	public function setConnected($connected){
		$this->_connected=$connected;
	}
	
        public function getAge($birth){
            
            $birth = explode("/", $birth);		
            if(count($birth)!=3){
    		$_SESSION["erreur"][]="La date doit être au format 01/12/2000.";
            }else if(intval($birth[0])<=0 AND intval($birth[0])>31){ 
		$_SESSION["erreur"][]="La date doit être au format 01/12/2000.";
		
            }else if(intval($birth[1])<=0 AND intval($birth[1])>12){
		$_SESSION["erreur"][]="La date doit être au format 01/12/2000.";
			
            }else if(intval($birth[2]) > date("Y") AND intval($birth[2]) > 1900){
		$_SESSION["erreur"][]="La date de naissance doit etre inférieur à la date d'aujourd'hui (accéssoirement).";
			
            }else{
		$today=date("d/m/Y");
		$todayExplode=explode("/",$today);
		
		$age=intval($todayExplode[2])-intval($birth[2]);
		
                $this->setAge($age);
            }		
        }
	
        public function save(){
            $userSQL = new UserSQL($this->_user);
            $userSQL->save();
        }
        
        public static function getUserByID($id){
            return UserSQL::getUserByID($id);
        }
        
        public function delete(){
            $userSQL = new UserSQL($this->_user);
            $userSQL->delete();
        }
      
    }
?>