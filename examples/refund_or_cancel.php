<?php

require_once 'bootstrap.php';

$request = \Ebanx\Ebanx::doRequest(array(
    'currency_code'     => 'USD'
  , 'amount'            => 119.90
  , 'name'              => 'Gustavo Mascarenhas'
  , 'email'             => 'gustavo@ebanx.com'
  , 'payment_type_code' => '_all'
  , 'merchant_payment_code' => time()
));

var_dump($request);
readline();

$response = \Ebanx\Ebanx::doRefundOrCancel(array(
    'operation'   => 'request'
  , 'hash'        => $request->payment->hash
  , 'amount'      => '50'
  , 'description' => 'Product arrived with damages.'
));

var_dump($response);