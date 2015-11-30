<?php

error_reporting(E_ALL);

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

require_once('class.User.php');

class Administrator
{
    // --- ASSOCIATIONS ---


    // --- ATTRIBUTES ---

    private $id = 0;
    private $statut = 0;
    private $ableGetMessage = false;
    private $ableGetProfil = false;
    private $ableSetup = false;
    private $ableRootPriivilege = false;

    // --- OPERATIONS ---

    /**
     * Downgrade a administrator to simple user.
     * 
     * @access public
     * @return void
     */
    public function removeAdministrator()
    {
    }

} 
?>
