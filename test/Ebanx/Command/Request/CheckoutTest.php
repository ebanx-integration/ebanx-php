<?php

class CheckoutTest extends TestCase
{
    protected $_params;

    public function setUp()
    {
        parent::setUp();

        $this->_params = array(
            'currency_code' => 'USD'
          , 'amount'        => 100.00
          , 'name'          => 'José da Silva'
          , 'email'         => 'jose@example.org'
          , 'payment_type_code'     => '_all'
          , 'merchant_payment_code' => time()
        );
    }
    public function testValidateCurrencyCode()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'currency_code' was not supplied.");
        unset($this->_params['currency_code']);
        $this->_ebanx->doRequest($this->_params);
    }

    // public function testCancelRequestIsCorrect()
    // {
    //     $request = $this->_ebanx->doRequest($this->_params);

    //     $this->assertEquals('POST', $request['method']);
    //     $this->assertEquals('https://www.ebanx.com/pay/ws/request', $request['action']);
    //     $this->assertEquals(true, $request['decode'], true);
    //     $this->assertEquals($hash, $request['params']['hash'], $hash);
    // }
}