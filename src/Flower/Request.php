<?php

namespace Flower;

class Request
{
    /**
     * Set Route object
     *
     * @var Route
     */
    private $route;

    /**
     * HTTP method
     *
     * @var string
     */
    private $method;

    /**
     * Request Session
     *
     * @var \Flower\Request\Session
     */
    private $session;

    /**
     * Current URL object
     */
    private $url;

    /**
     * Initialize Request
     */
    public function __construct($url, $method)
    {
        if ($url !== null) {
            $this->setURL($url instanceof Request\URL ? $url : new Request\URL($url));
        }

        if ($method !== null) {
            $this->setMethod($method instanceof Request\Method ? $method : new Request\Method($method));
        }

        $this->setSession(new Request\Session());
    }


    public static function parseFromEnvironment($ENV)
    {
        $URL    = Request\URL::parseFromEnvironment($ENV);
        $Method = Request\Method::parseFromEnvironment($ENV);

        return new Request($URL, $Method);
    }

    /**
     * Set URL object
     *
     * @param Request\URL $url
     */
    private function setURL(Request\URL $url)
    {
        $this->url = $url;
    }

    /**
     * Call Request Session authentication
     *
     * @param null $value
     * @return bool
     */
    public function auth($value = null)
    {
        return $this->session->auth($value);
    }

    /**
     * Call Request Session log of
     *
     * @return mixed
     */
    public function logout()
    {
        return $this->session->logout();
    }

    /**
     * Set Request Session
     *
     * @param Request\Session $session
     */
    private function setSession(Request\Session $session)
    {
        $this->session = $session;
    }

    /**
     * Get HTTP URI
     *
     * @return Request\URL
     */
    public function url()
    {
        return $this->url;
    }

    /**
     * Set matched Route
     *
     * @param Route $route
     */
    public function setRoute(Route $route)
    {
        $this->route = $route;
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
     * @param string $method ;
     */
    private function setMethod(Request\Method $method)
    {
        $this->method = $method;
    }

    /**
     * Retrieve GET param
     */
    public function get($name, $fallback = null)
    {
        return $this->url()->query($name, $fallback);
    }

    /**
     * Get array of URL parameters
     *
     * @return array
     */
    public function params()
    {
        preg_match($this->route->toRegexp(), $this->url()->path(), $matches);
        array_shift($matches);
        return array_combine($this->route->getKeys(), $matches);
    }

    /**
     * Get URL parameter
     *
     * @param string $name
     * @param null $fallback
     * @return mixed
     */
    public function param($name, $fallback = null)
    {
        $data = $this->params();
        return isset($data[$name]) ? $data[$name] : $fallback;
    }
}