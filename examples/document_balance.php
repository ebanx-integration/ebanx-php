<?php

require_once 'bootstrap.php';

$response = \Ebanx\Ebanx::doDocumentBalance(array(
    'currency_code'     => 'USD'
  , 'document'            => '88282672165'
));

var_dump($response);