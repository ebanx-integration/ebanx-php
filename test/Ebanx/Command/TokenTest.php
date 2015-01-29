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

class TokenTest extends TestCase
{
    protected $params;

    public function setUp()
    {
        parent::setUp();

        $this->params = array(
            'payment_type_code' => 'visa'
          , 'creditcard'        => array(
                'card_number'   => '4111111111111111'
              , 'card_name'     => 'Jose da Silva'
              , 'card_due_date' => '10/2018'
              , 'card_cvv'      => '123'
            )
        );
    }

    public function testValidatePaymentTypeCode()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment_type_code' was not supplied.");
        unset($this->params['payment_type_code']);
        \Ebanx\Ebanx::doToken($this->params);
    }

    public function testValidateCreditCardNumber()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'creditcard.card_number' was not supplied.");
        unset($this->params['creditcard']['card_number']);
        \Ebanx\Ebanx::doToken($this->params);
    }

    public function testValidateCreditCardName()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'creditcard.card_name' was not supplied.");
        unset($this->params['creditcard']['card_name']);
        \Ebanx\Ebanx::doToken($this->params);
    }

    public function testValidateCreditCardDueDate()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'creditcard.card_due_date' was not supplied.");
        unset($this->params['creditcard']['card_due_date']);
        \Ebanx\Ebanx::doToken($this->params);
    }

    public function testValidateCreditCardCVV()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'creditcard.card_cvv' was not supplied.");
        unset($this->params['creditcard']['card_cvv']);
        \Ebanx\Ebanx::doToken($this->params);
    }

    /**
     * Test if a token request is valid
     * @todo refator repetitive code
     */
    public function testRequestToken()
    {
        $request = \Ebanx\Ebanx::doToken($this->params);
        $params  = json_decode($request['params']['request_body'], true);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://api.ebanx.com/ws/token', $request['action']);
        $this->assertEquals(true, $request['decode']);
        $this->assertEquals($this->params['payment_type_code'], $params['payment_type_code']);
        $this->assertEquals($this->params['creditcard']['card_number'],
                            $params['creditcard']['card_number']);
        $this->assertEquals($this->params['creditcard']['card_name'],
                            $params['creditcard']['card_name']);
        $this->assertEquals($this->params['creditcard']['card_due_date'],
                            $params['creditcard']['card_due_date']);
        $this->assertEquals($this->params['creditcard']['card_cvv'],
                            $params['creditcard']['card_cvv']);
    }
}