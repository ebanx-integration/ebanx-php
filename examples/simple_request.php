<?php

require_once '../vendor/autoload.php';

// $key, $directMode, $testMode
$ebanx = new \Ebanx\Ebanx(array(
  'integrationKey' => '123123123123123123123123123123121231',
  'directMode' => false,
  'testMode' => true
));
$ebanx->doRequest();
$ebanx->doQuery();
$ebanx->doModify();