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

namespace Ebanx;

/**
 * The EBANX API client
 *
 * @author Gustavo Henrique Mascarenhas Machado gustavo@ebanx.com
 */
class Ebanx
{
    /**
     * Library version
     * @var string
     */
    const VERSION = '1.10.0';

    /**
     * Magic method that calls the Command Factory
     * @param string $name The method name
     * @param string $args The method arguments ($args[0] for the parameters array)
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function __callStatic($name, $args)
    {
        if (preg_match('/^do|get[\w]+/', $name))
        {
            if (!isset($args[0]))
            {
                throw new \InvalidArgumentException('The command call received no arguments.');
            }

            $command = \Ebanx\Command\Factory::build($name);
            return $command->execute($args[0]);
        }
        else
        {
            throw new \InvalidArgumentException("The command $name doesn't exist.");
        }
    }
}
