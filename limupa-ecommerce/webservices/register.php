<?php
//GECERISIZ_MAIL_ADRES = '"Geçersiz mail adresini gird'iniz";
error_reporting(0);

include 'config.php';
include 'DB.php';
include 'functions.php';



header('Content-Type: application/json');
$data = new stdClass;
$data->ReturnType = "";

$header = apache_request_headers();
if (!isset($header['TOKEN'])) {
    $json['message'] = "token yok";
    print json_encode($json);

    exit;
}

$TokenControl= TokenControl($header['TOKEN']);
if(!$TokenControl){
    $json['message'] = "Seni Tanımıyorum";
    print json_encode($json);

    exit;
}

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $rawdata = file_get_contents("php://input", TRUE);
        $data = json_decode($rawdata);

        $FirstName = $data->param->FirstName;
        $LastName = $data->param->LastName;
        $Email = $data->param->Email;
        $Password = $data->param->Password;
        $Password2 = $data->param->Password2;

        if ($FirstName == "") {
            $errorMessage['errEmpty'][] = "Ad";
        }
        if ($LastName == "") {
            $errorMessage['errEmpty'][] = "Soyad";
        }
        if ($Email == "") {
            $errorMessage['errEmpty'][] = "E-mail";
        }
        if ($Password == "") {
            $errorMessage['errEmpty'][] = "Şifre";
        }
        if ($Password2 == "") {
            $errorMessage['errEmpty'][] = "Şifre Tekrar";
        }
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage['errOther'][] = "Geçersiz mail adresi";
        }

        $database->query("SELECT ID FROM users WHERE Email =:Email");
        $database->bind(":Email", $Email);
        $database->execute();
        if($database->rowCount() > 0){
            $errorMessage['errOther'][] = "E-mail adresi mevcut";
        }

        if (count($errorMessage['errEmpty']) > 0) {
            $json['errEmpty'] = $errorMessage['errEmpty'];
        } else if (count($errorMessage['errOther']) > 0) {
            $json['errOther'] = $errorMessage['errOther'];
        } else {
            $dataUsersArray = array(
                "UserTypeID" => 2,
                "FirstName" => $FirstName,
                "LastName" => $LastName,
                "Email" => $Email,
                "Password" => md5($Password)
            );

            $result = $database->insertQuery("users", $dataUsersArray);
            if ($result > 0) {
                $json['status'] = "success";
                $json['successMessage'] = "Başarılı Bir Şekilde Kayıt Oldunuz.";
            } else {
                //$json['status'] = "error";
                $json['errOther'][] = $result;
            }
        }
    }
    else if ($_SERVER['REQUEST_METHOD'] == "GET")
    {
        $json['message'] = "GET metodu ile istek yapıldı";
    }
    else
    {
        $json['message'] = "Hatalı İstek";
    }

if ($header['ReturnType'] == "json") {
    print json_encode($json);
} else {
    $json['message'] = "Return Type Belirtiniz";
    print  json_encode($json);
}
?>
