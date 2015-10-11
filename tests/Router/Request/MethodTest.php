<?php

namespace Flower\Test\Router\Request;

class MethodTest extends \PHPUnit_Framework_TestCase
{
    public function testParseFromEnvironment()
    {
        $ENV = array('REQUEST_METHOD' => 'GET');
        $Method = \Flower\Router\Request\Method::parseFromEnvironment($ENV);

        $this->assertInstanceOf('\Flower\Router\Request\Method', $Method);
        $this->assertEquals($ENV['REQUEST_METHOD'], (string)$Method);

        $ENV = array('REQUEST_METHOD' => 'POST');
        $Method = \Flower\Router\Request\Method::parseFromEnvironment($ENV);

        $this->assertInstanceOf('\Flower\Router\Request\Method', $Method);
        $this->assertEquals($ENV['REQUEST_METHOD'], (string)$Method);
    }

    /**
     * @expectedException \Exception
     */
    public function testParseFromEnvironmentWithUnsupportedMethod()
    {
        $ENV = array('REQUEST_METHOD' => 'UNSUPPORTED');
        \Flower\Router\Request\Method::parseFromEnvironment($ENV);
    }

    /**
     * @expectedException \Exception
     */
    public function testParseFromEnvironmentWithEmptyMethod()
    {
        $ENV = array('REQUEST_METHOD' => '');
        \Flower\Router\Request\Method::parseFromEnvironment($ENV);
    }

    /**
     * @expectedException \Exception
     */
    public function testParseFromEnvironmentWithoutMethod()
    {
        $ENV = array();
        \Flower\Router\Request\Method::parseFromEnvironment($ENV);
    }

    /**
     * @test
     */
    public function testGet()
    {
        new \Flower\Router\Request\Method('get');
    }

    /**
     * @test
     */
    public function testPost()
    {
        new \Flower\Router\Request\Method('post');
    }

    /**
     * @test
     * @expectedException Exception
     */
    public function testInvalid()
    {
        new \Flower\Router\Request\Method('invalid');
    }
}