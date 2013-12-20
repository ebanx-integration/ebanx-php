<?php

class CaptureTest extends TestCase
{
    public function testValidateHashAndMerchantPaymentCode()
    {
        $this->setExpectedException('InvalidArgumentException', "Either the parameter 'hash' or 'merchant_payment_code' must be supplied.");
        $this->_ebanx->doCapture(array());
    }

    public function testRequestWithHash()
    {
        $hash = md5(time());
        $request = $this->_ebanx->doCapture(array('hash' => $hash));

        $this->assertEquals('GET', $request['method']);
        $this->assertEquals('https://www.ebanx.com/pay/ws/capture', $request['action']);
        $this->assertEquals(true, $request['decode']);
        $this->assertEquals($hash, $request['params']['hash']);
    }

    public function testRequestWithMerchantPaymentCode()
    {
        $code = time();
        $request = $this->_ebanx->doCapture(array('merchant_payment_code' => $code));

        $this->assertEquals('GET', $request['method']);
        $this->assertEquals('https://www.ebanx.com/pay/ws/capture', $request['action']);
        $this->assertEquals(true, $request['decode']);
        $this->assertEquals($code, $request['params']['merchant_payment_code']);
    }
}