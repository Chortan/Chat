<?php
	class Element{
		private $_element;
		private $_typeElement;
		private $_name;
		private $_id;
		private $_class;
		private $_placeholder;
		private $_title;
		private $_label;
		private $_value;
		private $_html;
		private $_require;
		
		/* === CONSTRUCTOR and DESTRUCTOR  === */
		
		public function __construct($name,$label){
			$this->_name=$name;
			$this->_id=$name;
			$this->_placeholder=$label;
			$this->_title=$label;			
			$this->_label=$label;
			$this->_element="input";
			$this->_typeElement="text";
		}
		
		
		/* === GETTER and SETTER  === */
		
		public function getElement(){
			return $this->_element;
		}
		
		public function setElement($element){
			$this->_element=$element;
		}
		
		public function getTypeElement(){
			return $this->_typeElement;
		}
		
		public function setTypeElement($typeElement){
			$this->_typeElement=$typeElement;
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
		
		public function getPlaceholder(){
			return $this->_placeholder;
		}
		
		public function setPlaceholder($placeholder){
			$this->_placeholder=htmlspecialchars($placeholder);
		}
		
		public function getTitle(){
			return $this->_title;
		}
		
		public function setTitle($title){
			$this->_title=htmlspecialchars($title);
		}
		
		public function getLabel(){
			return $this->_label;
		}
		
		public function setLabel($label){
			$this->_label=htmlspecialchars($label);
		}
		
		public function getValue(){
			return $this->_value;
		}
		
		public function setValue($value){
			$this->_value=htmlspecialchars($value);
		}
		
		public function getHtml(){
			return $this->_html;
		}
		
		public function setHtml($html){
			$this->_html=$html;
		}
		
		public function requireElement($bool){
			if(is_bool($bool))
				$this->_require=$bool;
			else
				$this->_require=false;
		}
		
		/* === other METHODE === */
		
		public function render(){			
			$render="<div class='input' id='".$this->_name."'>";
			if(!empty($this->_label)){
				$render.="<label for='".$this->_id."'>".$this->_label." : </label>";
			}
			$render.=
				"<".$this->_element .
				" id='".$this->_id."'".
				" name='".$this->_name."'".
				" class='".$this->_class."'".
				" value='".$this->_value."'".
				" title='".$this->_title."'".
				" value='".$this->_value."'".
				" type='".$this->_typeElement."'".
				" placeholder='".$this->_placeholder."'";
			if($this->_require==true)
					$render.= " required";
			
			$render.="></div>";
				
			return $render;
		}
		
	}
?>