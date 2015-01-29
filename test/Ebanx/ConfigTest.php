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

class ConfigTest extends TestCase
{
    public function testUrlChangesDependingOnMode()
    {
        \Ebanx\Config::set('testMode', false);
        $this->assertEquals('https://api.ebanx.com/ws/', \Ebanx\Config::getURL());

        \Ebanx\Config::set('testMode', true);
        $this->assertEquals('https://sandbox.ebanx.com/ws/', \Ebanx\Config::getURL());
    }

    public function testSettingCanBeSetAndRetrieved()
    {
        \Ebanx\Config::set('testOption', 123);
        $this->assertEquals(123, \Ebanx\Config::get('testOption'));
    }

    public function testInvalidSetting()
    {
        $this->setExpectedException('InvalidArgumentException');
        \Ebanx\Config::get('aRandomSetting');
    }

    public function testSetManySettings()
    {
        \Ebanx\Config::set(array(
            'foo' => true
          , 'bar' => '12345678'
        ));

        $this->assertEquals(true, \Ebanx\Config::getFoo());
        $this->assertEquals(true, \Ebanx\Config::get('foo'));
        $this->assertEquals('12345678', \Ebanx\Config::getBar());
        $this->assertEquals('12345678', \Ebanx\Config::get('bar'));
    }
}