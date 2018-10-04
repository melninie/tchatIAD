<?php

class message
{
    private $_id;
    private $_sender;
    private $_content;
    private $_date;

    // Constructor
    public function __construct($id, $sender, $content, $date)
    {
        $this->_id = $id;
        $this->_sender = $sender;
        $this->_content = $content;
        $this->_date = $date;
    }

    // Getters
    public function getId()
    {
        return $this->_id;
    }

    public function getSender()
    {
        return $this->_sender;
    }

    public function getContent()
    {
        return $this->_content;
    }

    public function getDate()
    {
        return $this->_date;
    }
}
