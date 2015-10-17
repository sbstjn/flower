<?php

namespace Flower;

class Router
{
    /**
     * Flower Request object
     *
     * @var null
     */
    public $request = null;

    /**
     * Flower Response object
     *
     * @var null
     */
    public $response = null;

    /**
     * Routes
     *
     * @var array
     */
    private $routes = array();

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @return null|\Flower\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param \Flower\Request $request
     */
    public function setRequest(\Flower\Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return null|\Flower\Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param \Flower\Response $response
     */
    public function setResponse(\Flower\Response $response)
    {
        $this->response = $response;
    }

    /**
     * Initialize Flower
     *
     */
    public function __construct()
    {

    }

    /**
     * Register route
     *
     * @param string $method
     * @param string $route
     * @param callable $callback
     */
    public function register($method, $route, $callback)
    {
        array_push($this->routes, new \Flower\Route($method, $route, $callback));
    }

    /**
     * Add Route object to list of configured routes
     *
     * @param Route $route
     */
    public function addRoute(\Flower\Route $route) {
        array_push($this->routes, $route);
    }

    /**
     * Run middlewares
     */
    public function runMiddleware($middleware)
    {
        $middleware($this->request, $this->response);
    }

    /**
     * Check for default view or configured route
     */
    public function check()
    {
        // Set default header for X-Powered-By
        // $this->response->header->apply(new Flower\Response\Header\XPoweredBy(\Flower::LABEL . '/' . \Flower::VERSION));

        // Set default layout
        // $this->response->layout($this->Flower->getLayout());

        // Check routes
        foreach ($this->routes as &$Route) {
            if ($Route->match($this->request)) {
                $Route->call($this->request, $this->response);
            }
        }
    }
}
