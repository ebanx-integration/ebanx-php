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

namespace Ebanx\Command;

/**
 * Command for the 'modify' action
 *
 * @author Gustavo Henrique Mascarenhas Machado gustavo@ebanx.com
 */
class Modify extends \Ebanx\Command\AbstractCommand
{
    /**
     * The HTTP method
     * @var string
     */
    protected $method = 'POST';

    /**
     * The action URL address
     * @var string
     */
    protected $action = 'modify';

    /**
     * Validates the request parameters
     * @param Ebanx\Command\Validator $validator The validator instance
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function validate($validator)
    {
        $validator->validatePresence('mode');
        $validator->validatePresence('payment.currency_code');
        $validator->validatePresence('payment.amount_total');
        $validator->validatePresence('payment.merchant_payment_code');
        $validator->validatePresence('payment.name');

        // Full mode payment validation
        if ($this->params['mode'] == 'full')
        {
            $validator->validatePresence('payment.document');

            // Credit card on full mode
            if (in_array($this->params['payment']['payment_type_code']
                , array('visa', 'mastercard', 'amex', 'elo', 'diners', 'discover', 'aura')))
            {
                $validator->validatePresence('payment.creditcard.card_number');
                $validator->validatePresence('payment.creditcard.card_name');
                $validator->validatePresence('payment.creditcard.card_due_date');
                $validator->validatePresence('payment.creditcard.card_cvv');
            }
        }

        $validator->validatePresence('payment.email');
        $validator->validatePresence('payment.payment_type_code');
        $validator->validatePresence('payment.zipcode');
        $validator->validatePresence('payment.address');
        $validator->validatePresence('payment.street_number');
        $validator->validatePresence('payment.city');
        $validator->validatePresence('payment.state');
        $validator->validatePresence('payment.phone_number');

        // Direct debt payment validation
        if ($this->params['payment']['payment_type_code'] == 'directdebt')
        {
            $validator->validatePresence('payment.directdebit');
            $validator->validatePresence('payment.directdebit.bank_code');
            $validator->validatePresence('payment.directdebit.bank_agency');
            $validator->validatePresence('payment.directdebit.bank_account');
        }

        // Gambiarration
        $this->params['integration_key'] = \Ebanx\Config::getIntegrationKey();
        $this->params = array('request_body' => json_encode($this->params));
    }
}