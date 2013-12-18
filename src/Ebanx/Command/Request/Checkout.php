<?php

namespace Ebanx\Command\Request;

class Checkout extends \Ebanx\Command\Command
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
      , 'payment_type_code'
    );

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
}