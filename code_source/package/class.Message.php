<?php

error_reporting(E_ALL);

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

require_once('class.Canal.php');

class Message
{
    private $id = 0;
    private $transmitter = null;
    private $ipTransmitter = null;
    private $content = null;
    private $date = null;
    private $wasSent = false;

    // --- OPERATIONS ---

    public function sendToClient()
    {
    }

}

?>
