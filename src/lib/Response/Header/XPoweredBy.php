<?php

namespace Flower\Response\Header;

class XPoweredBy extends Base
{
    /**
     * HTTP Header key
     *
     * @var string
     */
    protected $key = 'X-Powered-By';

    /**
     * Initialize X-Powered-By object
     *
     * @param string $type
     */
    public function __construct($type)
    {
        $this->value = $type;
    }
}