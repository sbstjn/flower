<?php

namespace Flower;

use Flower\Router\Route;

require_once __DIR__ . '/Router/Request.php';
require_once __DIR__ . '/Router/Response.php';
require_once __DIR__ . '/Router/Route.php';

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
     * @return null|Router\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param null|Router\Request $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return null|Router\Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param null|Router\Response $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * Initialize Router
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
        array_push($this->routes, new Router\Route($method, $route, $callback));
    }

    /**
     * Add Route object to list of configured routes
     *
     * @param Route $route
     */
    public function addRoute($route) {
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
        // $this->response->header->apply(new Router\Response\Header\XPoweredBy(\Flower::LABEL . '/' . \Flower::VERSION));

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
