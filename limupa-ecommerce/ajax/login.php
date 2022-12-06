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
$Email = $_POST['Email'];
$Password = $_POST['Password'];

if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
    exit("Geçerli bir mail adresi giriniz.");
}

// Validate password strength
$uppercase = preg_match('@[A-Z]@', $Password);
$lowercase = preg_match('@[a-z]@', $Password);
$number = preg_match('@[0-9]@', $Password);
$specialChars = preg_match('@[^\w]@', $Password);

if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($Password) < 8) {
    $json['status'] = "error";
    $json['message'] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
} else {
    $database->query("SELECT ID,FirstName,LastName,Email,Password, Status FROM users WHERE Email=:Email AND Password=:Password LIMIT 0,1");
    $database->bind(":Email", $Email);
    $database->bind(":Password", md5($Password));
    $database->execute();
    if ($database->rowCount() > 0) {
        $line = $database->getSingleRow();
        if ($line['Email'] == $Email && $line['Password'] == md5($Password)) {
            if ($line['Status'] == 1) {
                $_SESSION['userID'] = $line['ID'];
                $_SESSION['FirstName'] = $line['FirstName'];
                $_SESSION['LastName'] = $line['LastName'];

                $database->query("UPDATE users SET LastLoginDate = NOW() WHERE ID =:ID");
                $database->bind(":ID", $line['ID']);
                $database->execute();

                $json['status'] = "success";
                $json['message'] = ("Başarılı giriş yapıldı. Yönlendiriliyorsunuz.");
            } else {
                $json['status'] = "error";
                $json['message'] = ("Kullanıcı pasif durumda.");
            }
        }
    } else {
        $json['status'] = "error";
        $json['message'] = ("Böyle bir kullanıcı yok");
    }
}

print json_encode($json);


/*
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
{
    if($_POST['Email'] == 'osmann_yldz7878@hotmail.com' && $_POST['Password'] == '1234'){
        echo 'Giriş yapıldı.';
    }
    else{
        echo 'Hatalı giriş';
    }
}  */
?>
        
    

