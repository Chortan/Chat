<?php
	class Message{
		protected $_id;
		protected $_user;
		protected $_dateSended;
		protected $_message;
		protected $_ip;
		
		/* =================== CONSTRUCTOR =================== */

		public function __construct($message,$user){
			$this->setID(Message::generateID());
			$this->setUser($user);
			$this->setMessage($message);
			$this->setDateSended(time());
			$this->setIP();
		}

		/* =================== GETER and SETER =================== */
		
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
		
		public function getUser(){
			return $this->_user;
		}
		
		public function setUser($user){
			$this->_user=$user;
		}
		
		public function getDateSended(){
			return $this->_dateSended;
		}
		
		public function setDateSended($dateSended){
			$this->_dateSended=$dateSended;
		}
		
		public function getMessage(){
			return $this->_message;
		}
		
		public function setMessage($message){
			$this->_message=htmlspecialchars($message);
		}

		public function setIP(){
			$this->_ip=$_SERVER["REMOTE_ADDR"];
		}

		public function getIP(){
			return $this->_ip;
		}
		
		/* =================== SAVE AND GET in DATA BASE =================== */

		public static function generateID(){
			include($_SERVER["DOCUMENT_ROOT"]."/scripts/bdd/connect.php");
			$req=$bdd->query("SELECT idMessage FROM message WHERE idMessage=(SELECT max(idMessage) FROM message)");
			$data=$req->fetch();
			return intval($data["idMessage"])+1;
		}

		public function save(){
			include($_SERVER["DOCUMENT_ROOT"]."/scripts/bdd/connect.php");
			$req=$bdd->prepare("INSERT INTO message VALUES (:idMessage,:message,:ip,:dateSended,:idUser)");
			$req->execute(Array(
				":idMessage" => $this->getID(),
				":message" => $this->getMessage(),
				":dateSended" => $this->getDateSended(),
				":idUser" => $this->getUser()->getID(),
				":ip" => $this->getIP()
			));
			
			$req->debugDumpParams();
		}

		protected function setData($messageFetch){
			$this->_id=$messageFetch["idMessage"];
			$this->_message=$messageFetch["message"];
			$this->_dateSended=$messageFetch["date"];
			$this->_ip=$messageFetch["ip"];
			$this->_user=User::getUserByID($messageFetch["idUser"]);			
		}

		public static function getMessageByID($idMessage){
			include($_SERVER["DOCUMENT_ROOT"]."/scripts/bdd/connect.php");
			$req=$bdd->prepare("SELECT * FROM message WHERE idMessage=:idMessage");
			$req->execute(Array(":idMessage"=>$idMessage));
			$message=new Message(null,'');
			if($req->rowCount()==1){
				$message->setData($req->fetch());
				return $message;
			}else{
				return false;				
			}
		}
	}
?>