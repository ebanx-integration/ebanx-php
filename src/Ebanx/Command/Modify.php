<?php

namespace Ebanx\Command;

class Modify extends \Ebanx\Command\AbstractCommand
{
    /**
     * The HTTP method
     * @var string
     */
    protected $_method = 'POST';

    /**
     * The action URL address
     * @var string
     */
    protected $_action = 'modify';

    /**
     * Validates the request parameters
     * @param Ebanx\Command\Validator $validator The validator instance
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function _validate($validator)
    {
        $validator->validatePresence('mode');
        $validator->validatePresence('payment.currency_code');
        $validator->validatePresence('payment.amount_total');
        $validator->validatePresence('payment.merchant_payment_code');
        $validator->validatePresence('payment.name');

        // Full mode payment validation
        if ($this->_params['mode'] == 'full')
        {
            $validator->validatePresence('payment.document');

            // Credit card on full mode
            if (in_array($this->_params['payment']['payment_type_code']
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
        if ($this->_params['payment']['payment_type_code'] == 'directdebt')
        {
            $validator->validatePresence('payment.directdebit');
            $validator->validatePresence('payment.directdebit.bank_code');
            $validator->validatePresence('payment.directdebit.bank_agency');
            $validator->validatePresence('payment.directdebit.bank_account');
        }

        // Gambiarration
        $this->_params['integration_key'] = \Ebanx\Config::getIntegrationKey();
        $this->_params = array('request_body' => json_encode($this->_params));
    }
}