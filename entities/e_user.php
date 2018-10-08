<?php

class User
{
    private $_id;
    private $_login;

    // Contructor
    public function __construct($id, $login)
    {
        $this->_id = $id;
        $this->_login = $login;
    }

    // Getters
    public function getId()
    {
        return $this->_id;
    }

    public function getLogin()
    {
        return $this->_login;
    }
}
