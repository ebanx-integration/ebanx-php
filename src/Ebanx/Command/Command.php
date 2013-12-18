<?php

namespace Ebanx;

abstract class Command
{
    /**
     * Associative array of params
     * @var array
     */
    protected $_params = array();

    /**
     * Required params name
     * @var array
     */
    protected $_requiredParams = array();

    /**
     * The HTTP method
     * @var string
     */
    protected $_httpMethod = 'POST';

    public function setParams($params)
    {
        $this->_params = $params;
    }

    /**
     * Validates parameters presence
     * @return mixed
     */
    protected function _validateParamsPresence()
    {
        $paramKeys    = sort(array_keys($this->_params));
        $requiredKeys = sort(array_keys($this->_requiredParams));

        if ($params == $requiredKeys)
        {
            return true;
        }

        throw new InvalidArgumentException('An invalid number of arguments was supplied to the command.');
    }

    //abstract function ();
}