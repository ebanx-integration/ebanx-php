<?php

class CancelTest extends TestCase
{
    public function testValidateHash()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'hash' was not supplied.");
        $this->_ebanx->doCancel(array());
    }

    public function testCancelRequestIsCorrect()
    {
        $hash = md5(time());
        $request = $this->_ebanx->doCancel(array('hash' => $hash));

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://www.ebanx.com/pay/ws/cancel', $request['action']);
        $this->assertEquals(true, $request['decode'], true);
        $this->assertEquals($hash, $request['params']['hash'], $hash);
    }
}