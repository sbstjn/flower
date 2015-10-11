<?php

namespace Flower\Test;

use Flower\Router\Route;

class RouterTest extends \PHPUnit_Framework_TestCase
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

        $Router = new \Flower\Router(new \Flower\Router\Response());
        $Router->setRequest(\Flower\Router\Request::parseFromEnvironment($ENV));

        $RouteFirst = $this->getMock('Route', array('match', 'call'));
        $RouteFirst->expects($this->once())->method('match')->will($this->returnValue(true));
        $RouteFirst->expects($this->once())->method('call');

        $Router->addRoute($RouteFirst);

        $RouteSecond = $this->getMock('Route', array('match', 'call'));
        $RouteSecond->expects($this->once())->method('match')->will($this->returnValue(false));
        $RouteSecond->expects($this->never())->method('call');

        $Router->addRoute($RouteSecond);

        $RouteThird = $this->getMock('Route', array('match', 'call'));
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