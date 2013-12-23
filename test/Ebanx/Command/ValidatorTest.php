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

class ValidatorTest extends TestCase
{
    public function testExists()
    {
        $params = array('test' => 'yes');

        $validator = new \Ebanx\Command\Validator($params);
        $this->assertTrue($validator->exists('test'));
        $this->assertFalse($validator->exists('invalidParameter'));
    }

    public function testExistsNested()
    {
        $params = array(
            'level1' => 'yes',
            'level2'  => array(
                'test' => 'yes'
            ),
            'level3' => array(
                'test' => array(
                    'test' => 'yes'
                )
            )
        );

        $validator = new \Ebanx\Command\Validator($params);
        $this->assertTrue($validator->exists('level1'));
        $this->assertTrue($validator->exists('level2.test'));
        $this->assertTrue($validator->exists('level3.test.test'));
    }

    public function testValidatePresence()
    {
        $params = array('test' => 'yes');

        $validator = new \Ebanx\Command\Validator($params);

        $this->assertTrue($validator->validatePresence('test'));

        $this->setExpectedException('InvalidArgumentException', "The parameter 'foo' was not supplied.");
        $validator->validatePresence('foo');
    }

    public function testValidatePresenceOrNone()
    {
        $this->setExpectedException('InvalidArgumentException', "Either the parameter 'param1' or 'param2' must be supplied.");
        $validator = new \Ebanx\Command\Validator(array());
        $validator->validatePresenceOr('param1', 'param2');
    }

    public function testValidatePresenceOrBoth()
    {
        $this->setExpectedException('InvalidArgumentException', "Either parameter 'param1' or 'param2' must be supplied, but not both.");
        $validator = new \Ebanx\Command\Validator(array('param1' => 1, 'param2' => 2));
        $validator->validatePresenceOr('param1', 'param2');
    }

    public function testValidatePresenceOrOne()
    {
        $validator = new \Ebanx\Command\Validator(array('param1' => 1));
        $this->assertTrue($validator->validatePresenceOr('param1', 'param2'));

        $validator = new \Ebanx\Command\Validator(array('param2' => 2));
        $this->assertTrue($validator->validatePresenceOr('param1', 'param2'));
    }
}