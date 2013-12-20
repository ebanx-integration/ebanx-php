<?php

namespace Mock\Http;

class Client extends \Ebanx\Http\Client
{
    /**
     * Returns the request options/parameters instead of sending the request
     * @return array
     */
    public function send()
    {
        return array(
            'method' => $this->_method
          , 'action' => $this->_action
          , 'params' => $this->_params
          , 'decode' => $this->_decodeResponse
        );
    }
}