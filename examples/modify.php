<?php

require_once __DIR__ . '/../vendor/autoload.php';

// $key, $directMode, $testMode
$ebanx = new \Ebanx\Ebanx(array(
  'integrationKey' => 'c7696ac6794e524d554bc54723f6e5a4c4da134b69efde1ccde374f662a5fbd8e99c38a9f78b89937c284689456f4733373c',
  'directMode'     => true,
  'testMode'       => true
));

$paymentData = array(
  'mode'      => 'full',
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

$request = $ebanx->doModify($paymentData);
var_dump($request);