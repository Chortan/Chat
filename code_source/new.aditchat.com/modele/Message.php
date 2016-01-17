<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/modele/MessageSQL.php");
    
    class Message{
        private $_id;
        private $_transmitter;
        private $_ipTransmitter;
        private $_content;
        private $_date;
        private $_wasSent;
        
        private static $_emojis = Array(
            ":)" => "1f600", ":-)" => "1f600",
            ":^)" => "1f603",
            ":(" => "1f627", ":-(" => "1f627",
            ":^(" => "1f625",
            ":-|" => "1f610",
            "-_-" => "1f611",
            "--'" => "1f613",
            ":/" => "1f614", ":\\" => "1f614",
            ":')" => "1f602",
            ":'(" => "1f62d",
            ":*" => "1f618",
            "*-*" => "1f601",
            ":3" => "1f619",
            "x.x" => "1f632",
            ">.<" => "1f616",
            ":D" => "1f604", ":-D" => "1f604",
            ";)" => "", ";-)" => "",
            "<3" => "2764", "(l)" => "2764", "(love)" => "2764",
            ":p" => "1f60b", ":P" => "1f60b",
            ":$" => "1f60a", 
            ":S" => "1f616", ":s" => "1f616",
            "(a)" => "1f607", "(angel)" => "1f607",
            ":o" => "1f62f", ":-o" => "1f62f"
        );

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
            return $this->_content;;
        }
        
        function getContentWithEmoji(){
            $content = $this->_content;
            foreach(Message::$_emojis as $text => $emoji){
                if($this->_content == htmlentities($text)){
                    $size = "36x36";
                }else{
                    $size = "16x16";
                }
                $content = str_replace(htmlentities($text), "<img src='/vue/rsc/image/emoji/$size/". $emoji .".png'/>", $content);
            
                
            }
            return $content;
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
            $this->_content = $content;
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
            return MessageSQL::getMessageByID($idMessage);
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