<?php

error_reporting(E_ALL);

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

class Canal
{
    private $id = 0;
    private $name = null;
    private $users = null;
    private $messages = null;
    private $dateCreated = null;

    // --- OPERATIONS ---

    public function addUser( User $user)
    {
    }

    public function getUserByID($id)
    {
        $returnValue = null;
        return $returnValue;
    }

    public function removeUserByID($id)
    {
    }

    public function setUserByID($id,  User $user)
    {
    }

    public function addMessage( Message $message)
    {
    }

    public function getMessageByID($id)
    {
        $returnValue = null;
        return $returnValue;
    }

    public function removeMessageByID($id)
    {
    }

    public function setMessageByID($id,  Message $message)
    {
    }

}
?>
