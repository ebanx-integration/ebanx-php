<?php

namespace Ebanx;

class Ebanx
{
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
     * @param string $args The method arguments
     * @return mixed
     */
    public function __call($name, $args)
    {
        if (preg_match('/^do[\w]+/', $name))
        {
            \Ebanx\Command\Factory::runCommand($name, $args);
        }
    }
}