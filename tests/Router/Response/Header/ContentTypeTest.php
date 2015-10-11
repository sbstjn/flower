<?php

namespace Flower\Test\Router\Response\Header;

class ContentTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testValue()
    {
        $tmp = new \Flower\Router\Response\Header\ContentType('text/xml');
        $this->assertEquals('Content-Type: text/xml', $tmp);
    }
}