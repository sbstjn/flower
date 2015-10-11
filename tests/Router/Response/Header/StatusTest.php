<?php

namespace Flower\Test\Router\Response\Header;

class StatusTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function test500()
    {
        $tmp = new \Flower\Router\Response\Header\Status(500);
        $this->assertEquals('HTTP/1.1 500 Server Error', $tmp);
    }

    /**
     * @test
     * @expectedException Exception
     */
    public function testUnknown()
    {
        new \Flower\Router\Response\Header\Status(600);
    }

    /**
     * @test
     * @dataProvider statusProvider
     */
    public function testAll($code, $message)
    {
        $tmp = new \Flower\Router\Response\Header\Status($code);
        $this->assertEquals('HTTP/1.1 ' . $code . ' ' . $message, $tmp);
    }

    public function statusProvider()
    {
        $tmp = \Flower\Router\Response\Header\Status::$label;
        $data = array();
        foreach ($tmp as $code => $message) {
            array_push($data, array($code, $message));
        }
        return $data;
    }
}