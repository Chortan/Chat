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
                    return MessageSQL::generateID();
		}

		public static function getMessageByID($idMessage){
                    return MessageSQL::getMessageByID($id);
		}
                
                public function save(){
                    $messageSQL = new MessageSQL($this);
                    $messageSQL->save();
                }
	}
?>