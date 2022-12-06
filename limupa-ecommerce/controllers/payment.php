<?php

include 'includes/config.php';
include 'includes/DB.php';
include 'class/categories.php';
include 'class/basket.php';
include 'class/payment.php';

if (!isset($_SESSION['userID'])) {
    header('location: index.php?func=login-register');
    exit();
}

$categories = new Categories();
$Kategori_List = $categories->Kategori_List(0);

$basket = new Basket();
if (isset($_SESSION['userID'])) {
    $basketList = $basket->basketList($_SESSION['userID']);
}

$payment = new Payment();
$shippingList = $payment->shippingList($_SESSION['userID']);
$billingList = $payment->billingList($_SESSION['userID']);

// database işlemlerini burda yapcazz
include TEMPLATE . "template/payment.php";

?>