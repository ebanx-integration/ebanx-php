<?php
/**
 * Copyright (c) 2013, EBANX Tecnologia da Informação Ltda.
 *  All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this
 * list of conditions and the following disclaimer.
 *
 * Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *
 * Neither the name of EBANX nor the names of its
 * contributors may be used to endorse or promote products derived from
 * this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

namespace Ebanx\Command;

/**
 * The abstract command class
 *
 * @author Gustavo Henrique Mascarenhas Machado gustavo@ebanx.com
 */
abstract class AbstractCommand
{
    /**
     * Associative array of params
     * @var array
     */
    protected $params = array();

    /**
     * The HTTP method
     * @var string
     */
    protected $method = 'POST';

    /**
     * The action URL address
     * @var string
     */
    protected $action = null;

    /**
     * The response type - HTML or JSON
     * @var string
     */
    protected $_responseType = 'JSON';

    protected $ignoredStatusCodes = array();

    /**
     * Validates the request parameters
     * @param Ebanx\Command\Validator $validator The validator instance
     * @return mixed
     * @throws InvalidArgumentException
     */
    abstract protected function validate($validator);

    /**
     * Executes the command in the EBANX API
     * @param  array $params The request parameters
     * @return mixed
     */
    public function execute($params)
    {
        $this->params = $params;
        $this->validate(new \Ebanx\Command\Validator($this->params));

        // Get the HTTP client from the registry
        $httpClient = \Ebanx\Config::getHttpClient();
        $client = new $httpClient();
        $client->setRequestParams($this->params)
               ->setMethod($this->method)
               ->setAction($this->action)
               ->setIgnoredStatusCodes($this->ignoredStatusCodes)
               ->setResponseType($this->_responseType);

        return $client->send();
    }
}
