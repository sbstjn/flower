<?php

namespace Flower\Router\Response;

require_once __DIR__ . '/Header/Base.php';
require_once __DIR__ . '/Header/ContentType.php';
require_once __DIR__ . '/Header/Location.php';
require_once __DIR__ . '/Header/Status.php';
require_once __DIR__ . '/Header/XPoweredBy.php';

class Header
{
    /**
     * Apply Header object
     *
     * @param Header\Base $object
     */
    public function apply(Header\Base $object)
    {
        header($object);
    }
}