<?php
class APIException extends Exception
{
    public function __construct($message="",$code=0)
    {
        parent::__construct($message,$code,null);
    }
    public function getMessageString()
    {
        return $this->getMessage();
    }
}
?>