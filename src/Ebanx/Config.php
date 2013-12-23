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
 * Config class (singleton, registry)
 *
 * @author Gustavo Henrique Mascarenhas Machado gustavo@ebanx.com
 */
class Config
{
    /**
     * The API URLs for test and production
     */
    const URL_TEST       = 'https://www.ebanx.com/test/ws/';
    const URL_PRODUCTION = 'https://www.ebanx.com/pay/ws/';

    /**
     * The config object instance
     * @var \Ebanx\Config
     */
    protected static $_instance = null;

    /**
     * Library settings array
     * @var array
     */
    protected static $_settings = array();

    /**
     * Protected constructor to avoid other instances.
     * Sets stuff to default values.
     */
    protected function __construct()
    {
        self::$_settings['directMode'] = false;
        self::$_settings['testMode']   = false;
        self::$_settings['httpClient'] = '\\Ebanx\\Http\\Client';
    }

    /**
     * Get the class instance (singleton)
     * @return \Ebanx\Config
     */
    public static function _getInstance()
    {
        if (self::$_instance == null)
        {
            self::$_instance = new Config();
        }

        return self::$_instance;
    }

    /**
     * Gets a setting value
     * @param string $key The setting name
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function get($key)
    {
        self::_getInstance();

        if (array_key_exists($key, self::$_settings))
        {
            return self::$_settings[$key];
        }

        throw new \InvalidArgumentException("The key $key doesn't exist in the Config Registry.");
    }

    /**
     * Sets a setting
     * @param string $key The setting name
     * @param mixed $value The setting value
     * @return void
     */
    public static function set()
    {
        self::_getInstance();

        $args = func_get_args();

        if (is_array($args[0]))
        {
            foreach ($args[0] as $key => $value)
            {
                self::$_settings[$key] = $value;
            }
        }
        else
        {
            self::$_settings[$args[0]] = $args[1];
        }
    }

    /**
     * Magic method to get and set settings
     * @param  string $name The method name
     * @param  string $args The method arguments
     * @return mixed
     */
    public static function __callStatic($name, $args)
    {
        // From 'getIntegrationKey' to 'integrationKey'
        $key = lcfirst(preg_replace('/^get|^set/', '', $name));

        // Magic getter method
        if (preg_match('/^get[\w]+/', $name))
        {
            return self::get($key);
        }
        // Magic setter method
        else if (preg_match('/^set[\w]+/', $name))
        {
            self::set($key, $args[0]);
        }
    }

    /**
     * Gets the current API URL
     * @return string
     */
    public static function getURL()
    {
        if (self::$_settings['testMode'] == true)
        {
            return self::URL_TEST;
        }

        return self::URL_PRODUCTION;
    }
}