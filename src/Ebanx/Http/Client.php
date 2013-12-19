<?php

namespace Ebanx\Http;

class Client
{
    /**
     * The cURL resource
     * @var resource
     */
    protected $_curl;

    /**
     * The request HTTP method
     * @var string
     */
    protected $_method;

    /**
     * The allowed HTTP methods
     * @var array
     */
    protected $_allowedMethods = array('POST', 'GET');

    /**
     * The HTTP action (URI)
     * @var string
     */
    protected $_action;

    /**
     * The request parameters
     * @var array
     */
    protected $_params;

    /**
     * Flag to call json_decode on response
     * @var boolean
     */
    protected $_decodeResponse = false;

    /**
     * Set the request parameters
     * @param array $params The request parameters
     * @return Ebanx\Http\Client
     */
    public function setParams($params)
    {
        $this->_params = $params;
        $this->_params['integration_key'] = \Ebanx\Config::getIntegrationKey();

        return $this;
    }

    /**
     * Set the request HTTP method
     * @param string $method The request HTTP method
     * @return Ebanx\Http\Client
     */
    public function setMethod($method)
    {
        if (!in_array(strtoupper($method), $this->_allowedMethods))
        {
          throw new \InvalidArgumentException("The HTTP Client doesn't accept $method requests.");
        }

        $this->_method = $method;
        return $this;
    }

    /**
     * Set the request target URI
     * @param string $action The target URI
     * @return Ebanx\Http\Client
     */
    public function setAction($action)
    {
        $this->_action = \Ebanx\Config::getURL() . $action;
        return $this;
    }

    /**
     * Set the decodeResponse flag depending on the response type (JSON or HTML)
     * @param string $responseType The response type (JSON or HTML)
     * @return Ebanx\Http\Client
     */

    public function setResponseType($responseType)
    {
        if (strtoupper($responseType) == 'JSON')
        {
            $this->_decodeResponse = true;
        }

        return $this;
    }

    /**
     * Sends the HTTP request
     * @return StdClass
     */
    public function send()
    {
        $this->_setupCurl();

        $response = curl_exec($this->_curl);
        curl_close($this->_curl);

        // Decode JSON responses
        if ($this->_decodeResponse)
        {
            $response = json_decode($response);
        }

        return $response;
    }

    /**
     * Initialize the cURL resource
     * @return void
     */
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