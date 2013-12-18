<?php

namespace Ebanx;

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
     * Protected constructor to avoid other instances
     */
    protected function __construct() {}

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
    public static function set($key, $value)
    {
        self::_getInstance();

        self::$_settings[$key] = $value;
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