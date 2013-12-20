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

        // Set the HTTP client - easier for testing
        $httpClient = (isset($settings['httpClient'])) ? $settings['httpClient'] : '\\Ebanx\\Http\\Client';
        \Ebanx\Config::setHttpClient($httpClient);
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
            if (!isset($args[0]))
            {
                throw new \InvalidArgumentException('The command call received no arguments.');
            }

            $command = \Ebanx\Command\Factory::build($name);
            return $command->execute($args[0]);
        }
        else
        {
            throw new \InvalidArgumentException("The command $name doesn't exist.");
        }
    }
}