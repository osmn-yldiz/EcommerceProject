<?php
function apiRequest($URL, $data = array())
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_PORT => WEBSERVICES_PORT,
        CURLOPT_URL => WEBSERVICES_URL . $URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            "content-type: application/json",
            "ReturnType: json",
            "TOKEN: " . WEBSERVICES_TOKEN
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
        exit;
    } else {
        return $response;
    }
}

function MoneyFormat($deger)
{
    return number_format($deger, 2, ',', '.');
}

?>