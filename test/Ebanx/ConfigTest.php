<?php

class ConfigTest extends TestCase
{
    public function testUrlChangeDependingOnMode()
    {
        \Ebanx\Config::set('testMode', false);
        $this->assertEquals(\Ebanx\Config::getURL(), 'https://www.ebanx.com/pay/ws/');

        \Ebanx\Config::set('testMode', true);
        $this->assertEquals(\Ebanx\Config::getURL(), 'https://www.ebanx.com/test/ws/');
    }

    public function testSettingCanBeSetAndRetrieved()
    {
        \Ebanx\Config::set('testOption', 123);
        $this->assertEquals(\Ebanx\Config::get('testOption'), 123);
    }

    public function testInvalidSettingThrowsException()
    {
        $this->setExpectedException('InvalidArgumentException');
        \Ebanx\Config::get('aRandomSetting');
    }
}