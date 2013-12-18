<?php

namespace Ebanx\Command\Request;

class Checkout
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