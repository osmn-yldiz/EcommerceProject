<?php
if (isset($_SESSION['userID'])) {
    header("location:index.php");
    exit;
}
include 'includes/config.php';
include 'includes/functions.php';
include 'includes/DB.php';
include 'class/categories.php';

$categories = new Categories();
$Kategori_List = $categories->Kategori_List(0);
// database işlemlerini burda yapcazz

if (isset($_POST['Register'])) {
    // print "Kayıt oLwebservis ile bağlanıtya geç";

    /*  $LANG['tr']['GECERISIZ_MAIL_ADRES'] = "Geçersiz bir mail adresi girdiniz";
      $LANG['en']['GECERISIZ_MAIL_ADRES'] = "Invalid Email adress";

      $LANG['tr']['SIFRE_UYUMSUZ'] = "Şifre uyumsuz";
      $LANG['en']['SIFRE_UYUMSUZ'] = "Invalid Password";*/

    /*$json_data = array(
        "param" => $_POST
    );*/

    $json_data = array(
        "param" => array(
            "FirstName" => $_POST['FirstName'],
            "LastName" => $_POST['LastName'],
            "Email" => $_POST['Email'],
            "Password" => $_POST['Password'],
            "Password2" => $_POST['Password2'],
        )
    );

    /*$json_data['param']['FirstName'] = $_POST['FirstName'];
    $json_data['param']['LastName'] = $_POST['LastName'];
    $json_data['param']['Email'] = $_POST['Email'];
    $json_data['param']['Password'] = $_POST['Password'];
    $json_data['param']['Password2'] = $_POST['Password2'];*/

    $response = apiRequest("register.php", $json_data);
    $response = json_decode($response);
    if (count($response->errOther) > 0 || count($response->errEmpty) > 0) {
        $ERR_EMPTY = $response->errEmpty;
        $ERR_OTHER = $response->errOther;
        // print_r($ERR_OTHER);
    } else {
        $SUCCESS = $response->successMessage;
    }
}
include TEMPLATE . "template/login-register.php";

?>