<?php

namespace Flower\Response;

class Header
{
    /**
     * Apply Header object
     *
     * @param \Flower\Response\Header\Base $object
     */
    public function apply(\Flower\Response\Header\Base $object)
    {
        header($object);
    }
}