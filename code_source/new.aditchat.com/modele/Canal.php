<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/modele/User.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/modele/Message.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/modele/CanalSQL.php");
	
    class Canal{
        private $_id;

        private $_name;
        private $_dateCreated;
        private $_creator;

        private $_users;
        private $_messages;

        /**
         * 
         * @param type $name String Nom du Canal
         * @param type $user User Premier User du Canal 
         */
        public function __construct($name,$user){
            $this->_id = Canal::generateID();
            $this->_title=$name;
            $this->_nbrUser=0;
            $this->_dateCreated = date("Y-m-d");
            $this->_creator = $user;
            
            $this->_users=array();
            $this->_messages=array();
            
            $this->addUser($user);
        }

        public function getID(){
            return $this->_id;
        }

        public function setID($id){
            if(is_numeric($id)){
                    $this->_id=$id;
                    return true;
            }else return false;
            
        }

        /**
         * Récupère le nom du canal
         * @return type String
         */
        public function getName(){
            return $this->_title;
        }

        /**
         * Définit le nom du canal
         * @param type $title String
         */
        public function setName($title){
            $this->_title=htmlspecialchars($title);
        }
        
        function getDateCreated() {
            return $this->_dateCreated;
        }

        function setDateCreated($_dateCreated) {
            $this->_dateCreated = $_dateCreated;
        }
        
        /**
         * Définit le créateur du canal
         * @param type User $user
         */
        function setCreator($user){
            $this->_creator = $user;
        }
        
        /**
         * Retourne le créateur du canal
         * @return type User
         */
        function getCreator(){
            return User::getUserByID($this->_creator->getID());
        }
        
        /**
         * Ajoute un utilisateur au canal
         * @param type $user User
         */
        public function addUser($user){
            array_push($this->_users, $user);
        }

        /**
         * Supprime un utilisateur du canal
         * @param type $user User
         */
        public function rmUser($user){
            for($i=0;$i<count($this->_users);$i++){
                if($user[$i]->equals($user))
                    unset($user[$i]);
            }
        }
        /**
         * Ajoute un message dans le Canal
         * @param type Message $message
         */
        public function addMessage($message){
            $this->_messages[]=$message;
            $message->save();
            
            $canalSQL = new CanalSQL($this);
            $canalSQL->addMessage($message);
        }

        /**
         * Récupère tous les messages du canal
         * @return type Array of Message
         */
        public function getAllMessages(){
            $canalSQL = new CanalSQL($this);
            $this->_messages = $canalSQL->getAllMessages();
            return $this->_messages;
        }	
        
        /**
         * Récupère tous les message a partir d'une date donnée
         * @param type $time int value TIMESTAMP
         * @return \Message Array of Message
         */
        public function getMessagesByDate($time){
            
            $canalSQL = new CanalSQL($this);
            return $canalSQL->getAllMessagesByDate($time);
            
            
        }
        
        public function getAllUsers(){
            return $this->_users;
        }

        public function getUserByID($id){
            return $this->_users[$id];
        }

        public function getMessageByID($id){
            return $this->_messages[$id];
        }
        
        /**
         * Créer ou met à jour le canal dans la base de données
         */
        public function save(){
            $canalSQL = new CanalSQL($this);
            $canalSQL->save();
        }
        
        /**
         * Créer un titre en fonction du pseudo des utilisateurs
         * @return boolean String
         */
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
        
        /**
        * Savoir un un utilisateurs données est dans le canal ou pas (a partir de la BDD) 
        * @param type $user L'utilisateur a qui on veut savoir s'il est dans le canal
        * @return boolean 
        */
        public function isInCanal($user){
            $canalSQL = new CanalSQL($this);
            return  $canalSQL->isInCanal($user);
        }
        
        /**
         * Vérifie si le canal existe en fonction des utilisateur qui y sont référencé.
         * @return type boolean ou int : id du canal
         */
        public function exists(){
            $canalSQL = new CanalSQL($this);
            return $canalSQL->exists();
        }


        public static function generateID(){
            return CanalSQL::generateID();
        }
        
        public static function getCanalByID($id){
            return CanalSQL::getCanalByID($id);
        }
		
        public static function getCanalByUser($user){
            return CanalSQL::getCanalByUser($user);
        }
        
        public static function getCanalByUsers($users){
            return CanalSQL::getCanalByUsers($users);
        }
    }
?>