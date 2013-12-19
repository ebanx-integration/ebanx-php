<?php

namespace Ebanx\Command;

class RefundOrCancel extends \Ebanx\Command\AbstractCommand
{
    /**
     * The HTTP method
     * @var string
     */
    protected $_method = 'GET';

    /**
     * The action URL address
     * @var string
     */
    protected $_action = 'capture';

    /**
     * Validates the request parameters
     * @param Ebanx\Command\Validator $validator The validator instance
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function _validate($validator)
    {
        $validator->validatePresenceOr('hash', 'merchant_payment_code');
    }
}