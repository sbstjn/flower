<?php

namespace Flower\Router\Response\Header;

class ContentType extends Base
{
    /**
     * HTTP header key
     *
     * @var string
     */
    protected $key = 'Content-Type';

    /**
     * Initialize Content-Type object
     *
     * @param string $type
     */
    public function __construct($type)
    {
        $this->value = $type;
    }
}