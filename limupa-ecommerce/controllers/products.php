<?php

include 'includes/config.php';
include 'includes/DB.php';
include 'class/categories.php';
include 'class/products.php';
include 'class/basket.php';
if (isset($_GET['CatID']) && is_numeric($_GET['CatID'])) {
    $CatID = intval($_GET['CatID']);
} else {
    header("location:index.php");
    exit;
}


$categories = new Categories();
$Kategori_List = $categories->Kategori_List(0);

$products = new Products();


if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
    $currentpage = (int)$_GET['currentpage'];
} else {
    $currentpage = 1;
} // end if
$rowsperpage = 3; // how many items per page
// the offset of the list, based on current page
$offset = ($currentpage - 1) * $rowsperpage;
$ProductsList = $products->ProductsList($CatID, $offset);
$numrows = $products->totalrows;

$basket = new Basket();
$usersBasketQuantity = array();
if (isset($_SESSION['userID'])) {
    $basketList = $basket->basketList($_SESSION['userID']);
    foreach ($basketList as $key => $value) {
        $Basket[$value['ProductsID']] = $value;
        //$Basket[$value['ProductsID']] = $value['Quantity'];
        //$Basket[$value['ProductsID']]['Miktar'] = $value['Quantity'];
    }
}


// print_r($products);
//Ürünleri yani dabasei burda çek. Class tan çek
include TEMPLATE . "template/products.php";

?>