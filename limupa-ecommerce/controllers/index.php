<?php

include 'includes/config.php';
include 'includes/DB.php';
include 'class/categories.php';
include 'class/basket.php';

$categories = new Categories();
$Kategori_List = $categories->Kategori_List(0);

$basket = new Basket();
if (isset($_SESSION['userID'])) {
    $basketList = $basket->basketList($_SESSION['userID']);
}

// database işlemlerini burda yapcazz
include TEMPLATE . "template/index.php";

?>