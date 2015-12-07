<?php
	class User {
		
		protected $_id;
		
		protected $_pseudo;
		protected $_birth;
		protected $_sexe;
		protected $_avatar;
		
		protected $_administrator;
		protected $_reputation;
		
		protected $_mail;
                protected $_phoneNumber;
		protected $_password;
		
		protected $_country;
		protected $_state;
		protected $_city;
		
		protected $_inscriptionDate;
		protected $_lastConnexion;
		protected $_lastDownloadMessage;
		protected $_lastUploadMessage;
		
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
			$this->setState("");
			$this->setCity("");
			$this->setStatut(0);
			$this->setReputation(0);
			$this->setInscriptionDate(time());
			$this->setLastConnexion(0);
			$this->setLastDownloadMessage(0);
			$this->setLastUploadMessage(0);
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
		
		public function getAge(){
			return $this->_age;
		}
		
		public function setAge($age){
			if(is_numeric($age)){
				$this->_age=$age;
				return true;
			}else{
				return false;
			}
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
		
		public function getStatut(){
			return $this->_administrator;
		}
		
		public function setStatut($statut){
			$this->_administrator=$statut;
		}
				
		public function getReputation(){
			return $this->_reputation;
		}
		
		public function setReputation($reputation){
			$this->_reputation=$reputation;
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
		
		public function getCountry(){
			return $this->_country;
		}
		
		public function setCountry($country){
			$this->_country=htmlspecialchars($country);
		}
		
		public function getState(){
			return $this->_state;
		}
		
		public function setState($state){
			$this->_state=htmlspecialchars($state);
		}
		
		public function getCity(){
			return $this->_city;
		}
		
		public function setCity($city){
			$this->_city=htmlspecialchars($city);
		}
		
		public function getInscriptionDate(){
			return $this->_inscriptionDate;
		}

		public function setInscriptionDate($inscriptionDate){
			$this->_inscriptionDate=$inscriptionDate;
		}

		public function getLastConnexion(){
			return $this->_lastConnexion;
		}
		
		public function setLastConnexion($lastConnexion){
			$this->_lastConnexion=$lastConnexion;
		}
		
		public function getLastDownloadMessage(){
			return $this->_lastDownloadMessage;
		}
		
		public function setLastDownloadMessage($lastDownloadMessage){
			$this->_lastDownloadMessage=$lastDownloadMessage;
		}
		
		public function getLastUploadMessage(){
			return $this->_lastUploadMessage;
		}
		
		public function setLastUploadMessage($lastUploadMessage){
			$this->_lastUploadMessage=$lastUploadMessage;
		}
		
		public function isOnline(){
			return $this->_connected;
		}
		
		public function setConnected($connected){
			$this->_connected=$connected;
		}
		
		public function updateAge($birth){
						
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
		
		protected function setData($userFetch){
			$this->_id=$userFetch["idUser"];
			$this->_pseudo=$userFetch["pseudo"];
			$this->_age=$userFetch["age"];
			$this->_birth=$userFetch["birth"];
			$this->_sexe=$userFetch["sexe"];
			$this->_avatar=$userFetch["avatar"];
			$this->_administrator=$userFetch["statut"];
			$this->_reputation=$userFetch["reputation"];
			$this->_mail=$userFetch["email"];
			$this->_password=$userFetch["password"];
			$this->_country=$userFetch["country"];
			$this->_state=$userFetch["state"];
			$this->_city=$userFetch["city"];
			$this->_inscriptionDate=$userFetch["inscriptionDate"];
			$this->_lastConnexion=$userFetch["lastConnexion"];
			$this->_lastDownloadMessage=$userFetch["lastDownloadMessage"];
			$this->_lastUploadMessage=$userFetch["lastUploadMessage"];
			return $this;
		}
		
		public function save(){
			include($_SERVER["DOCUMENT_ROOT"]."/scripts/bdd/connect.php");
			
			if(!User::getUserByID($this->_id)){
				$sql="INSERT INTO user VALUES	(:idUser,:pseudo,:mail,:password,:sexe,:phoneNumber,:birth,:avatar,:statut,:reputation,:password,:country,:state,:city,:inscriptionDate,:lastConnexion,:lastDownloadMessage,:lastUploadMessage)";
			}else{
				$sql="UPDATE user SET 
					idUser=:idUser, 
					pseudo=:pseudo, 
					age=:age, 
					birth=:birth, 
					sexe=:sexe, 
					avatar=:avatar, 
					statut=:statut, 
					reputation=:reputation, 
					email=:email, 
					password=:password, 
					country=:country, 
					state=:state, 
					city=:city, 
					inscriptionDate=:inscriptionDate, 
					lastConnexion=:lastConnexion, 
					lastUploadMessage=:lastUploadMessage";
			}

			$req=$bdd->prepare($sql);
			$req->execute(Array(
				":idUser" => $this->_id,
				":pseudo" => $this->_pseudo,
				":age" => $this->_age,
				":birth" => $this->_birth,
				":sexe" => $this->_sexe,
				":avatar" => $this->_avatar,
				":statut" => $this->_administrator,
				":reputation" => $this->_reputation,
				":email" => $this->_mail,
				":password" => $this->_password,
				":country" => $this->_country,
				":state" => $this->_state,
				":city" => $this->_city,
				":inscriptionDate" => $this->_inscriptionDate,
				":lastConnexion" => $this->_lastConnexion,
				":lastDownloadMessage" => $this->_lastDownloadMessage,
				":lastUploadMessage" => $this->_lastUploadMessage
			));
			return $bdd->errorInfo();
		}
		
		
		public static function getUserByID($id){
			include($_SERVER["DOCUMENT_ROOT"]."/scripts/bdd/connect.php");
			$req=$bdd->prepare("SELECT * FROM user WHERE idUser=:id");
			$req->execute(Array(":id"=>$id));
			$user=new User(0,'','','','','');
			if($req->rowCount()==1){
				$user->setData($req->fetch());
				return $user;
			}else{
				return false;				
			}
		}
		
		public static function generateID(){
			include($_SERVER["DOCUMENT_ROOT"]."/scripts/bdd/connect.php");
			$req=$bdd->query("SELECT idUser FROM User WHERE idUser=(SELECT max(idUser) FROM User)");
			if($req->rowCount()==0){
                            return 1;
                        }else{
                            $data=$req->fetch();
                            return intval($data["idUser"])+1;
                        }
                        
		}
		
	}
?>