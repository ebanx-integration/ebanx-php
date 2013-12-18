<?php

namespace Ebanx\Command;

class Factory
{
    public static function build($name)
    {
        $class = '\\Ebanx\\Command\\';

        $className = str_replace('do', '', $name);
        $class .= $className;

        // Request command is different depending on the checkout method (Ebanx or direct)
        if ($className == 'Request')
        {
            // Use EBANX direct
            if (\Ebanx\Config::getDirectMode() == true)
            {
                $class .= '\\Direct';
            }
            // Use EBANX checkout
            else
            {
                $class .= '\\Checkout';
            }
        }

        if (class_exists($class))
        {
            return new $class();
        }
        else
        {
            throw new \RuntimeException("Command $className doesn't exist.");
        }
    }
}