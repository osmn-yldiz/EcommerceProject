<?php
session_start();
//  Bu kısım database den çekilecek.
if (isset($_GET['func'])) {
    $func = $_GET['func'];
} else {
    $func = "";
}

switch ($func) {
    case '':
        include 'controllers/index.php';
        break;
    case 'products':
        include 'controllers/products.php';
        break;
    case 'basket':
        include 'controllers/basket.php';
        break;
    case 'login-register':
        include 'controllers/login-register.php';
        break;
    case 'logout':
        include 'controllers/logout.php';
        break;
    case 'payment':
        include 'controllers/payment.php';
        break;
}

?>