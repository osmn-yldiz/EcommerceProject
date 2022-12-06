<?php


include 'includes/config.php';
include 'includes/DB.php';
include 'class/categories.php';
include 'class/basket.php';
include 'includes/functions.php';

if($_SESSION['userID'] < 1){
    header("location:index.php?fucn=login-register");
    exit;
}
$basket = new Basket();
$BasketList = $basket->basketList($_SESSION['userID']);
//print_r($BasketList);

$categories = new Categories();
$Kategori_List = $categories->Kategori_List(0);

$basket = new Basket();
$basketList = $basket->basketList($_SESSION['userID']);

include TEMPLATE."template/basket.php";

?>
