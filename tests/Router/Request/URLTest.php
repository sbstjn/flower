<?php

namespace Flower\Test\Router\Request;

class URLTest extends \PHPUnit_Framework_TestCase
{
    public function testParseFromEnvironment()
    {
        $ENV = array(
            'REQUEST_URI'       => '/example/path/file.php?parm=sure&valid=false&true',
            'SERVER_NAME'       => 'fake.com',
            'SERVER_PORT'       => '8080',
            'HTTPS'             => 'on'
        );

        $url = \Flower\Router\Request\URL::parseFromEnvironment($ENV);

        $this->assertInstanceOf('\Flower\Router\Request\URL', $url);

        $this->assertEquals('https', $url->scheme());
        $this->assertFalse($url->http());
        $this->assertTrue($url->https());
        $this->assertEquals('fake.com', $url->host());
        $this->assertEquals('/example/path/file.php', $url->path());
        $this->assertEquals('parm=sure&valid=false&true', $url->query());
        $this->assertEquals('sure', $url->query('parm'));
        $this->assertEquals('false', $url->query('valid'));
        $this->assertEmpty($url->query('true'));
        $this->assertEquals('/example/path/file.php', (string)$url);

        $ENV = array(
            'REQUEST_URI'       => '/example/path/file.php?parm=sure&valid=false&true',
            'SERVER_NAME'       => 'fake.com',
            'SERVER_PORT'       => '80'
        );

        $url = \Flower\Router\Request\URL::parseFromEnvironment($ENV);

        $this->assertEquals('http', $url->scheme());
        $this->assertFalse($url->https());
        $this->assertTrue($url->http());
    }



    /**
     * @test
     */
    public function testHandling()
    {
        $url = new \Flower\Router\Request\URL('http://example.com/lorem?fancy=shit&lorem=ipsum+1');
        $this->assertEquals('http', $url->scheme());
        $this->assertTrue($url->http());
        $this->assertFalse($url->https());
        $this->assertEquals('example.com', $url->host());
        $this->assertEquals('/lorem', $url->path());
        $this->assertEquals('fancy=shit&lorem=ipsum+1', $url->query());
        $this->assertEquals('shit', $url->query('fancy'));
        $this->assertEquals('ipsum 1', $url->query('lorem'));
        $this->assertEquals('sit', $url->query('ipsum', 'sit'));
        $this->assertNull($url->query('ipsum'));
        $this->assertEquals('/lorem', (string)$url);
    }
}
