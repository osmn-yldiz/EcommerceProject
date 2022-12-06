<?php

session_start();
require_once('config.php');
include '../../includes/config.php';
include '../../includes/DB.php';

# create request class
$request = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
$request->setLocale(\Iyzipay\Model\Locale::TR);
$request->setConversationId("123456789");
$request->setToken($_POST['token']);

# make request
$checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($request, Config::options());

# print result
$checkoutFormJson = json_decode(($checkoutForm->getrawResult()));


$database->query("SELECT UserID from usersiyzicotoken WHERE Token=:Token");
$database->bind(':Token', $checkoutForm->getToken());
$database->execute();
if($database->rowCount() > 0) {
    $lineUser = $database->getSingleRow();

   $database->query("INSERT INTO orders(UserID,Price,Installment,PaymentStatus,CardType,CardFamily,CardNumber,PaidPrice,MerchantCommissionRateAmount,IyziCommissionRateAmount) VALUES(?,?,?,?,?,?,?,?,?,?)");
    $resultOrders = $database->execute(array($lineUser['UserID'],$checkoutFormJson->price,$checkoutFormJson->installment,$checkoutFormJson->paymentStatus,$checkoutFormJson->cardType,$checkoutFormJson->cardFamily,$checkoutFormJson->binNumber.'****'.$checkoutFormJson->lastFourDigits,$checkoutFormJson->paidPrice,$checkoutFormJson->merchantCommissionRateAmount,$checkoutFormJson->iyziCommissionRateAmount));
    if($resultOrders) {
        $orderID =  $database->lastInsertId();

        $database->query("SELECT * FROM basket WHERE UserID=:UserID");
        $database->bind(':UserID', $lineUser['UserID']);
        $lineskepAll = $database->getRows();
        foreach ($lineskepAll as $lineskep) 
        {
            $database->query("SELECT * FROM products WHERE ID=:ID");
            $database->bind(':ID', $lineskep['ProductsID']);
            $lineProducts = $database->getSingleRow();
            $database->query("INSERT INTO ordersproducts(orderID,ItemID,Price,ProductName,ProductTotal) VALUES(?,?,?,?,?)");
            $database->execute([$orderID, $lineskep['ProductsID'], $lineProducts['Price'], $lineProducts['Name'], $lineskep['Quantity']]);
        }

        /*$database->query("DELETE FROM basket WHERE UserID=:UserID");
        $database->bind(':UserID', $lineUser['UserID']);
        $database->execute();*/

        $database->query("DELETE FROM usersiyzicotoken WHERE Token=:Token");
        $database->bind(':Token', $checkoutForm->getToken());
        $database->execute();

        print "<h1>Siparişiniz Alındı</h1>";
    }else {
        print "Hata";
        print_r($database->errors);
        exit;
    }
}
else 
{
    echo '<h1>Daha önce siparişiniz alındı.</h1>';
}
