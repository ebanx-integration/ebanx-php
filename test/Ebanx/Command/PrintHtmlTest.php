<?php

class PrintHtmlTest extends TestCase
{
    public function testValidateHash()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'hash' was not supplied.");
        $this->_ebanx->doPrintHtml(array());
    }

    public function testRequest()
    {
        $hash = md5(time());
        $request = $this->_ebanx->doPrintHtml(array('hash' => $hash));

        $this->assertEquals('GET', $request['method']);
        $this->assertEquals('https://www.ebanx.com/pay/ws/boleto/printHTML', $request['action']);
        $this->assertEquals(false, $request['decode']);
        $this->assertEquals($hash, $request['params']['hash']);
    }
}