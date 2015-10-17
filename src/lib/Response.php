<?php

namespace Flower;

class Response
{
    /**
     * Initialize Response
     */
    public function __construct()
    {
        $this->header = new Response\Header();
    }

    /**
     * Set HTTP status header
     *
     * @param integer $code
     */
    public function status($code)
    {
        $this->header->apply(new Response\Header\Status($code));
    }

    /**
     * Set HTTP redirect
     *
     * @param $url target
     * @param int $status
     */
    public function redirect($url, $status = Response\Header\Status::HTTP_302)
    {
        $this->header->apply(new Response\Header\Status($status));
        $this->header->apply(new Response\Header\Location($url));

        die();
    }

    /**
     * Set HTTP Content-Type header
     *
     * @param string $type
     */
    public function type($type)
    {
        $this->header->apply(new Response\Header\ContentType($type));
    }
}