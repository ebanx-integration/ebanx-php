<?php

require_once 'bootstrap.php';

$response = \Ebanx\Ebanx::getBankList(array('country_code' => 'br'));
var_dump($response);