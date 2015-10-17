<?php

namespace Flower\Test;

class ContentTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testValue()
    {
        $tmp = new \Flower\Response\Header\ContentType('text/xml');
        $this->assertEquals('Content-Type: text/xml', $tmp);
    }
}