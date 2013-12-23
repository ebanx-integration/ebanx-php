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

class DirectTest extends TestCase
{
    protected $_params;

    public function setUp()
    {
        parent::setUp();

        $this->_getEbanxDirect();

        $this->_params = array(
          'mode'      => 'full',
          'operation' => 'request',
          'payment'   => array(
            'merchant_payment_code' => time(),
            'amount_total'      => 100,
            'currency_code'     => 'USD',
            'name'              => 'ROBERTO CARLOS',
            'email'             => 'roberto@example.com',
            'birth_date'        => '12/04/1979',
            'document'          => '88282672165',
            'address'           => 'AV MIRACATU',
            'street_number'     => '2993',
            'street_complement' => 'CJ 5',
            'city'              => 'CURITIBA',
            'state'             => 'PR',
            'zipcode'           => '81500000',
            'country'           => 'br',
            'phone_number'      => '4132332354',
            'payment_type_code' => 'boleto'
          )
        );
    }

    public function testValidateMode()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'mode' was not supplied.");
        unset($this->_params['mode']);
        \Ebanx\Ebanx::doRequest($this->_params);
    }

    public function testValidateOperation()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'operation' was not supplied.");
        unset($this->_params['operation']);
        \Ebanx\Ebanx::doRequest($this->_params);
    }

    public function testValidateMerchantPaymentCode()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.merchant_payment_code' was not supplied.");
        unset($this->_params['payment']['merchant_payment_code']);
        \Ebanx\Ebanx::doRequest($this->_params);
    }

    public function testValidateAmount()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.amount_total' was not supplied.");
        unset($this->_params['payment']['amount_total']);
        \Ebanx\Ebanx::doRequest($this->_params);
    }

    public function testValidateCurrencyCode()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.currency_code' was not supplied.");
        unset($this->_params['payment']['currency_code']);
        \Ebanx\Ebanx::doRequest($this->_params);
    }

    public function testValidateName()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.name' was not supplied.");
        unset($this->_params['payment']['name']);
        \Ebanx\Ebanx::doRequest($this->_params);
    }

    public function testValidateEmail()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.email' was not supplied.");
        unset($this->_params['payment']['email']);
        \Ebanx\Ebanx::doRequest($this->_params);
    }

    public function testValidateBirthDate()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.birth_date' was not supplied.");
        unset($this->_params['payment']['birth_date']);
        \Ebanx\Ebanx::doRequest($this->_params);
    }

    public function testValidateDocument()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.document' was not supplied.");
        unset($this->_params['payment']['document']);
        \Ebanx\Ebanx::doRequest($this->_params);
    }

    public function testValidateAddress()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.address' was not supplied.");
        unset($this->_params['payment']['address']);
        \Ebanx\Ebanx::doRequest($this->_params);
    }

    public function testValidateStreetNumber()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.street_number' was not supplied.");
        unset($this->_params['payment']['street_number']);
        \Ebanx\Ebanx::doRequest($this->_params);
    }

    public function testValidateCity()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.city' was not supplied.");
        unset($this->_params['payment']['city']);
        \Ebanx\Ebanx::doRequest($this->_params);
    }

    public function testValidateState()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.state' was not supplied.");
        unset($this->_params['payment']['state']);
        \Ebanx\Ebanx::doRequest($this->_params);
    }

    public function testValidateZipcode()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.zipcode' was not supplied.");
        unset($this->_params['payment']['zipcode']);
        \Ebanx\Ebanx::doRequest($this->_params);
    }

    public function testValidatePhoneNumber()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.phone_number' was not supplied.");
        unset($this->_params['payment']['phone_number']);
        \Ebanx\Ebanx::doRequest($this->_params);
    }

    public function testValidatePaymentTypeCode()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.payment_type_code' was not supplied.");
        $this->_params['payment']['payment_type_code'] = NULL; // weird bug fix, undefined index payment_type_code
        \Ebanx\Ebanx::doRequest($this->_params);
    }

    /**
     * Tests the full mode credit card validations
     * @todo refactor repetitive tests
     */
    public function testValidateFullModeCards()
    {
        $this->_params['payment']['payment_type_code'] = 'visa';
        $this->_params['payment']['creditcard'] = array(
            'card_number'   => '4444444444444444'
          , 'card_name'     => 'José da Silva'
          , 'card_due_date' => '10/2020'
          , 'card_cvv'      => '123'
        );

        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.creditcard.card_number' was not supplied.");
        $params = $this->_params;
        unset($params['payment']['creditcard']['card_number']);
        \Ebanx\Ebanx::doRequest($params);

        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.creditcard.card_name' was not supplied.");
        $params = $this->_params;
        unset($params['payment']['creditcard']['card_name']);
        \Ebanx\Ebanx::doRequest($params);

        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.creditcard.card_due_date' was not supplied.");
        $params = $this->_params;
        unset($params['payment']['creditcard']['card_due_date']);
        \Ebanx\Ebanx::doRequest($params);

        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.creditcard.card_cvv' was not supplied.");
        $params = $this->_params;
        unset($params['payment']['creditcard']['card_cvv']);
        \Ebanx\Ebanx::doRequest($params);
    }

    /**
     * Tests the full mode direct debit validations
     * @todo refactor repetitive tests
     */
    public function testValidateFullModeDirectDebit()
    {
        $this->_params['payment']['payment_type_code'] = 'directdebit';
        $this->_params['payment']['directdebit'] = array(
            'bank_code'    => '1'
          , 'bank_agency'  => '1234'
          , 'bank_account' => '1234-5'
        );

        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.directdebit.bank_code' was not supplied.");
        $params = $this->_params;
        unset($params['payment']['directdebit']['bank_code']);
        \Ebanx\Ebanx::doRequest($params);

        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.directdebit.bank_agency' was not supplied.");
        $params = $this->_params;
        unset($params['payment']['directdebit']['bank_agency']);
        \Ebanx\Ebanx::doRequest($params);

        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.directdebit.bank_account' was not supplied.");
        $params = $this->_params;
        unset($params['payment']['directdebit']['bank_account']);
        \Ebanx\Ebanx::doRequest($params);
    }

    /**
     * Tests a simple request
     * @todo refactor repetitive code
     */
    public function testRequestIsCorrect()
    {
        // This request is returned as a JSON object
        $request = \Ebanx\Ebanx::doRequest($this->_params);
        $params  = json_decode($request['params']['request_body'], true);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://www.ebanx.com/pay/ws/direct', $request['action']);
        $this->assertEquals(true, $request['decode'], true);
        $this->assertEquals($this->_params['mode'], $params['mode']);
        $this->assertEquals($this->_params['operation'], $params['operation']);
        $this->assertEquals($this->_params['payment']['merchant_payment_code'], $params['payment']['merchant_payment_code']);
        $this->assertEquals($this->_params['payment']['amount_total'], $params['payment']['amount_total']);
        $this->assertEquals($this->_params['payment']['currency_code'], $params['payment']['currency_code']);
        $this->assertEquals($this->_params['payment']['name'], $params['payment']['name']);
        $this->assertEquals($this->_params['payment']['email'], $params['payment']['email']);
        $this->assertEquals($this->_params['payment']['birth_date'], $params['payment']['birth_date']);
        $this->assertEquals($this->_params['payment']['document'], $params['payment']['document']);
        $this->assertEquals($this->_params['payment']['address'], $params['payment']['address']);
        $this->assertEquals($this->_params['payment']['street_number'], $params['payment']['street_number']);
        $this->assertEquals($this->_params['payment']['street_complement'], $params['payment']['street_complement']);
        $this->assertEquals($this->_params['payment']['city'], $params['payment']['city']);
        $this->assertEquals($this->_params['payment']['state'], $params['payment']['state']);
        $this->assertEquals($this->_params['payment']['zipcode'], $params['payment']['zipcode']);
        $this->assertEquals($this->_params['payment']['country'], $params['payment']['country']);
        $this->assertEquals($this->_params['payment']['phone_number'], $params['payment']['phone_number']);
        $this->assertEquals($this->_params['payment']['payment_type_code'], $params['payment']['payment_type_code']);
    }
}