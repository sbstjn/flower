<?php

namespace Flower\Test;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testStaticRoute()
    {
        $route = new \Flower\Route('GET', '/route', function () {

        });
        $this->assertEquals('GET', $route->getMethod());
        $this->assertEquals('/route', $route->getRoute());
        $this->assertTrue($route->isStatic());
        $this->assertFalse($route->isRegexp());
    }
    /**
     * @test
     */
    public function testRegexpRoute()
    {
        $route = new \Flower\Route('GET', '/:route', function () {

        });
        $this->assertEquals('GET', $route->getMethod());
        $this->assertEquals('/:route', $route->getRoute());
        $this->assertFalse($route->isStatic());
        $this->assertTrue($route->isRegexp());
    }
    /**
     * @test
     * @dataProvider testGetParamKeysProvider
     */
    public function testGetParamKeys($request, $params)
    {
        $this->assertEquals($params, $request->getKeys());
    }
    public function testGetParamKeysProvider()
    {
        return array(
            array(
                new \Flower\Route('GET', '/:route', function () {
                }),
                array('route')
            ),
            array(
                new \Flower\Route('GET', '/:route/:param', function () {
                }),
                array('route', 'param')
            ),
            array(
                new \Flower\Route('GET', '/:route/lorem/:param', function () {
                }),
                array('route', 'param')
            )
        );
    }
    /**
     * @test
     * @dataProvider routeMatchingDataProvider
     */
    public function testRouteMatching($request, $route, $match)
    {
        $this->assertEquals($match, $route->match($request));
    }
    public function routeMatchingDataProvider()
    {
        return array(
            array(
                new \Flower\Request('http://example.com/lorem?fancy=shit&lorem=ipsum+1', 'GET'),
                new \Flower\Route('GET', '/lorem', function () {
                }),
                true),
            array(
                new \Flower\Request('http://example.com/lorem?fancy=shit&lorem=ipsum+1', 'GET'),
                new \Flower\Route('GET', '/:test', function () {
                }),
                true),
            array(
                new \Flower\Request('http://example.com/lorem/ipsum', 'GET'),
                new \Flower\Route('GET', '/lorem', function () {
                }),
                false),
            array(
                new \Flower\Request('http://example.com/lorem/ipsum', 'GET'),
                new \Flower\Route('GET', '/lorem/ipsum', function () {
                }),
                true),
            array(
                new \Flower\Request('http://example.com/lorem/ipsum', 'GET'),
                new \Flower\Route('GET', '/lorem/:test', function () {
                }),
                true),
            array(
                new \Flower\Request('http://example.com/lorem/ipsum', 'GET'),
                new \Flower\Route('GET', '/:test', function () {
                }),
                false),
            array(
                new \Flower\Request('http://example.com/lorem/ipsum', 'GET'),
                new \Flower\Route('GET', '/:test/:again', function () {
                }),
                true),
            array(
                new \Flower\Request('http://example.com/lorem/ipsum/dolor', 'GET'),
                new \Flower\Route('GET', '/lorem/:param/dolor', function () {
                }),
                true),
            array(
                new \Flower\Request('http://example.com/lorem/ipsum/dolor?sit', 'GET'),
                new \Flower\Route('GET', '/lorem/ipsum/:param', function () {
                }),
                true),
            array(
                new \Flower\Request('http://example.com/lorem/ipsum/dolor?sit', 'GET'),
                new \Flower\Route('GET', '/:param/ipsum/dolor', function () {
                }),
                true),
            array(
                new \Flower\Request('http://example.com/lorem/ipsum/dolor?sit', 'POST'),
                new \Flower\Route('POST', '/lorem/ipsum/:param', function () {
                }),
                true),
            array(
                new \Flower\Request('http://example.com/lorem/ipsum/dolor?sit', 'POST'),
                new \Flower\Route('POST', '/:param/ipsum/dolor', function () {
                }),
                true)
        );
    }
}