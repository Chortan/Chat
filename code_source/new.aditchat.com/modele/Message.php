<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."modele/MessageSQL.php");
    
    class Message{
        private $_id;
        private $_transmitter;
        private $_ipTransmitter;
        private $_content;
        private $_date;
        private $_wasSent;

        /* =================== CONSTRUCTOR =================== */

        public function __construct($content,$user){
                $this->setID(Message::generateID());
                $this->setTransmitter($user);
                $this->setContent($content);
                $this->setDate(time());
                $this->setIpTransmitter($_SERVER["REMOTE_ADDR"]);
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

        function isSended() {
            return $this->_wasSent;
        }

        function setTransmitter($transmitter) {
            $this->_transmitter = $transmitter;
        }

        function setIpTransmitter($ipTransmitter) {
            $this->_ipTransmitter = $ipTransmitter;
        }

        function setContent($content) {
            $this->_content = htmlentities($content);
        }

        function setDate($date) {
            $this->_date = $date;
        }

        function wasSent($wasSent) {
            $this->_wasSent = $wasSent;
        }


        /* =================== SAVE AND GET in DATA BASE =================== */

        public static function generateID(){
            return MessageSQL::generateID();
        }

        public static function getMessageByID($idMessage){
            return MessageSQL::getMessageByID($id);
        }
        
        public static function getMessageByUser($user){
            return MessageSQL::getMessageByUser($user);
        }
        
        public static function getMessageByCanal($canal){
            return MessageSQL::getMessageByCanal($canal);
        }

        public function save(){
            $messageSQL = new MessageSQL($this);
            $messageSQL->save();
        }
        
        public function equals($message){
            if($this->getID() == $message->getID()) return true;
            else return false;
        }
    }
?>