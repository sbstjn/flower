<?php

namespace Flower\Test;

class LocationTest extends \PHPUnit_Framework_TestCase
{
    public function testValue()
    {
        $tmp = new \Flower\Response\Header\Location('http://google.com');
        $this->assertEquals('Location: http://google.com', $tmp);
    }
}