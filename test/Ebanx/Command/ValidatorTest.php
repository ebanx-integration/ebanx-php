<?php

class ValidatorTest extends TestCase
{
    public function testExists()
    {
        $params = array('test' => 'yes');

        $validator = new \Ebanx\Command\Validator($params);
        $this->assertTrue($validator->exists('test'));
        $this->assertFalse($validator->exists('invalidParameter'));
    }

    public function testExistsNested()
    {
        $params = array(
            'level1' => 'yes',
            'level2'  => array(
                'test' => 'yes'
            ),
            'level3' => array(
                'test' => array(
                    'test' => 'yes'
                )
            )
        );

        $validator = new \Ebanx\Command\Validator($params);
        $this->assertTrue($validator->exists('level1'));
        $this->assertTrue($validator->exists('level2.test'));
        $this->assertTrue($validator->exists('level3.test.test'));
    }

    public function testValidatePresence()
    {
        $params = array('test' => 'yes');

        $validator = new \Ebanx\Command\Validator($params);

        $this->assertTrue($validator->validatePresence('test'));

        $this->setExpectedException('InvalidArgumentException', "The parameter 'foo' was not supplied.");
        $validator->validatePresence('foo');
    }

    public function testValidatePresenceOrNone()
    {
        $this->setExpectedException('InvalidArgumentException', "Either the parameter 'param1' or 'param2' must be supplied.");
        $validator = new \Ebanx\Command\Validator(array());
        $validator->validatePresenceOr('param1', 'param2');
    }

    public function testValidatePresenceOrBoth()
    {
        $this->setExpectedException('InvalidArgumentException', "Either parameter 'param1' or 'param2' must be supplied, but not both.");
        $validator = new \Ebanx\Command\Validator(array('param1' => 1, 'param2' => 2));
        $validator->validatePresenceOr('param1', 'param2');
    }

    public function testValidatePresenceOrOne()
    {
        $validator = new \Ebanx\Command\Validator(array('param1' => 1));
        $this->assertTrue($validator->validatePresenceOr('param1', 'param2'));

        $validator = new \Ebanx\Command\Validator(array('param2' => 2));
        $this->assertTrue($validator->validatePresenceOr('param1', 'param2'));
    }
}