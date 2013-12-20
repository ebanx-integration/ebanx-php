<?php

require_once 'Mock/Http/Client.php';

class TestCase extends PHPUnit_Framework_TestCase
{
    protected $_ebanx;

    public function setUp()
    {
        $integrationKey = 'e1ece8345738e1dcb36d597f21e438ef2ca87eb79074f567b5d5a4ce736233d054af1975ea0bd61bc5c7b801de1d0e9f8e91';

        $this->_ebanx = new \Ebanx\Ebanx(array(
            'integrationKey' => $integrationKey
          , 'directMode'     => false
          , 'httpClient'     => '\\Mock\\Http\\Client'
        ));
    }

    protected function _getEbanxDirect()
    {
        return new \Ebanx\Ebanx(array(
            'integrationKey' => \Ebanx\Config::getIntegrationKey()
          , 'directMode'     => true
          , 'httpClient'     => '\\Mock\\Http\\Client'
        ));
    }
}