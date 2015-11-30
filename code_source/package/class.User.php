<?php

error_reporting(E_ALL);
if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

require_once('class.Canal.php');
require_once('class.Message.php');

class User
{
    private $id = 0;
    private $pseudo = null;
    private $phoneNumber = null;
    private $avatar = null;
    private $isOnline = false;
    private $reputation = 0;
    private $lastMessage = null;
    private $lastConnexion = null;

    // --- OPERATIONS ---

    public function getAge()
    {
        $returnValue = (int) 0;
        return (int) $returnValue;
    }

    public function isAdministrator()
    {
        $returnValue = (bool) false;
        return (bool) $returnValue;
    }
	/**
	*  Define the current User as an administrator
	*
	*/
    public function setAdministrator()
    {
        
    }

}

?>
