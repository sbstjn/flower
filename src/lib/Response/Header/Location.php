<?php

namespace Flower\Response\Header;

class Location extends Base
{
    /**
     * HTTP header key
     *
     * @var string
     */
    protected $key = 'Location';

    /**
     * Initialize Location header
     *
     * @param string $url
     */
    public function __construct($url)
    {
        $this->value = $url;
    }
}