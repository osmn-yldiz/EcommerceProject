<?php

session_start();

if (empty($_POST['csrf_token'])) {
    echo 'Geçersiz token1.';
    exit;
}

if (isset($_POST['csrf_token']) && $_POST['csrf_token'] != $_SESSION['csrf_token']) {
    echo 'Geçersiz token2';
    exit;
}

include __DIR__ . '/../includes/config.php';
include DEFAULT_URL . 'includes/DB.php';

$json = array();
$ProductsID = $_POST['ProductsID'];
$Quantity = $_POST['Quantity'];

if ((int) $ProductsID < 1) {
    exit("Geçersiz ürün");
}

$database->query("SELECT * FROM basket WHERE UserID=:UserID AND ProductsID=:ProductsID");
$database->bind(':UserID', $_SESSION['userID']);
$database->bind(':ProductsID', $ProductsID);
$database->execute();
if($database->rowCount() > 0) {
    // $database->query("UPDATE basket SET Quantity=Quantity + :Quantity WHERE UserID=:UserID AND ProductsID=:ProductsID");
    $database->query("UPDATE basket SET Quantity=:Quantity WHERE UserID=:UserID AND ProductsID=:ProductsID");
    $database->bind(':UserID', $_SESSION['userID']);
    $database->bind(':Quantity', $Quantity);
    $database->bind(':ProductsID', $ProductsID);
    $database->execute();
    if($database->execute()){
        $json['status']="success";
        $json['message'] = "Ürün güncellendi";
    }else{
        $json['status']="error";
        $json['message'] = "Ürün güncellenmedi.";
    }
}else {
    $database->query("INSERT INTO basket(UserID,ProductsID,Quantity,CreateDate) VALUES(:UserID,:ProductsID,:Quantity, NOW())");
    $database->bind(':UserID', $_SESSION['userID']);
    $database->bind(':ProductsID', $ProductsID);
    $database->bind(':Quantity', $Quantity);
    if($database->execute()){
        $json['status']="success";
        $json['message'] = "Ürün sepete eklendi";
    }else{
        $json['status']="error";
        $json['message'] = "Ürün sepete eklenmedi.";
    }
}

print json_encode($json);

?>
        
    

