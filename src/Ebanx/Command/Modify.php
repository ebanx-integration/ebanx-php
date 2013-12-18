<?php

namespace Ebanx\Command;

class Modify
{
    /**
     * Required params name
     * @var array
     */
    protected $_requiredParams = array(
        'integration_key'
      , 'currency_code'
      , 'amount'
      , 'merchant_payment_code'
      , 'name'
      , 'email'
    );

    /**
     * The HTTP method
     * @var string
     */
    protected $_httpMethod = 'POST';
}