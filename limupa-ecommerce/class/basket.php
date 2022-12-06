<?php

class Basket
{
    public $toplam;
    function __construct()
    {
        global $database;
        $this->database = $database;
    }
    function basketList($UserID)
    {
        $UserID = (int) $UserID;
       /* if($UserID < 1) {
            exit;
        }*/
        $this->database->query('SELECT basket.ProductsID, basket.ID, basket.Quantity, products.Name, products.Price, products.KDV, products.Images FROM basket INNER JOIN products on basket.ProductsID = products.ID WHERE UserID=:UserID');
        $this->database->bind(":UserID", $UserID);
        $line =  $this->database->getRows();

        $this->toplam=0;
        foreach($line as $lines){
            $this->toplam += $lines['Quantity'] * $lines['Price'];
        }
        return $line;
    }
}

?>