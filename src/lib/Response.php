<?php

namespace Flower;

class Response
{
    /**
     * Initialize Response
     */
    public function __construct()
    {
        $this->header = new \Flower\Response\Header();
    }

    /**
     * Set HTTP status header
     *
     * @param integer $code
     */
    public function status($code)
    {
        $this->header->apply(new \Flower\Response\Header\Status($code));
    }

    /**
     * Set HTTP redirect
     *
     * @param $url target
     * @param int $status
     */
    public function redirect($url, $status = \Flower\Response\Header\Status::HTTP_302)
    {
        $this->header->apply(new \Flower\Response\Header\Status($status));
        $this->header->apply(new \Flower\Response\Header\Location($url));

        die();
    }

    /**
     * Set HTTP Content-Type header
     *
     * @param string $type
     */
    public function type($type)
    {
        $this->header->apply(new \Flower\Response\Header\ContentType($type));
    }
}