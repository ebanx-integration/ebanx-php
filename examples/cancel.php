<?php

require_once 'bootstrap.php';

$request = \Ebanx\Ebanx::doRequest(array(
    'currency_code'     => 'USD'
  , 'amount'            => 119.90
  , 'name'              => 'Gustavo Mascarenhas'
  , 'email'             => 'gustavo@ebanx.com'
  , 'payment_type_code' => 'boleto'
  , 'merchant_payment_code' => time()
));

$response = \Ebanx\Ebanx::doCancel(array(
    'hash' => $request->payment->hash
));

var_dump($response);