<?php

namespace Flower\Test;

class FlowerTest extends \PHPUnit_Framework_TestCase
{
    public function testRouting()
    {
        $ENV = array(
            'REQUEST_URI'       => '/example/path/file.php?parm=sure&valid=false&true',
            'SERVER_NAME'       => 'fake.com',
            'SERVER_PORT'       => '8080',
            'REQUEST_METHOD'    => 'GET',
            'HTTPS'             => 'on'
        );

        $Response = new \Flower\Response();
        $Request  = \Flower\Request::parseFromEnvironment($ENV);

        $Router = new \Flower\Router();
        $Router->setRequest($Request);
        $Router->setResponse($Response);

        $RouteFirst = $this->getMockBuilder('\Flower\Route')->disableOriginalConstructor()->getMock();
        $RouteFirst->expects($this->once())->method('match')->will($this->returnValue(true));
        $RouteFirst->expects($this->once())->method('call');
        $Router->addRoute($RouteFirst);

        $RouteSecond = $this->getMockBuilder('\Flower\Route')->disableOriginalConstructor()->getMock();
        $RouteSecond->expects($this->once())->method('match')->will($this->returnValue(false));
        $RouteSecond->expects($this->never())->method('call');
        $Router->addRoute($RouteSecond);

        $RouteThird = $this->getMockBuilder('\Flower\Route')->disableOriginalConstructor()->getMock();
        $RouteThird->expects($this->once())->method('match')->will($this->returnValue(true));
        $RouteThird->expects($this->once())->method('call');
        $Router->addRoute($RouteThird);

        $Router->check();
    }

    /**
     * Test that true does in fact equal true
     */
    public function testTrueIsTrue()
    {
        $this->assertTrue(true);
    }
}
