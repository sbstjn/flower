<?php

namespace Flower\Router\Request;

class Method
{
    const TYPE_GET = 'GET';
    const TYPE_POST = 'POST';

    /**
     * Used HTTP method key
     *
     * @var string
     */
    private $type;

    /**
     * List of available HTTP methods
     *
     * @var array
     */
    protected $list = array(
        self::TYPE_GET,
        self::TYPE_POST
    );

    /**
     * Initialize HTTP Method object
     *
     * @param $type
     * @throws \Exception
     */
    public function __construct($type)
    {
        $type = strtoupper($type);
        if (!in_array($type, $this->list)) {
            throw new \Exception('Unknown HTTP method: ' . $type);
        }
        $this->type = $type;
    }

    /**
     * Create Method object from data array
     *
     * @param $ENV PHP's $_REQUEST data array
     * @return Method
     */
    public static function parseFromEnvironment($ENV)
    {
        return new Method(isset($ENV['REQUEST_METHOD']) ? $ENV['REQUEST_METHOD'] : null);
    }

    /**
     * Convert object to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->type;
    }
}
