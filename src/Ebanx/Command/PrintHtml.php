<?php

namespace Ebanx\Command;

class PrintHtml extends \Ebanx\Command\Command
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
    protected $_method = 'GET';

    /**
     * The action URL address
     * @var string
     */
    protected $_action = 'boleto/printHTML';
}