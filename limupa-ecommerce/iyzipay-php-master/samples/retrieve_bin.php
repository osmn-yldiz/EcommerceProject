<?php

require_once('config.php');

# create request class
$request = new \Iyzipay\Request\RetrieveBinNumberRequest();
$request->setLocale(\Iyzipay\Model\Locale::TR);
$request->setConversationId("123456789");
$request->setBinNumber("460345");

# make request
$binNumber = \Iyzipay\Model\BinNumber::retrieve($request, Config::options());

# print result
print_r($binNumber);