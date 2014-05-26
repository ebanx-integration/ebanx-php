<?php

require_once 'bootstrap.php';

$response = \Ebanx\Ebanx::doZipcode(array(
  'zipcode' => '80230010'
));

var_dump($response);