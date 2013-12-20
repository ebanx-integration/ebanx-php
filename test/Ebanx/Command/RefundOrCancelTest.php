<?php

class RefundOrCancelTest extends TestCase
{
    protected $_params;

    public function setUp()
    {
        parent::setUp();

        $this->_params = array(
            'hash'        => md5(time())
          , 'description' => 'Lorem ipsum dolor sit amet.'
        );
    }

    public function testValidateHash()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'hash' was not supplied.");
        unset($this->_params['hash']);
        $this->_ebanx->doRefundOrCancel($this->_params);
    }

    public function testValidateDescription()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'description' was not supplied.");
        unset($this->_params['description']);
        $this->_ebanx->doRefundOrCancel($this->_params);
    }

    public function testRequest()
    {
        $request = $this->_ebanx->doRefundOrCancel($this->_params);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://www.ebanx.com/pay/ws/refundOrCancel', $request['action']);
        $this->assertEquals(true, $request['decode']);
        $this->assertEquals($this->_params['hash'], $request['params']['hash']);
        $this->assertEquals($this->_params['description'], $request['params']['description']);
    }
}