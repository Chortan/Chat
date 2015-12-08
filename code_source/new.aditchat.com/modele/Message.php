<?php
	class Message{
		protected $_id;
		protected $_transmitter;
                protected $_ipTransmitter;
		protected $_content;
		protected $_date;
		protected $_wasSent;
		
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
		
		function getTransmitter() {
                    return $this->_transmitter;
                }

                function getIpTransmitter() {
                    return $this->_ipTransmitter;
                }

                function getContent() {
                    return $this->_content;
                }

                function getDate() {
                    return $this->_date;
                }

                function getWasSent() {
                    return $this->_wasSent;
                }

                function setTransmitter($_transmitter) {
                    $this->_transmitter = $_transmitter;
                }

                function setIpTransmitter($_ipTransmitter) {
                    $this->_ipTransmitter = $_ipTransmitter;
                }

                function setContent($_content) {
                    $this->_content = $_content;
                }

                function setDate($_date) {
                    $this->_date = $_date;
                }

                function setWasSent($_wasSent) {
                    $this->_wasSent = $_wasSent;
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