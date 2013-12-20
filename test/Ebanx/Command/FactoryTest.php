<?php

class FactoryTest extends TestCase
{
    public function testBuildValidCommand()
    {
        $this->assertInstanceOf("\\Ebanx\\Command\\Cancel", \Ebanx\Command\Factory::build('doCancel'));
    }

    public function testBuildInvalidCommand()
    {
        $command = 'doFooBar';
        $this->setExpectedException('RuntimeException', "Command 'FooBar' doesn't exist.");
        \Ebanx\Command\Factory::build($command);
    }
}