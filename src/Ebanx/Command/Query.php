<?php

namespace Ebanx\Command;

class Query
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
    protected $_httpMethod = 'GET';
}