<?php

require_once '../vendor/autoload.php';

// $key, $directMode, $testMode
$ebanx = new \Ebanx\Ebanx(array(
  'integrationKey' => 'c7696ac6794e524d554bc54723f6e5a4c4da134b69efde1ccde374f662a5fbd8e99c38a9f78b89937c284689456f4733373c',
  'directMode'     => false,
  'testMode'       => true
));

$response = $ebanx->doExchange(array('currency_code' => 'USD'));
var_dump($response);