<?php

require_once(dirname(__DIR__).'/IyzipayBootstrap.php');

IyzipayBootstrap::init();

class Config
{
    public static function options()
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey('sandbox-wxRsc8Epoq3pbU7sdCrFIVtcZLxTsArp');
        $options->setSecretKey('sandbox-KFrtvRDpJaeQWd1S4utTEHxhfqFAuvvT');
        $options->setBaseUrl('https://sandbox-api.iyzipay.com');

        return $options;
    }
}