<?php

namespace Ebanx\Http;

class Client
{
    protected $_curl;
    protected $_method;
    protected $_allowedMethods = array('POST', 'GET');
    protected $_action;
    protected $_params;

    public function setParams($params)
    {
        $this->_params = $params;
        $this->_params['integration_key'] = \Ebanx\Config::getIntegrationKey();

        return $this;
    }

    public function setMethod($method)
    {
        if (!in_array(strtoupper($method), $this->_allowedMethods))
        {
          throw new \InvalidArgumentException("The HTTP Client doesn't accept $method requests.");
        }

        $this->_method = $method;

        return $this;
    }

    public function setAction($action)
    {
        $this->_action = \Ebanx\Config::getURL() . $action;

        return $this;
    }

    public function send()
    {
        $this->_setupCurl();

        $jsonResponse = curl_exec($this->_curl);
        curl_close($this->_curl);

        return $jsonResponse;
    }

    protected function _setupCurl()
    {
        $params = http_build_query($this->_params);

        // POST requests
        if ($this->_method == 'POST')
        {
            $this->_curl = curl_init($this->_action);
            curl_setopt($this->_curl, CURLOPT_POST, true);
            curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $params);
        }
        // GET requests
        else if ($this->_method == 'GET')
        {
            $this->_curl = curl_init($this->_action . '?' . $params);
        }

        // We want to receive the returned data
        curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, true);
    }
}