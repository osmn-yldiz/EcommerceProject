<?php
error_reporting(0);
ini_set("display_errors",1);
//değişkenleri diye bir dosyalmız olsun php odsyası olusn ve içinde PATH ler ve DB bağlanmak için user pass olsun.
// son ilk kurulumda. O dğeişkenleri biz kendimiz oluşturalım. 
// form oluştue o formmdan verileri ordan oku. install script olacak
define("TEMPLATE", "views/template_yellow/"); 
define("DB_HOST", "localhost"); 
define("DB_NAME", "limupa-ecommerce"); 
define("DB_USER", "osman"); 
define("DB_PASS", "Oy621207.");
define("URL", "http://localhost:8080/osman/limupa-ecommerce/");
define("DEFAULT_URL", "C:/xampp/htdocs/osman/limupa-ecommerce/");
define("WEBSERVICES_URL", "http://localhost:8080/osman/limupa-ecommerce/webservices/");
define("WEBSERVICES_PORT", "8080");
define("WEBSERVICES_TOKEN", "abc");

?>