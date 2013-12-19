<?php

namespace Ebanx\Command;

class Refund extends \Ebanx\Command\AbstractCommand
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
    protected $_action = 'refund';

    /**
     * Validates the request parameters
     * @param Ebanx\Command\Validator $validator The validator instance
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function _validate($validator)
    {
        $validator->validatePresence('operation');

        // Validation for a new refund request
        if ($this->_params['operation'] == 'request')
        {
            $validator->validatePresence('hash');
            $validator->validatePresence('amount');
            $validator->validatePresence('description');
        }
        // Validation a cancel refund request
        else
        {
            $validator->validatePresenceOr('merchant_refund_code', 'refund_id');
        }
    }
}