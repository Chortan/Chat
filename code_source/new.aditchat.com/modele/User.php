<?php
    include($_SERVER["DOCUMENT_ROOT"]."/modele/UserSQL.php");
    
    class User {		
        protected $_id;
		
	protected $_pseudo;
	protected $_birth;
	protected $_sexe;
	protected $_avatar;
	
	
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
	public function __construct($pseudo,$birth,$sexe,$mail,$password) {
        	$this->setID(User::generateID()); 
		$this->setPseudo($pseudo); 
		$this->setPassword($password);
		$this->setMail($mail); 
                $this->setPhoneNumber("");
		$this->setBirth($birth);
		$this->setAvatar("ressources/default/avatar.png");
		$this->setSexe($sexe);
		$this->setCountry("");
		$this->setCity("");
		$this->setInscription(time());
		$this->setConnected(false);
		$this->setLastConnexion(0);
		$this->setLastMessage(0);
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
            $pseudo = str_replace(" ","",$pseudo);
            $this->_pseudo = htmlspecialchars($pseudo);
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
		$this->_connected = $connected;
	}
	
        public function getAge($birth){
            
           return 0;
        }
	
        public function save(){
            $userSQL = new UserSQL($this);
            $userSQL->save();
        }
        
        public static function getUserByID($id){
            return UserSQL::getUserByID($id);
        }
        
        public static function generateID(){
            return UserSQL::generateID();
        }
        
        public function delete(){
            $userSQL = new UserSQL($this);
            $userSQL->delete();
        }
      
    }
?>