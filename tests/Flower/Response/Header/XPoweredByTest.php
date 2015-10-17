<?php

namespace Flower\Test;

class XPoweredByTest extends \PHPUnit_Framework_TestCase
{
    public function testValue()
    {
        $tmp = new \Flower\Response\Header\XPoweredBy('Custom');
        $this->assertEquals('X-Powered-By: Custom', $tmp);
    }
}