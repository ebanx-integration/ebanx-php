<?php

namespace Ebanx\Command;

class Command
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
    protected $_method = 'POST';

    /**
     * The action URL address
     * @var string
     */
    protected $_action = null;

    /**
     * Validates parameters presence
     * @return mixed
     */
    protected function _validateParams()
    {
        $paramKeys    = sort(array_keys($this->_params));
        $requiredKeys = sort(array_keys($this->_requiredParams));

        if ($paramKeys == $requiredKeys)
        {
            return true;
        }

        throw new \InvalidArgumentException('An invalid number of arguments was supplied to the command.');
    }

    /**
     * Executes the command in the EBANX API
     * @param  array $params The request parameters
     * @return mixed
     */
    public function execute($params)
    {
        $this->_params = $params;
        $this->_validateParams();

        $client = new \Ebanx\Http\Client();
        $client->setParams($params)
               ->setMethod($this->_method)
               ->setAction($this->_action);

        return $client->send();
    }
}