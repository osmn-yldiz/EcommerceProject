<?php
session_start();

if ($_SESSION['userID'] < 1) {
    exit("Lütfen giriş yapınız");
}

include __DIR__ . '/../includes/config.php';
include DEFAULT_URL . 'includes/DB.php';

$database->query("DELETE FROM basket WHERE ID=:ID AND UserID=:UserID");
$database->bind(":ID", $_POST['ID']);
$database->bind(":UserID", $_SESSION['userID']);
if ($database->execute()) {
    print $_POST['ID'];
} else {
    print 0;
}


?>
