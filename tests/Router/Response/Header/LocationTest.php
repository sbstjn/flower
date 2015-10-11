<?php

namespace Flower\Test\Router\Response\Header;

class LocationTest extends \PHPUnit_Framework_TestCase
{
    public function testValue()
    {
        $tmp = new \Flower\Router\Response\Header\Location('http://google.com');
        $this->assertEquals('Location: http://google.com', $tmp);
    }
}