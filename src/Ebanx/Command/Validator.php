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
 * Validation class. Exposes methods to validate the presence of the request parameters.
 *
 * @author Gustavo Henrique Mascarenhas Machado gustavo@ebanx.com
 */
class Validator
{
    /**
     * The request parameters
     * @var array
     */
    protected $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Verifies if a parameter was supplied
     * @param  string $key The parameter name (array key)
     * @return boolean
     * @throws InvalidArgumentException
     */
    public function validatePresence($key)
    {
        if ($this->exists($key))
        {
            return true;
        }

        throw new \InvalidArgumentException("The parameter '$key' was not supplied.");
    }

    /**
     * Verifies if one of the parameters was supplied
     * @param  string $key1 The first parameter name (array key)
     * @param  string $key1 The second parameter name (array key)
     * @return boolean
     * @throws InvalidArgumentException
     */
    public function validatePresenceOr($key1, $key2)
    {
        if ($this->exists($key1))
        {
            // Throw an exception if both parameters exist
            if ($this->exists($key2))
            {
                throw new \InvalidArgumentException("Either parameter '$key1' or '$key2' must be supplied, but not both.");
            }

            return true;
        }
        else if ($this->exists($key2))
        {
            return true;
        }

        throw new \InvalidArgumentException("Either the parameter '$key1' or '$key2' must be supplied.");
    }

    /**
     * Verifies if a parameter exists
     * @param  string $key The parameter name (array key)
     * @return boolean
     */
    public function exists($key)
    {
        // Checks if we need to verify a nested array
        if (preg_match('/\.+/', $key))
        {
            $keys   = explode('.', $key);
            $levels = count($keys);

            // Quick workaround
            if ($levels == 4)
            {
                return isset($this->params[$keys[0]][$keys[1]][$keys[2]][$keys3]);
            }
            else if ($levels == 3)
            {
                return isset($this->params[$keys[0]][$keys[1]][$keys[2]]);
            }
            else
            {
                return isset($this->params[$keys[0]][$keys[1]]);
            }
        }

        // Non-nested array validation
        if (array_key_exists($key, $this->params))
        {
            return true;
        }

        return false;
    }
}