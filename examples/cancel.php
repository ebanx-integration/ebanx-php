<?php

require_once __DIR__ . '/../vendor/autoload.php';

// $key, $directMode, $testMode
$ebanx = new \Ebanx\Ebanx(array(
  'integrationKey' => 'c7696ac6794e524d554bc54723f6e5a4c4da134b69efde1ccde374f662a5fbd8e99c38a9f78b89937c284689456f4733373c',
  'directMode'     => false,
  'testMode'       => true
));

$request = $ebanx->doRequest(array(
    'currency_code'     => 'USD'
  , 'amount'            => 119.90
  , 'name'              => 'Gustavo Mascarenhas'
  , 'email'             => 'gustavo@ebanx.com'
  , 'payment_type_code' => 'boleto'
  , 'merchant_payment_code' => time()
));

$response = $ebanx->doCancel(array(
    'hash' => $request->payment->hash
));

var_dump($response);