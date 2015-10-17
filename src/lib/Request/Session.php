<?php

namespace Flower\Request;

class Session
{
    /**
     * Custom cookie prefix
     */
    const PREFIX = 'flwr_';

    /**
     * Initialize Session
     */
    public function __construct()
    {

    }

    /**
     * Get Session data
     *
     * @param $key
     * @return mixed
     * @throws Exception
     */
    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * Set Session data
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    /**
     * Check and set Session Authentication
     *
     * @param null $value
     * @return bool
     * @throws Exception
     */
    public function auth($value = null)
    {
        if ($value === null) {
            return $this->get(self::PREFIX . 'auth') === true;
        } else {
            return $this->set(self::PREFIX . 'auth', !!$value);
        }
    }
}