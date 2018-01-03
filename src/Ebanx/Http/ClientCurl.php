<?php
/**
 * Copyright (c) 2017, EBANX Tecnologia da Informação Ltda.
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

namespace Ebanx\Http;

/**
 * HTTP request client wrapper, using curl
 *
 * @author Guilherme Pressutto guilherme.pressutto@ebanx.com
 */
class ClientCurl extends AbstractClient
{
    private $curl;
    private $uri;

    /**
     * {@inheritDoc} using curl.
     */
    public function send()
    {
        $allowed_status_codes = array_merge(array(200), $this->ignoredStatusCodes);
        $this->ignoredStatusCodes = array();

        try {
            $this->_setupCurl();
            $response = curl_exec($this->curl);

            if (!in_array(curl_getinfo($this->curl, CURLINFO_HTTP_CODE), $allowed_status_codes)) {
                if (curl_errno($this->curl)) {
                    throw new \RuntimeException('The HTTP request failed: ' . curl_error($this->curl));
                }
                throw new \RuntimeException('The HTTP request failed: unknown error.');
            }
            curl_close($this->curl);

            return $this->hasToDecodeResponse ? json_decode($response) : $response;
        } catch (Exception $e) {  }
    }

    /**
     * Initialize the cURL resource
     * @return void
     */
    private function _setupCurl()
    {
        $requestParams = http_build_query($this->requestParams);

        $this->uri = $this->action;
        if ($this->method == 'GET') {
            $this->uri .= '?'.$requestParams;
        }

        $this->curl = curl_init($this->uri);

        if ($this->method == 'POST') {
            // POST requests
            curl_setopt($this->curl, CURLOPT_POST, true);
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $requestParams);
        }

        // We want to receive the returned data
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        // Setup custom user agent
        curl_setopt($this->curl, CURLOPT_USERAGENT, 'EBANX PHP Library ' . \Ebanx\Ebanx::VERSION);
    }
}
