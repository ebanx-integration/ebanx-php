<?php

namespace Ebanx\Command;

abstract class AbstractCommand
{
    /**
     * Associative array of params
     * @var array
     */
    protected $_params = array();

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
     * The response type - HTML or JSON
     * @var string
     */
    protected $_responseType = 'JSON';

    /**
     * Validates the request parameters
     * @param Ebanx\Command\Validator $validator The validator instance
     * @return mixed
     * @throws InvalidArgumentException
     */
    abstract protected function _validate($validator);

    /**
     * Executes the command in the EBANX API
     * @param  array $params The request parameters
     * @return mixed
     */
    public function execute($params)
    {
        $this->_params = $params;
        $this->_validate(new \Ebanx\Command\Validator($this->_params));

        $client = new \Ebanx\Http\Client();
        $client->setParams($this->_params)
               ->setMethod($this->_method)
               ->setAction($this->_action)
               ->setResponseType($this->_responseType);

        return $client->send();
    }
}