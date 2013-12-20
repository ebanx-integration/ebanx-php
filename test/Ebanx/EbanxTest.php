<?php

class EbanxTest extends TestCase
{
    public function testCallInvalidCommand()
    {
        $this->setExpectedException('InvalidArgumentException', "The command theCakeIsALie doesn't exist.");
        $this->_ebanx->theCakeIsALie();
    }

    public function testCallCommandWithoutArguments()
    {
        $this->setExpectedException('InvalidArgumentException', 'The command call received no arguments.');
        $this->_ebanx->doQuery();
    }
}