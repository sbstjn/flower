<?php

namespace Flower\Test\Router\Response\Header;

class XPoweredByTest extends \PHPUnit_Framework_TestCase
{
    public function testValue()
    {
        $tmp = new \Flower\Router\Response\Header\XPoweredBy('Custom');
        $this->assertEquals('X-Powered-By: Custom', $tmp);
    }
}