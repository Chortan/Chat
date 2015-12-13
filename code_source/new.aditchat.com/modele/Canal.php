<?php
	
	class Canal{
		protected $_id;
		
		protected $_title;
		
		protected $_users;
		protected $_messages;
		
		public function __construct($id,$title){
			$this->_id=$id;
			$this->_title=$title;
			$this->_nbrUser=0;
			
			$this->_users=array();
			$this->_messages=array();
		}
		
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
		
		public function getTitle(){
			return $this->_title;
		}
		
		public function setTitle($title){
			$this->_title=htmlspecialchars($title);
		}
		
		public function addUser($user){
			$this->_users[$user->getID()]=$user;
		}
		
		public function rmUser($user){
			unset($this->_users[$user->getID()]);
		}
		
		public function addMessage($message){
                    $this->_messages[$id]=$message;
		}

		public function getAllMessages(){
			return $this->_messages;
		}		
		
		public function getUserByID($id){
			return $this->_users[$id];
		}
		
		public function getMessageByID($id){
			return $this->_messages[$id];
		}
		
		public function generateTitle(){
			$size=count($this->_users);
			if($size<=0){
				return false;
			}else{
				$title="";
				foreach($this->_users as $key => $user){
					$title.=$user->getPseudo().", ";
				}
				$title[strlen($title)-1]="";
				$title[strlen($title)-2]="";
				$this->_title=$title;
			}
		}
		
	}
?>