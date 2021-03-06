<?php

class Message
{
    private $_sender;
    private $_content;
    private $_date;

    // Constructor
    public function __construct($sender, $content, $date)
    {
        $this->_sender = $sender;
        $this->_content = $content;
        $this->_date = $date;
    }

    // Getters
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

    public function getDisplayDate()
    {
        return $this->_date->format('d/m/Y');
    }

    public function getDisplayHour()
    {
        return $this->_date->format('H:i');
    }
}
