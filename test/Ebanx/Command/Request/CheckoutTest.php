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

class CheckoutTest extends TestCase
{
    protected $params;

    public function setUp()
    {
        parent::setUp();

        $this->params = array(
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
        unset($this->params['currency_code']);
        \Ebanx\Ebanx::doRequest($this->params);
    }

    public function testValidateAmount()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'amount' was not supplied.");
        unset($this->params['amount']);
        \Ebanx\Ebanx::doRequest($this->params);
    }

    public function testValidateName()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'name' was not supplied.");
        unset($this->params['name']);
        \Ebanx\Ebanx::doRequest($this->params);
    }

    public function testValidateEmail()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'email' was not supplied.");
        unset($this->params['email']);
        \Ebanx\Ebanx::doRequest($this->params);
    }

    public function testValidatePaymentTypeCode()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment_type_code' was not supplied.");
        unset($this->params['payment_type_code']);
        \Ebanx\Ebanx::doRequest($this->params);
    }

    public function testValidateMerchantPaymentCode()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'merchant_payment_code' was not supplied.");
        unset($this->params['merchant_payment_code']);
        \Ebanx\Ebanx::doRequest($this->params);
    }

    public function testRequestIsCorrect()
    {
        $request = \Ebanx\Ebanx::doRequest($this->params);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://api.ebanx.com/ws/request', $request['action']);
        $this->assertEquals(true, $request['decode'], true);
        $this->assertEquals($this->params['currency_code'], $request['params']['currency_code']);
        $this->assertEquals($this->params['amount'], $request['params']['amount']);
        $this->assertEquals($this->params['name'], $request['params']['name']);
        $this->assertEquals($this->params['email'], $request['params']['email']);
        $this->assertEquals($this->params['payment_type_code'], $request['params']['payment_type_code']);
        $this->assertEquals($this->params['merchant_payment_code'], $request['params']['merchant_payment_code']);
    }
}