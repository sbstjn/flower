<?php

namespace Flower\Router\Request;

class URL
{
    /**
     * Data array
     *
     * @var array
     */
    private $data;

    const SCHEME_HTTP = 'http';
    const SCHEME_HTTPS = 'https';

    /**
     * Create URL object from URL string
     *
     * @param $url
     */
    public function __construct($url)
    {
        $this->data = parse_url($url);
        parse_str($this->data['query'], $this->query);
    }

    /**
     * Convert object to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->data['path'];
    }

    /**
     * Get URL scheme
     *
     * @param null $check
     * @return bool
     */
    public function scheme($check = null)
    {
        return $check ? $this->data['scheme'] === $check : $this->data['scheme'];
    }

    /**
     * Check if URL is HTTP
     *
     * @return bool
     */
    public function http()
    {
        return $this->scheme(self::SCHEME_HTTP);
    }

    /**
     * Check if URL is HTTPS
     *
     * @return bool
     */
    public function https()
    {
        return $this->scheme(self::SCHEME_HTTPS);
    }

    /**
     * Get host from URL
     *
     * @return string
     */
    public function host()
    {
        return $this->data['host'];
    }

    /**
     * Get requested path from URL
     *
     * @return string
     */
    public function path()
    {
        return $this->data['path'];
    }

    /**
     * Get query or query parameter from URL
     *
     * @param null $param
     * @param null $fallback
     * @return mixed
     */
    public function query($param = null, $fallback = null)
    {
        return $param ? isset($this->query[$param]) ? $this->query[$param] : $fallback : $this->data['query'];
    }

    /**
     * Create URL object from data array
     *
     * @param $ENV PHP's $_REQUEST data array
     * @return URL
     */
    public static function parseFromEnvironment($ENV)
    {
        $protocoll  = 'http' . (isset($ENV['HTTPS']) && $ENV['HTTPS'] === 'on' ? 's' : '') . '://';
        $port       = isset($ENV['SERVER_PORT']) && (int)$ENV['SERVER_PORT'] !== 80 ? ':' . $ENV['SERVER_PORT'] : '';
        $host       = $ENV['SERVER_NAME'];
        $path       = $ENV['REQUEST_URI'];

        return new URL($protocoll . $host . $port . $path);
    }
}
