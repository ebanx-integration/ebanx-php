<?php

namespace Ebanx\Command;

class Query extends \Ebanx\Command\Command
{
    /**
     * Required params name
     * @var array
     */
    protected $_requiredParams = array(
        'integration_key'
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
    protected $_action = 'query';
}