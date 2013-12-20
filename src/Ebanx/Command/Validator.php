<?php

namespace Ebanx\Command;

class Validator
{
    /**
     * The request parameters
     * @var array
     */
    protected $_params;

    public function __construct($params)
    {
        $this->_params = $params;
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
                return isset($this->_params[$keys[0]][$keys[1]][$keys[2]][$keys3]);
            }
            else if ($levels == 3)
            {
                return isset($this->_params[$keys[0]][$keys[1]][$keys[2]]);
            }
            else
            {
                return isset($this->_params[$keys[0]][$keys[1]]);
            }
        }

        // Non-nested array validation
        if (array_key_exists($key, $this->_params))
        {
            return true;
        }

        return false;
    }
}