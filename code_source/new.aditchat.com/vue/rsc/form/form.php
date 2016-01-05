<?php
	class Form{
		private $_name;
		private $_id;
		private $_class;
		private $_method;
		private $_action;
		private $_enctype;
		private $_title;
		
		private $_elements;
		
		public function __construct($name){
			$this->_name=$name;
			$this->_id=$name;
			$this->_title=$name;
			$this->_elements=array();
		}
		
		public function getName(){
			return $this->_name;
		}
		
		public function setName($name){
			$this->_name=$name;
		}
		
		public function getID(){
			return $this->_id;
		}
		
		public function setID($id){
			$this->_id=$id;
		}
		
		public function getClass(){
			return $this->_class;
		}
		
		public function setClass($class){
			$this->_class=$class;
		}
		
		public function getMethod(){
			return $this->_method;
		}
		
		public function setMethod($method){
			$this->_method=$method;
		}
		
		public function getAction(){
			return $this->_action;
		}
		
		public function setAction($action){
			$this->_action=$action;
		}
		
		public function getEnctype(){
			return $this->_enctype;
		}
		
		public function setEctype($enctype){
			$this->_enctype=$enctype;
		}
		
		public function getTitle(){
			return $this->_title;
		}
		
		public function setTitle($title){
			$this->_title=htmlspecialchars($title);
		}
		
		public function getAllElements(){
			return $this->_elements;
		}
		
		public function addElement($element){
			$this->_elements[]=$element;
		}
		
		public function rmElementByID($id){
			return $this->_elements[$id];
		}
		
		public function getElementByID($id){
			return $this->_elements[$id];
		}
		
		public function submit($textSubmit){
			$submit=new Element("send","Envoyer");
			$submit->setLabel("");
			$submit->setValue($textSubmit);
			$submit->setTypeElement("submit");
			$submit->setClass("btn btn-primary");
			$this->addElement($submit);
		}
		
		/* === other METHODE === */
		
		public function render(){
			$render="<form".
				" id='".$this->_id ."'".
				" class='".$this->_class ."'".
				" method='".$this->_method ."'".
				" action='".$this->_action ."'".
				" id='".$this->_enctype ."'".
				">"."<h3 class='form'>".$this->_title ."</h3>";
				
			foreach($this->_elements as $key => $element){
				$render.=$element->render();
			}
			$render.="</form>";
			
			return $render;
		}
	}
?>