<?php

namespace Ebanx\Command;

class Factory
{
    public static function runCommand($name, $args)
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

        echo "factory build class $class\n";
        var_dump(new $class);
    }
}