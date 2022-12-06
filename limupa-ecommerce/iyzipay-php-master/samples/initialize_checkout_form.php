<?php
//view-source:

/*$xml=simplexml_load_file("https://www.tcmb.gov.tr/kurlar/today.xml") or die("Error: Cannot create object");
print_r($xml);
exit;*/
session_start();
require_once('config.php');
include '../../includes/config.php';
include '../../includes/DB.php';

$database->query("SELECT * from users where ID=:ID and UserTypeID=2");
$database->bind(":ID",$_SESSION['userID']);
$userBuyer = $database->getSingleRow();

$database->query("SELECT * from billingaddress where UserID=:UserID");
$database->bind(":UserID",$_SESSION['userID']);
$userBilling = $database->getSingleRow();

$database->query("SELECT * from shippingaddress where UserID=:UserID");
$database->bind(":UserID",$_SESSION['userID']);
$userShipping = $database->getSingleRow();


# create request class
$request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
$request->setLocale(\Iyzipay\Model\Locale::TR);
$request->setConversationId("123456789");

$request->setCurrency(\Iyzipay\Model\Currency::TL);
$request->setBasketId("B67832");
$request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
$request->setCallbackUrl(URL."iyzipay-php-master/samples/retrieve_checkout_form_result.php");
$request->setEnabledInstallments(array(2, 3, 6, 9));

//$s = sprintf('%05d', $userBuyer['ID']);

// Alıcı Genel Bilgileri
$buyer = new \Iyzipay\Model\Buyer();
$buyer->setId($userBuyer['ID']);
$buyer->setName($userBuyer['FirstName']);
$buyer->setSurname($userBuyer['LastName']);
$buyer->setGsmNumber("+90".$userBuyer['Phone']);
$buyer->setEmail($userBuyer['Email']);
$buyer->setIdentityNumber($userBuyer['TC']);
$buyer->setLastLoginDate($userBuyer['LastLoginDate']);
$buyer->setRegistrationDate($userBuyer['CreateDate']);
$buyer->setRegistrationAddress($userBuyer['Adress']);
$buyer->setIp($_SERVER['REMOTE_ADDR']);
$buyer->setCity($userBuyer['City']);
$buyer->setCountry("Türkiye");
$buyer->setZipCode("34732");
$request->setBuyer($buyer);

// Kargo Bilgileri
$shippingAddress = new \Iyzipay\Model\Address();
$shippingAddress->setContactName($userShipping['FullName']);
$shippingAddress->setCity($userShipping['City']);
$shippingAddress->setCountry("Türkiye");
$shippingAddress->setAddress($userShipping['Adress']);
$shippingAddress->setZipCode($userShipping['ZipCode']);
$request->setShippingAddress($shippingAddress);

// Fatura Bilgileri
$billingAddress = new \Iyzipay\Model\Address();
$billingAddress->setContactName($userBilling['FullName']);
$billingAddress->setCity($userBilling['City']);
$billingAddress->setCountry("Türkiye");
$billingAddress->setAddress($userBilling['Adress']);
$billingAddress->setZipCode($userBilling['ZipCode']);
$request->setBillingAddress($billingAddress);

$basketItems = array();

$database->query("SELECT * FROM basket WHERE UserID=:UserID");
$database->bind(":UserID", $_SESSION['userID']);
$line = $database->getRows();
$setPrice=0;
$desi = 0;
$desiTutar =0;
foreach($line as $key => $line)
{
    $database->query("SELECT * FROM products WHERE ID=:ID");
    $database->bind(":ID", $line['ProductsID']);
    $lineProducts = $database->getSingleRow();

    $firstBasketItem = new \Iyzipay\Model\BasketItem();
    $firstBasketItem->setId($line['ProductsID']);
    $firstBasketItem->setName($lineProducts['Name']);
    $firstBasketItem->setCategory1("Collectibles");
    $firstBasketItem->setCategory2("Accessories");
    $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
    $firstBasketItem->setPrice($lineProducts['Price']);
    $basketItems[$key] = $firstBasketItem;

    $setPrice += $lineProducts['Price'];

    $database->query("Select DesiTutari from kargo_details where Desi=:Desi");
    $database->bind(":Desi", $lineProducts['Desi']);
    $lineDesi = $database->getSingleRow();

    $desiTutar += $lineDesi['DesiTutari'] * $line['Quantity'];
}
//print $setPrice;exit;


$request->setBasketItems($basketItems);

$request->setPrice($setPrice); // Sepet Toplamı
$request->setPaidPrice($setPrice+$desiTutar); // Ödenecek Toplam Tutar

# make request
$checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($request, Config::options());

# print result
//print_r($checkoutFormInitialize);
//print_r($checkoutFormInitialize->getStatus());
//print_r($checkoutFormInitialize->getErrorMessage());
//print_r($checkoutFormInitialize->getCheckoutFormContent());
?>

<html>

<body>
    <?php if($checkoutFormInitialize->getStatus() == 'success') {
        $database->query('INSERT INTO usersiyzicotoken(UserID,Token,CreateDate) VALUES(:UserID,:Token,NOW())');
        
        $database->bind(":UserID", $_SESSION['userID']);
        $database->bind(":Token", $checkoutFormInitialize->getToken());
        $database->execute();
    ?>
    <div style="display:none"><?php print_r($checkoutFormInitialize); ?></div>
    <div id="iyzipay-checkout-form" class="responsive"></div>
    <?php } else { print $checkoutFormInitialize->getErrorMessage();} ?>
</body>

</html>