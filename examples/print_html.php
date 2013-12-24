<?php

require_once 'bootstrap.php';

\Ebanx\Config::setDirectMode(true);

$paymentData = array(
  'mode'      => 'full',
  'operation' => 'request',
  'payment'   => array(
    'merchant_payment_code' => time(),
    'amount_total'      => 100,
    'currency_code'     => 'USD',
    'name'              => 'ROBERTO CARLOS',
    'email'             => 'roberto@example.com',
    'birth_date'        => '12/04/1979',
    'document'          => '88282672165',
    'address'           => 'AV MIRACATU',
    'street_number'     => '2993',
    'street_complement' => 'CJ 5',
    'city'              => 'CURITIBA',
    'state'             => 'PR',
    'zipcode'           => '81500000',
    'country'           => 'br',
    'phone_number'      => '4132332354',
    'payment_type_code' => 'boleto'
  )
);

$request = \Ebanx\Ebanx::doRequest($paymentData);

$response =\Ebanx\Ebanx::doPrintHtml(array(
    'hash' => $request->payment->hash
));

var_dump($response);