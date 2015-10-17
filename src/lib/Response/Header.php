<?php

namespace Flower\Response;

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