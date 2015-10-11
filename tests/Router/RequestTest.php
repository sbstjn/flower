<?php

namespace Flower\Test\Router;

class RequestTest extends \PHPUnit_Framework_TestCase
{

    public function testParseFromEnvironment()
    {
        $ENV = array(
            'REQUEST_URI'       => '/example/path/file.php?parm=sure&valid=false&true',
            'SERVER_NAME'       => 'fake.com',
            'SERVER_PORT'       => '8080',
            'REQUEST_METHOD'    => 'GET',
            'HTTPS'             => 'on'
        );

        $Request = \Flower\Router\Request::parseFromEnvironment($ENV);

        $this->assertInstanceOf('\Flower\Router\Request', $Request);
        $this->assertEquals('GET', $Request->getMethod());
        $this->assertEquals('/example/path/file.php', $Request->url());
        $this->assertEquals('fake.com', $Request->url()->host());
        $this->assertEquals('/example/path/file.php', $Request->url()->path());
    }

    /**
     * @test
     */
    public function testHandling()
    {
        $req = new \Flower\Router\Request('http://example.com/lorem?fancy=shit&lorem=ipsum+1', 'GET');
        $this->assertEquals('/lorem', $req->url());
        $this->assertEquals('/lorem', $req->url()->path());
        $this->assertEquals($req->url(), $req->url()->path());
        $this->assertEquals('GET', $req->getMethod());
        $this->assertEquals('shit', $req->get('fancy'));
        $this->assertEquals('shit', $req->get('fancy', 'no fallback needed'));
        $this->assertEquals('sit', $req->get('dolor', 'sit'));
        $this->assertNull($req->get('ipsum'));
    }

    /**
     * @test
     */
    public function testParamParsing()
    {
        $req = new \Flower\Router\Request('http://example.com/lorem-ipsum/dolor/sit?fancy=shit&lorem=ipsum+1', 'GET');
        $route = new \Flower\Router\Route('GET', '/:route/:test/:amet', function () {

        });

        $req->setRoute($route);
        $this->assertEquals('lorem-ipsum', $req->param('route'));
        $this->assertEquals(array('route' => 'lorem-ipsum', 'test' => 'dolor', 'amet' => 'sit'), $req->params());
    }
}