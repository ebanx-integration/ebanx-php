<?php

namespace Ebanx;

class Ebanx
{
    /**
     * Sets up the EBANX settings
     * @param array $settings The settings associative array
     */
    public function __construct($settings)
    {
        $directMode = (isset($settings['directMode'])) ? $settings['directMode'] : false;
        $testMode   = (isset($settings['testMode'])) ? $settings['testMode'] : false;

        \Ebanx\Config::setIntegrationKey($settings['integrationKey']);
        \Ebanx\Config::setDirectMode($directMode);
        \Ebanx\Config::setTestMode($testMode);
    }

    /**
     * Magic method that calls the Command Factory
     * @param string $name The method name
     * @param string $args The method arguments ($args[0] for the parameters array)
     * @return mixed
     */
    public function __call($name, $args)
    {
        if (preg_match('/^do[\w]+/', $name))
        {
            $command = \Ebanx\Command\Factory::build($name);
            return $command->execute($args[0]);
        }
    }
}