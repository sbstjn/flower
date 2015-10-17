<?php

namespace Flower\Test;

class MethodTest extends \PHPUnit_Framework_TestCase
{
    public function testParseFromEnvironment()
    {
        $ENV = array('REQUEST_METHOD' => 'GET');
        $Method = \Flower\Request\Method::parseFromEnvironment($ENV);

        $this->assertInstanceOf('\Flower\Request\Method', $Method);
        $this->assertEquals($ENV['REQUEST_METHOD'], (string)$Method);

        $ENV = array('REQUEST_METHOD' => 'POST');
        $Method = \Flower\Request\Method::parseFromEnvironment($ENV);

        $this->assertInstanceOf('\Flower\Request\Method', $Method);
        $this->assertEquals($ENV['REQUEST_METHOD'], (string)$Method);
    }

    /**
     * @expectedException \Exception
     */
    public function testParseFromEnvironmentWithUnsupportedMethod()
    {
        $ENV = array('REQUEST_METHOD' => 'UNSUPPORTED');
        \Flower\Request\Method::parseFromEnvironment($ENV);
    }

    /**
     * @expectedException \Exception
     */
    public function testParseFromEnvironmentWithEmptyMethod()
    {
        $ENV = array('REQUEST_METHOD' => '');
        \Flower\Request\Method::parseFromEnvironment($ENV);
    }

    /**
     * @expectedException \Exception
     */
    public function testParseFromEnvironmentWithoutMethod()
    {
        $ENV = array();
        \Flower\Request\Method::parseFromEnvironment($ENV);
    }

    /**
     * @test
     */
    public function testGet()
    {
        new \Flower\Request\Method('get');
    }

    /**
     * @test
     */
    public function testPost()
    {
        new \Flower\Request\Method('post');
    }

    /**
     * @test
     * @expectedException Exception
     */
    public function testInvalid()
    {
        new \Flower\Request\Method('invalid');
    }
}