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
    protected $params;
    protected $bizParams;

    public function setUp()
    {
        parent::setUp();

        $this->getEbanxDirect();

        $this->params = array(
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

        $this->bizParams = array(
          'mode'      => 'full',
          'operation' => 'request',
          'payment'   => array(
            'merchant_payment_code' => time(),
            'amount_total'      => 100,
            'currency_code'     => 'USD',
            'person_type'       => 'business',
            'name'              => 'Acme Inc',
            'email'             => 'acme@example.com',
            'document'          => '73436722000167',
            'address'           => 'AV MIRACATU',
            'street_number'     => '2993',
            'street_complement' => 'CJ 5',
            'city'              => 'CURITIBA',
            'state'             => 'PR',
            'zipcode'           => '81500000',
            'country'           => 'br',
            'phone_number'      => '4132332354',
            'payment_type_code' => 'boleto',
            'responsible'       => array(
                'name'       => 'José Silva',
                'document'   => '25500376691',
                'birth_date' => '01/01/1970'
            )
          )
        );
    }

    public function testValidateMode()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'mode' was not supplied.");
        unset($this->params['mode']);
        \Ebanx\Ebanx::doRequest($this->params);
    }

    public function testValidateOperation()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'operation' was not supplied.");
        unset($this->params['operation']);
        \Ebanx\Ebanx::doRequest($this->params);
    }

    public function testValidateMerchantPaymentCode()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.merchant_payment_code' was not supplied.");
        unset($this->params['payment']['merchant_payment_code']);
        \Ebanx\Ebanx::doRequest($this->params);
    }

    public function testValidateAmount()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.amount_total' was not supplied.");
        unset($this->params['payment']['amount_total']);
        \Ebanx\Ebanx::doRequest($this->params);
    }

    public function testValidateCurrencyCode()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.currency_code' was not supplied.");
        unset($this->params['payment']['currency_code']);
        \Ebanx\Ebanx::doRequest($this->params);
    }

    public function testValidateName()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.name' was not supplied.");
        unset($this->params['payment']['name']);
        \Ebanx\Ebanx::doRequest($this->params);
    }

    public function testValidateEmail()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.email' was not supplied.");
        unset($this->params['payment']['email']);
        \Ebanx\Ebanx::doRequest($this->params);
    }

    // tests for brazil online, must refactor
    // public function testValidateBirthDate()
    // {
    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.birth_date' was not supplied.");
    //     unset($this->params['payment']['birth_date']);
    //     \Ebanx\Ebanx::doRequest($this->params);
    // }

    // public function testValidateDocument()
    // {
    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.document' was not supplied.");
    //     unset($this->params['payment']['document']);
    //     \Ebanx\Ebanx::doRequest($this->params);
    // }

    // public function testValidateAddress()
    // {
    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.address' was not supplied.");
    //     unset($this->params['payment']['address']);
    //     \Ebanx\Ebanx::doRequest($this->params);
    // }

    // public function testValidateStreetNumber()
    // {
    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.street_number' was not supplied.");
    //     unset($this->params['payment']['street_number']);
    //     \Ebanx\Ebanx::doRequest($this->params);
    // }

    // public function testValidateCity()
    // {
    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.city' was not supplied.");
    //     unset($this->params['payment']['city']);
    //     \Ebanx\Ebanx::doRequest($this->params);
    // }

    // public function testValidateState()
    // {
    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.state' was not supplied.");
    //     unset($this->params['payment']['state']);
    //     \Ebanx\Ebanx::doRequest($this->params);
    // }

    // public function testValidateZipcode()
    // {
    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.zipcode' was not supplied.");
    //     unset($this->params['payment']['zipcode']);
    //     \Ebanx\Ebanx::doRequest($this->params);
    // }

    // public function testValidatePhoneNumber()
    // {
    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.phone_number' was not supplied.");
    //     unset($this->params['payment']['phone_number']);
    //     \Ebanx\Ebanx::doRequest($this->params);
    // }

    public function testValidatePaymentTypeCode()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.payment_type_code' was not supplied.");
        $this->params['payment']['payment_type_code'] = NULL; // weird bug fix, undefined index payment_type_code
        \Ebanx\Ebanx::doRequest($this->params);
    }

    // public function testValidateBusinessResponsibleName()
    // {
    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.responsible.name' was not supplied.");
    //     unset($this->bizParams['payment']['responsible']['name']);
    //     \Ebanx\Ebanx::doRequest($this->bizParams);
    // }

    // public function testValidateBusinessResponsibleDocument()
    // {
    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.responsible.document' was not supplied.");
    //     unset($this->bizParams['payment']['responsible']['document']);
    //     \Ebanx\Ebanx::doRequest($this->bizParams);
    // }

    // public function testValidateBusinessResponsibleBirthdate()
    // {
    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.responsible.birth_date' was not supplied.");
    //     unset($this->bizParams['payment']['responsible']['birth_date']);
    //     \Ebanx\Ebanx::doRequest($this->bizParams);
    // }

    /**
     * Tests the full mode credit card validations
     * @todo refactor repetitive tests
     */
    // public function testValidateFullModeCards()
    // {
    //     $this->params['payment']['payment_type_code'] = 'visa';
    //     $this->params['payment']['creditcard'] = array(
    //         'card_number'   => '4444444444444444'
    //       , 'card_name'     => 'José da Silva'
    //       , 'card_due_date' => '10/2020'
    //       , 'card_cvv'      => '123'
    //     );

    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.creditcard.card_number' was not supplied.");
    //     $params = $this->params;
    //     unset($params['payment']['creditcard']['card_number']);
    //     \Ebanx\Ebanx::doRequest($params);

    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.creditcard.card_name' was not supplied.");
    //     $params = $this->params;
    //     unset($params['payment']['creditcard']['card_name']);
    //     \Ebanx\Ebanx::doRequest($params);

    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.creditcard.card_due_date' was not supplied.");
    //     $params = $this->params;
    //     unset($params['payment']['creditcard']['card_due_date']);
    //     \Ebanx\Ebanx::doRequest($params);

    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.creditcard.card_cvv' was not supplied.");
    //     $params = $this->params;
    //     unset($params['payment']['creditcard']['card_cvv']);
    //     \Ebanx\Ebanx::doRequest($params);
    // }

    /**
     * Tests the full mode direct debit validations
     * @todo refactor repetitive tests
     */
    // public function testValidateFullModeDirectDebit()
    // {
    //     $this->params['payment']['payment_type_code'] = 'directdebit';
    //     $this->params['payment']['directdebit'] = array(
    //         'bank_code'    => '1'
    //       , 'bank_agency'  => '1234'
    //       , 'bank_account' => '1234-5'
    //     );

    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.directdebit.bank_code' was not supplied.");
    //     $params = $this->params;
    //     unset($params['payment']['directdebit']['bank_code']);
    //     \Ebanx\Ebanx::doRequest($params);

    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.directdebit.bank_agency' was not supplied.");
    //     $params = $this->params;
    //     unset($params['payment']['directdebit']['bank_agency']);
    //     \Ebanx\Ebanx::doRequest($params);

    //     $this->setExpectedException('InvalidArgumentException', "The parameter 'payment.directdebit.bank_account' was not supplied.");
    //     $params = $this->params;
    //     unset($params['payment']['directdebit']['bank_account']);
    //     \Ebanx\Ebanx::doRequest($params);
    // }

    /**
     * Tests a simple request
     * @todo refactor repetitive code
     */
    public function testPersonRequestIsCorrect()
    {
        // This request is returned as a JSON object
        $request = \Ebanx\Ebanx::doRequest($this->params);
        $params  = json_decode($request['params']['request_body'], true);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://api.ebanx.com/ws/direct', $request['action']);
        $this->assertEquals(true, $request['decode'], true);
        $this->assertEquals($this->params['mode'], $params['mode']);
        $this->assertEquals($this->params['operation'], $params['operation']);
        $this->assertEquals($this->params['payment']['merchant_payment_code'], $params['payment']['merchant_payment_code']);
        $this->assertEquals($this->params['payment']['amount_total'], $params['payment']['amount_total']);
        $this->assertEquals($this->params['payment']['currency_code'], $params['payment']['currency_code']);
        $this->assertEquals($this->params['payment']['name'], $params['payment']['name']);
        $this->assertEquals($this->params['payment']['email'], $params['payment']['email']);
        $this->assertEquals($this->params['payment']['birth_date'], $params['payment']['birth_date']);
        $this->assertEquals($this->params['payment']['document'], $params['payment']['document']);
        $this->assertEquals($this->params['payment']['address'], $params['payment']['address']);
        $this->assertEquals($this->params['payment']['street_number'], $params['payment']['street_number']);
        $this->assertEquals($this->params['payment']['street_complement'], $params['payment']['street_complement']);
        $this->assertEquals($this->params['payment']['city'], $params['payment']['city']);
        $this->assertEquals($this->params['payment']['state'], $params['payment']['state']);
        $this->assertEquals($this->params['payment']['zipcode'], $params['payment']['zipcode']);
        $this->assertEquals($this->params['payment']['country'], $params['payment']['country']);
        $this->assertEquals($this->params['payment']['phone_number'], $params['payment']['phone_number']);
        $this->assertEquals($this->params['payment']['payment_type_code'], $params['payment']['payment_type_code']);
    }

    /**
     * Tests a simple business request
     * @todo refactor repetitive code
     */
    public function testBusinessRequestIsCorrect()
    {
        // This request is returned as a JSON object
        $request = \Ebanx\Ebanx::doRequest($this->bizParams);
        $params  = json_decode($request['params']['request_body'], true);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://api.ebanx.com/ws/direct', $request['action']);
        $this->assertEquals(true, $request['decode'], true);
        $this->assertEquals($this->bizParams['mode'], $params['mode']);
        $this->assertEquals($this->bizParams['operation'], $params['operation']);
        $this->assertEquals($this->bizParams['payment']['person_type'], $params['payment']['person_type']);
        $this->assertEquals($this->bizParams['payment']['merchant_payment_code'], $params['payment']['merchant_payment_code']);
        $this->assertEquals($this->bizParams['payment']['amount_total'], $params['payment']['amount_total']);
        $this->assertEquals($this->bizParams['payment']['currency_code'], $params['payment']['currency_code']);
        $this->assertEquals($this->bizParams['payment']['name'], $params['payment']['name']);
        $this->assertEquals($this->bizParams['payment']['email'], $params['payment']['email']);
        $this->assertEquals($this->bizParams['payment']['document'], $params['payment']['document']);
        $this->assertEquals($this->bizParams['payment']['address'], $params['payment']['address']);
        $this->assertEquals($this->bizParams['payment']['street_number'], $params['payment']['street_number']);
        $this->assertEquals($this->bizParams['payment']['street_complement'], $params['payment']['street_complement']);
        $this->assertEquals($this->bizParams['payment']['city'], $params['payment']['city']);
        $this->assertEquals($this->bizParams['payment']['state'], $params['payment']['state']);
        $this->assertEquals($this->bizParams['payment']['zipcode'], $params['payment']['zipcode']);
        $this->assertEquals($this->bizParams['payment']['country'], $params['payment']['country']);
        $this->assertEquals($this->bizParams['payment']['phone_number'], $params['payment']['phone_number']);
        $this->assertEquals($this->bizParams['payment']['payment_type_code'], $params['payment']['payment_type_code']);
        $this->assertEquals($this->bizParams['payment']['responsible']['name'], $params['payment']['responsible']['name']);
        $this->assertEquals($this->bizParams['payment']['responsible']['document'], $params['payment']['responsible']['document']);
        $this->assertEquals($this->bizParams['payment']['responsible']['birth_date'], $params['payment']['responsible']['birth_date']);
    }
}