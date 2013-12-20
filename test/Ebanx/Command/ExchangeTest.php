<?php

class ExchangeTest extends TestCase
{
    public function testValidateCurrencyCode()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'currency_code' was not supplied.");
        $this->_ebanx->doExchange(array());
    }

    public function testRequest()
    {
        $request = $this->_ebanx->doExchange(array('currency_code' => 'USD'));

        $this->assertEquals('GET', $request['method']);
        $this->assertEquals('https://www.ebanx.com/pay/ws/exchange', $request['action']);
        $this->assertEquals(true, $request['decode']);
        $this->assertEquals('USD', $request['params']['currency_code']);
    }
}