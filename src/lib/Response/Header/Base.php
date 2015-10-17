<?php

namespace Flower\Response\Header;

class Base
{
    /**
     * HTTP header key
     *
     * @var string
     */
    protected $key = null;

    /**
     * HTTP header value
     *
     * @var string
     */
    protected $value = null;

    /**
     * Check if HTTP header key is needed
     *
     * @return bool
     */
    private function hasKey()
    {
        return $this->key !== null;
    }

    /**
     * Get HTTP header key
     *
     * @return string
     */
    private function getKey()
    {
        return $this->key;
    }

    /**
     * Get HTTP header value
     *
     * @return string
     */
    private function getValue()
    {
        return $this->value;
    }

    /**
     * Cast object to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->hasKey() ? $this->getKey() . ': ' . $this->getValue() : $this->getValue();
    }
}