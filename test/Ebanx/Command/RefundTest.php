<?php
/**
 * Copyright (c) 2013, EBANX Tecnologia da Informação Ltda.
 *  All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this
 * list of conditions and the following disclaimer.
 *
 * Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *
 * Neither the name of EBANX nor the names of its
 * contributors may be used to endorse or promote products derived from
 * this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

class RefundTest extends TestCase
{
    protected $params;

    public function setUp()
    {
        parent::setUp();

        $this->params = array(
            'operation'   => 'request'
          , 'hash'        => md5(time())
          , 'amount'      => 100.00
          , 'description' => 'Lorem ipsum dolor sit amet.'
        );
    }

    public function testValidateOperation()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'operation' was not supplied.");
        unset($this->params['operation']);
        \Ebanx\Ebanx::doRefund($this->params);
    }

    public function testValidateRequestHash()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'hash' was not supplied.");
        unset($this->params['hash']);
        \Ebanx\Ebanx::doRefund($this->params);
    }

    public function testValidateRequestAmount()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'amount' was not supplied.");
        unset($this->params['amount']);
        \Ebanx\Ebanx::doRefund($this->params);
    }

    public function testValidateRequestDescription()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'description' was not supplied.");
        unset($this->params['description']);
        \Ebanx\Ebanx::doRefund($this->params);
    }

    public function testValidateCancelRefundCodeAndRefundID()
    {
        $this->setExpectedException('InvalidArgumentException', "Either the parameter 'merchant_refund_code' or 'refund_id' must be supplied.");
        $params = array('operation' => 'cancel');
        \Ebanx\Ebanx::doRefund($params);
    }

    public function testRequestCancel()
    {
        $request = \Ebanx\Ebanx::doRefund($this->params);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://api.ebanx.com/ws/refund', $request['action']);
        $this->assertEquals(true, $request['decode']);
        $this->assertEquals($this->params['operation'], $request['params']['operation']);
        $this->assertEquals($this->params['hash'], $request['params']['hash']);
        $this->assertEquals($this->params['amount'], $request['params']['amount']);
        $this->assertEquals($this->params['description'], $request['params']['description']);
    }

    public function testRequestRequestWithRefundID()
    {
        $params = array(
            'operation' => 'cancel'
          , 'refund_id' => time()
        );

        $request = \Ebanx\Ebanx::doRefund($params);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://api.ebanx.com/ws/refund', $request['action']);
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

        $request = \Ebanx\Ebanx::doRefund($params);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://api.ebanx.com/ws/refund', $request['action']);
        $this->assertEquals(true, $request['decode']);
        $this->assertEquals($params['operation'], $request['params']['operation']);
        $this->assertEquals($params['merchant_refund_code'], $request['params']['merchant_refund_code']);
    }
}