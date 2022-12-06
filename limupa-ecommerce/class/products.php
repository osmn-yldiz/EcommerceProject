<?php 

class Products {

    function __construct() {
        global $database;
        $this->database = $database;
    }

    function ProductsDescription() {
        $this->database->query('SELECT productsID, descriptionID, name FROM products_description INNER JOIN `products_description_status` ON products_description.ID = products_description_status.descriptionID');
        $line =  $this->database->getRows();
        foreach($line as $line){
            $Desc[$line['productsID']][$line['descriptionID']] = $line['name'];
        }
        return $Desc;
    }

    function ProductsList($CatID,$offset) {

        if(!is_numeric($CatID))
        {
            header("location:index.php");
            exit;
        }
        $this->database->query("SELECT SQL_CALC_FOUND_ROWS * FROM products WHERE CatID=:CatID LIMIT $offset,3");
        $this->database->bind(":CatID", $CatID);
        $line =  $this->database->getRowsWithFoundRows();
        $this->totalrows = $this->database->totalrows;
        $this->Desc = $this->ProductsDescription();
        //print_r($this->Desc);
        return $line;
    }
}


?>