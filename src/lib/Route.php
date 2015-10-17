<?php

namespace Flower;

class Route
{
    /**
     * Needed HTTP method
     *
     * @var
     */
    private $method;

    /**
     * Route URI
     *
     * @var
     */
    private $route;

    /**
     * Callback
     *
     * @var
     */
    private $callback;

    /**
     * Initialize Route
     *
     * @param string $method
     * @param string $route
     * @param callable $callback
     */
    public function __construct($method, $route, $callback)
    {
        $this->setMethod($method);
        $this->setRoute($route);
        $this->setCallback($callback);
    }

    /**
     * Get HTTP method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set HTTP method
     *
     * @param strign $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set route
     *
     * @param string $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * Get callback
     *
     * @return callable
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * Set callback
     *
     * @param callable $callback
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
    }

    /**
     * Check if Route matches Request
     *
     * @param Request $req
     * @return bool
     */
    public function match(Request $req)
    {
        return $this->matchMethod($req) && ($this->matchStatic($req) || $this->matchRegexp($req));
    }

    /**
     * Check if route is static URL
     *
     * @return bool
     */
    public function isStatic()
    {
        return !$this->isRegexp();
    }

    /**
     * Check if route is based on Regex
     *
     * @return string
     */
    public function isRegexp()
    {
        return !!stristr($this->getRoute(), ':');
    }

    /**
     * Check if route matches request method
     */
    private function matchMethod(Request $req)
    {
        return strtolower($this->getMethod()) === strtolower($req->getMethod());
    }

    /**
     * Check if route matches static URL
     *
     * @param Request $req
     * @return bool
     */
    private function matchStatic(Request $req)
    {
        return $this->isStatic() && $req->url()->path() === $this->getRoute();
    }

    /**
     * Check if Route Regex matches Request
     *
     * @param Request $req
     * @return bool
     */
    private function matchRegexp(Request $req)
    {
        return $this->isRegexp() && preg_match($this->toRegexp(), $req->url()->path(), $matches);
    }

    /**
     * Convert configured route to Regex
     *
     * @return string
     */
    public function toRegexp()
    {
        return "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($this->getRoute())) . "$@D";
    }

    /**
     * Get URL keys
     *
     * @return array
     */
    public function getKeys()
    {
        preg_match_all('/(:[a-z]++)/', $this->getRoute(), $matches);
        return array_map(function ($value) {
            return substr($value, 1);
        }, array_shift($matches));
    }

    /**
     * Handle route request
     *
     * @param Request $req
     * @param Response $res
     */
    public function call(Request $req, Response $res)
    {
        $req->setRoute($this);
        $callback = $this->getCallback();
        $callback($req, $res);
    }
}
