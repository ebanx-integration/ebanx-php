<?php

class RefundTest extends TestCase
{
    protected $_params;

    public function setUp()
    {
        parent::setUp();

        $this->_params = array(
            'operation'   => 'request'
          , 'hash'        => md5(time())
          , 'amount'      => 100.00
          , 'description' => 'Lorem ipsum dolor sit amet.'
        );
    }

    public function testValidateOperation()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'operation' was not supplied.");
        unset($this->_params['operation']);
        $this->_ebanx->doRefund($this->_params);
    }

    public function testValidateRequestHash()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'hash' was not supplied.");
        unset($this->_params['hash']);
        $this->_ebanx->doRefund($this->_params);
    }

    public function testValidateRequestAmount()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'amount' was not supplied.");
        unset($this->_params['amount']);
        $this->_ebanx->doRefund($this->_params);
    }

    public function testValidateRequestDescription()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'description' was not supplied.");
        unset($this->_params['description']);
        $this->_ebanx->doRefund($this->_params);
    }

    public function testValidateCancelRefundCodeAndRefundID()
    {
        $this->setExpectedException('InvalidArgumentException', "Either the parameter 'merchant_refund_code' or 'refund_id' must be supplied.");
        $params = array('operation' => 'cancel');
        $this->_ebanx->doRefund($params);
    }

    public function testRequestCancel()
    {
        $request = $this->_ebanx->doRefund($this->_params);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://www.ebanx.com/pay/ws/refund', $request['action']);
        $this->assertEquals(true, $request['decode']);
        $this->assertEquals($this->_params['operation'], $request['params']['operation']);
        $this->assertEquals($this->_params['hash'], $request['params']['hash']);
        $this->assertEquals($this->_params['amount'], $request['params']['amount']);
        $this->assertEquals($this->_params['description'], $request['params']['description']);
    }

    public function testRequestRequestWithRefundID()
    {
        $params = array(
            'operation' => 'cancel'
          , 'refund_id' => time()
        );

        $request = $this->_ebanx->doRefund($params);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://www.ebanx.com/pay/ws/refund', $request['action']);
        $this->assertEquals(true, $request['decode']);
        $this->assertEquals($params['operation'], $request['params']['operation']);
        $this->assertEquals($params['refund_id'], $request['params']['refund_id']);
    }

    public function testRequestRequestWithMerchantRefundCode()
    {
        $params = array(
            'operation' => 'cancel'
          , 'merchant_refund_code' => time()
        );

        $request = $this->_ebanx->doRefund($params);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://www.ebanx.com/pay/ws/refund', $request['action']);
        $this->assertEquals(true, $request['decode']);
        $this->assertEquals($params['operation'], $request['params']['operation']);
        $this->assertEquals($params['merchant_refund_code'], $request['params']['merchant_refund_code']);
    }
}