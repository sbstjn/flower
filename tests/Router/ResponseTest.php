<?php

namespace Flower\Test\Router;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testHandling()
    {
        new \Flower\Router\Response();

        $this->assertTrue(true);
    }
}