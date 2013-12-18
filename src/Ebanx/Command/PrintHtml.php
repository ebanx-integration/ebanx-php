<?php

namespace Ebanx\Command;

class PrintHtml
{
    /**
     * Required params name
     * @var array
     */
    protected $_requiredParams = array(
        'hash'
    );

    /**
     * The HTTP method
     * @var string
     */
    protected $_httpMethod = 'GET';
}