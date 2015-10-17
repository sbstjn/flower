<?php

namespace Flower\Test;

class SessionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testHandling()
    {
        $session = new \Flower\Request\Session();
        $session->set('test', true);
        $this->assertNull($session->get('nope'));
        $this->assertTrue($session->get('test'));
    }
    /**
     * @test
     */
    public function testAuth()
    {
        $session = new \Flower\Request\Session();
        $this->assertFalse($session->auth());
        $this->assertTrue($session->auth(true));
        $this->assertTrue($session->auth('1'));
        $this->assertTrue($session->auth());
        $this->assertFalse($session->auth(false));
        $this->assertFalse($session->auth(null));
        $this->assertFalse($session->auth(0));
    }
}