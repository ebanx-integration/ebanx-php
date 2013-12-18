<?php

namespace Ebanx\Command;

class Exchange extends \Ebanx\Command\Command
{
    /**
     * Required params name
     * @var array
     */
    protected $_requiredParams = array(
        'integration_key'
      , 'currency_code'
    );

    /**
     * The HTTP method
     * @var string
     */
    protected $_method = 'GET';

    /**
     * The action URL address
     * @var string
     */
    protected $_action = 'exchange';
}