<?php

namespace Ebanx\Command;

class Modify extends \Ebanx\Command\Command
{
    /**
     * Required params name
     * @var array
     */
    protected $_requiredParams = array(
        'integration_key'
      , 'operation'
      , 'mode'
      , 'payment.currency_code'
      , 'payment.amount_total'
      , 'payment.merchant_payment_code'
      , 'payment.name'
      , 'payment.email'
      , 'payment.payment_type_code'
      , 'payment.zipcode'
      , 'payment.address'
      , 'payment.street_number'
      , 'payment.city'
      , 'payment.state'
      , 'payment.phone_number'
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
    protected $_action = 'modify';
}