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
 * The commands factory class.
 *
 * @author Gustavo Henrique Mascarenhas Machado gustavo@ebanx.com
 */
class Factory
{
    /**
     * Returns an instance of the command class.
     *
     * @param string $name The command name in the form 'doCommand'
     *
     * @return \Ebanx\Command\AbstractCommand
     *
     * @throws RuntimeException
     */
    public static function build($name)
    {
        $class = '\\Ebanx\\Command\\';

        $className = str_replace('do', '', $name);

        if ($className == $name) {
            $className = str_replace('get', '', $name);
        }

        $class .= $className;

        // Request command is different depending on the checkout method (Ebanx or direct)
        if ($className == 'Request') {
            // Use EBANX direct
            if (\Ebanx\Config::getDirectMode() == true) {
                $class .= '\\Direct';
            } else {
                // Use EBANX checkout
                $class .= '\\Checkout';
            }
        }
        
        if (!class_exists($class)) {
            throw new \RuntimeException("Command '$className' doesn't exist.");
        }
        
        return new $class();
    }
}
