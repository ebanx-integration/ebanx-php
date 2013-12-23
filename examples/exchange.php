<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once 'bootstrap.php';

$response = \Ebanx\Ebanx::doExchange(array('currency_code' => 'USD'));
var_dump($response);