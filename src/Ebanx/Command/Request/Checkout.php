<?php

namespace Ebanx\Command\Request;

class Checkout extends \Ebanx\Command\AbstractCommand
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
    protected $_action = 'request';

    /**
     * Validates the request parameters
     * @param Ebanx\Command\Validator $validator The validator instance
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function _validate($validator)
    {
        $validator->validatePresence('currency_code');
        $validator->validatePresence('amount');
        $validator->validatePresence('merchant_payment_code');
        $validator->validatePresence('name');
        $validator->validatePresence('email');
        $validator->validatePresence('payment_type_code');
    }
}