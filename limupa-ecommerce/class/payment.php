<?php

class Payment
{
    function __construct()
    {
        global $database;
        $this->database = $database;
    }
    function shippingList($UserID)
    {
        $UserID = (int) $UserID;
       /* if($UserID < 1) {
            exit;
        }*/
        $this->database->query('SELECT * FROM shippingaddress WHERE UserID=:UserID');
        $this->database->bind(":UserID", $UserID);
        $line =  $this->database->getRows();

        return $line;
    }
    function billingList($UserID)
    {
        $UserID = (int) $UserID;
        /* if($UserID < 1) {
             exit;
         }*/
        $this->database->query('SELECT * FROM billingaddress WHERE UserID=:UserID');
        $this->database->bind(":UserID", $UserID);
        $line =  $this->database->getRows();

        return $line;
    }
}

?>